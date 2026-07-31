<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\MailjetService;
use App\Services\TenantService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function register(Request $request, MailjetService $mailjet)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:landlord.admins,email',
            'username' => 'required|string|max:255|unique:landlord.admins,username',
            'company' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $tempId = (string) Str::uuid();

            // Store the data temporarily in the cache for 10 minutes (600 seconds)
            Cache::put('pending_admin_' . $tempId, [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'password' => Hash::make($request->password),
                'otp' => $otp,
                'otp_expiry' => Carbon::now()->addMinutes(10),
            ], 600);

            // Send OTP via Mail
            Mail::to($request->email)->send(new OTPMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'Registration successful. OTP sent to your email.',
                'admin_id' => $tempId,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        $tempId = $request->admin_id;
        $pendingData = Cache::get('pending_admin_' . $tempId);

        if (!$pendingData || $pendingData['otp'] !== $request->otp) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.'], 422);
        }

        if (Carbon::now()->isAfter($pendingData['otp_expiry'])) {
            return response()->json(['success' => false, 'message' => 'OTP has expired.'], 422);
        }

        try {
            // Re-verify that email/username are not taken by another completed signup
            $existingEmail = Admin::where('email', $pendingData['email'])->exists();
            if ($existingEmail) {
                return response()->json(['success' => false, 'message' => 'The email has already been taken.'], 422);
            }
            $existingUsername = Admin::where('username', $pendingData['username'])->exists();
            if ($existingUsername) {
                return response()->json(['success' => false, 'message' => 'The username has already been taken.'], 422);
            }

            // Create admin
            $admin = Admin::create([
                'name' => $pendingData['first_name'] . ' ' . $pendingData['last_name'],
                'username' => $pendingData['username'],
                'email' => $pendingData['email'],
                'phone' => $pendingData['phone'],
                'company' => $pendingData['company'],
                'address' => $pendingData['address'],
                'city' => $pendingData['city'],
                'state' => $pendingData['state'],
                'pincode' => $pendingData['pincode'],
                'password' => $pendingData['password'],
                'status' => 'active',
                'otp' => null,
                'otp_expiry' => null,
                'verification_status' => 'verified',
            ]);

            // Create tenant database
            $dbName = $this->tenantService->createTenant($admin);
            $admin->update(['db_name' => $dbName]);

            // Remove registration data from cache
            Cache::forget('pending_admin_' . $tempId);

            return response()->json([
                'success' => true,
                'message' => 'Email verified and database created successfully!',
                'redirect' => route('invoice-front'),
            ]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Verification successful but database creation failed: ' . $e->getMessage()], 500);
        }
    }
}

