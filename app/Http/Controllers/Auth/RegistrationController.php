<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Mail\OTPMail;
use App\Services\TenantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Exception;

class RegistrationController extends Controller
{
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function register(Request $request)
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
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $admin = Admin::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'password' => Hash::make($request->password),
                'status' => 'inactive',
                'otp' => $otp,
                'otp_expiry' => Carbon::now()->addMinutes(10),
                'verification_status' => 'pending',
                // Company name can be stored if there's a field, otherwise it might be used in tenant service
            ]);

            Mail::to($request->email)->queue(new OTPMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'Registration successful. OTP sent to your email.',
                'admin_id' => $admin->id
            ]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:landlord.admins,id',
            'otp' => 'required|string|size:6',
        ]);

        $admin = Admin::find($request->admin_id);

        if (!$admin || $admin->otp !== $request->otp) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.'], 422);
        }

        if (Carbon::now()->isAfter($admin->otp_expiry)) {
            return response()->json(['success' => false, 'message' => 'OTP has expired.'], 422);
        }

        try {
            // Update status
            $admin->update([
                'verification_status' => 'verified',
                'status' => 'active',
                'otp' => null,
                'otp_expiry' => null,
            ]);

            // Create tenant database
            $dbName = $this->tenantService->createTenant($admin);
            $admin->update(['db_name' => $dbName]);

            return response()->json([
                'success' => true,
                'message' => 'Email verified and database created successfully!',
                'redirect' => route('login')
            ]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Verification successful but database creation failed: ' . $e->getMessage()], 500);
        }
    }
}
