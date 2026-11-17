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
        $fullName = trim($request->input('name', ''));
        $nameParts = preg_split('/\s+/', $fullName, 2);
        $firstName = $request->input('first_name', $nameParts[0] ?? '');
        $lastName = $request->input('last_name', $nameParts[1] ?? ($nameParts[0] ?? ''));

        $data = $request->all();
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
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
            // Fields not present in UI are set to null as requested
            Cache::put('pending_admin_' . $tempId, [
                'name' => $fullName ?: trim($firstName . ' ' . $lastName),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone ?? null,
                'company' => $request->company,
                'address' => $request->address ?? null,
                'city' => $request->city ?? null,
                'state' => $request->state ?? null,
                'pincode' => $request->pincode ?? null,
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
            $adminName = !empty($pendingData['name'])
                ? $pendingData['name']
                : trim(($pendingData['first_name'] ?? '') . ' ' . ($pendingData['last_name'] ?? ''));

            $admin = Admin::create([
                'name' => $adminName,
                'username' => $pendingData['username'],
                'email' => $pendingData['email'],
                'phone' => $pendingData['phone'] ?? null,
                'company' => $pendingData['company'],
                'address' => $pendingData['address'] ?? null,
                'city' => $pendingData['city'] ?? null,
                'state' => $pendingData['state'] ?? null,
                'pincode' => $pendingData['pincode'] ?? null,
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

