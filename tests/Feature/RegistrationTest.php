<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Services\TenantService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_flow_does_not_create_db_until_otp_verified()
    {
        Mail::fake();

        // 1. Submit Registration Form
        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'company' => 'Doe Corp',
            'phone' => '1234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson(route('saas.register.submit'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Registration successful. OTP sent to your email.',
        ]);

        $adminId = $response->json('admin_id');
        $this->assertNotEmpty($adminId);

        // Verify admin is NOT created in database yet
        $this->assertDatabaseMissing('admins', [
            'email' => 'john.doe@example.com',
        ], 'landlord');

        // Verify registration data is cached
        $cachedData = Cache::get('pending_admin_' . $adminId);
        $this->assertNotNull($cachedData);
        $this->assertEquals('John', $cachedData['first_name']);
        $this->assertNotEmpty($cachedData['otp']);

        Mail::assertSent(OTPMail::class, function ($mail) use ($cachedData) {
            return $mail->hasTo('john.doe@example.com');
        });

        // 2. Mock Tenant Service database creation
        $tenantServiceMock = $this->mock(TenantService::class);
        $tenantServiceMock->shouldReceive('createTenant')
            ->once()
            ->andReturn('tenant_doe_corp');

        // 3. Verify OTP with wrong code
        $verifyWrongResponse = $this->postJson(route('saas.verify.otp'), [
            'admin_id' => $adminId,
            'otp' => '000000', // incorrect OTP
        ]);

        $verifyWrongResponse->assertStatus(422);
        $verifyWrongResponse->assertJson([
            'success' => false,
            'message' => 'Invalid OTP.',
        ]);

        // Verify admin is STILL NOT in database
        $this->assertDatabaseMissing('admins', [
            'email' => 'john.doe@example.com',
        ], 'landlord');

        // 4. Verify OTP with correct code
        $verifyResponse = $this->postJson(route('saas.verify.otp'), [
            'admin_id' => $adminId,
            'otp' => $cachedData['otp'],
        ]);

        $verifyResponse->assertStatus(200);
        $verifyResponse->assertJson([
            'success' => true,
            'message' => 'Email verified and database created successfully!',
        ]);

        // Verify admin IS created in database now
        $this->assertDatabaseHas('admins', [
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'status' => 'active',
            'verification_status' => 'verified',
            'company' => 'Doe Corp',
            'db_name' => 'tenant_doe_corp',
        ], 'landlord');

        // Verify cache is cleared
        $this->assertNull(Cache::get('pending_admin_' . $adminId));
    }
}
