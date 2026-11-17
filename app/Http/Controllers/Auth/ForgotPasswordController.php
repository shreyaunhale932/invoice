<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Mail\OTPMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Send OTP to user/admin email for password reset.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = trim(strtolower($request->email));

        // Check if user exists in Admin (landlord tenant) or User (superadmin)
        $admin = Admin::where('email', $email)->first();
        $user = User::where('email', $email)->first();

        if (!$admin && !$user) {
            return response()->json([
                'success' => false,
                'message' => 'No account found with this email address.',
            ], 404);
        }

        try {
            // Generate a 6-digit OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiry = Carbon::now()->addMinutes(10);

            // Store OTP in Cache for 10 minutes
            Cache::put('password_reset_otp_' . md5($email), [
                'otp' => $otp,
                'email' => $email,
                'otp_expiry' => $expiry,
            ], 600);

            // If Admin record exists, also update Admin fields
            if ($admin) {
                $admin->update([
                    'otp' => $otp,
                    'otp_expiry' => $expiry,
                ]);
            }

            // Send OTP email
            Mail::to($email)->send(new OTPMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'A 6-digit OTP has been sent to your email address.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Verify the OTP for password reset.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $email = trim(strtolower($request->email));
        $otp = trim($request->otp);

        $cachedData = Cache::get('password_reset_otp_' . md5($email));

        $isValid = false;
        if ($cachedData && isset($cachedData['otp']) && $cachedData['otp'] === $otp) {
            if (Carbon::now()->isBefore($cachedData['otp_expiry'])) {
                $isValid = true;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired. Please request a new one.',
                ], 422);
            }
        }

        // Fallback check on Admin table
        if (!$isValid) {
            $admin = Admin::where('email', $email)->first();
            if ($admin && $admin->otp === $otp) {
                if ($admin->otp_expiry && Carbon::now()->isBefore($admin->otp_expiry)) {
                    $isValid = true;
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'OTP has expired. Please request a new one.',
                    ], 422);
                }
            }
        }

        if (!$isValid) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please check and try again.',
            ], 422);
        }

        // Generate a secure reset token
        $resetToken = Str::random(60);
        Cache::put('password_reset_token_' . md5($email), [
            'token' => $resetToken,
            'email' => $email,
        ], 900); // Valid for 15 minutes

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'reset_token' => $resetToken,
        ]);
    }

    /**
     * Reset the password with verified reset token.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $email = trim(strtolower($request->email));
        $cachedToken = Cache::get('password_reset_token_' . md5($email));

        if (!$cachedToken || $cachedToken['token'] !== $request->token) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your password reset session has expired or is invalid. Please request a new OTP.',
                ], 422);
            }
            return back()->withErrors(['message' => 'Your password reset session has expired or is invalid. Please request a new OTP.']);
        }

        $passwordHash = Hash::make($request->password);
        $updated = false;

        $admin = Admin::where('email', $email)->first();
        if ($admin) {
            $admin->update([
                'password' => $passwordHash,
                'otp' => null,
                'otp_expiry' => null,
            ]);
            $updated = true;
        }

        $user = User::where('email', $email)->first();
        if ($user) {
            $user->update([
                'password' => $passwordHash,
            ]);
            $updated = true;
        }

        if (!$updated) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Account not found.',
                ], 404);
            }
            return back()->withErrors(['message' => 'Account not found.']);
        }

        // Clear cache
        Cache::forget('password_reset_otp_' . md5($email));
        Cache::forget('password_reset_token_' . md5($email));

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully! You can now log in with your new password.',
            ]);
        }

        return redirect('/')->with('status', 'Password reset successfully! You can now log in with your new password.');
    }
}

