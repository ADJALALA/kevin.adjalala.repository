<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;

class EmailVerificationTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;

    #[test]
    public function  test_email_verification_page_can_be_rendered()
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/email/verify');

        $response->assertStatus(200);
        $response->assertSee('Vérification d\'email');
    }

    #[test]
    public function test_email_can_be_verified()
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('ads.index'));
    }

    #[test]
    public function test_email_is_not_verified_with_invalid_hash()
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => 'invalid-hash']
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    #[test]
    public function test_verified_users_can_access_protected_routes()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/ads');

        $response->assertStatus(200);
    }

    #[test]
    public function test_unverified_users_cannot_access_protected_routes()
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/ads');

        $response->assertRedirect('/email/verify');
    }
}

