<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[test]
    public function test_registration_page_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Create Account');
    }

    #[test]
    public function test_new_users_can_register_with_valid_data()
    {
        Event::fake();

        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice'));

        // Vérifier que l'utilisateur a été créé en base
        $this->assertDatabaseHas('users', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
        ]);

        // Vérifier que le mot de passe est hashé
        $user = User::where('email', 'jasyblizzard@gmail.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));

        // Vérifier que l'événement Registered a été déclenché
        Event::assertDispatched(Registered::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }

    #[test]
    public function test_name_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertGuest(); // L'utilisateur ne doit pas être connecté
    }

    #[test]
    public function test_email_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => '',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    #[test]
    public function test_email_must_be_valid_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'invalid-email',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    #[test]
    public function test_email_must_be_unique_for_registration()
    {
        // Créer un utilisateur existant
        User::factory()->create([
            'email' => 'existing@example.com'
        ]);

        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'existing@example.com',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    #[test]
    public function test_phone_number_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('phone_number');
        $this->assertGuest();
    }

    #[test]
    public function test_password_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
            'password' => '',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    #[test]
    public function test_password_must_be_at_least_8_characters()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    #[test]
    public function test_password_must_be_confirmed()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'differentpassword',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    #[test]
    public function test_user_is_logged_in_after_successful_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Jazz',
            'email' => 'jasyblizzard@gmail.com',
            'phone_number' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $this->assertNotNull(auth()->user());
        $this->assertEquals('jasyblizzard@gmail.com', auth()->user()->email);
    }
}

