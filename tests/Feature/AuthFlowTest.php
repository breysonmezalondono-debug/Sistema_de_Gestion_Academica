<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_login_with_normalized_email(): void
    {
        $response = $this->post('/register', [
            'name' => 'Ana García',
            'email' => 'Ana.Garcia@Example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        $user = User::where('email', 'ana.garcia@example.com')->first();
        $this->assertNotNull($user);
        $this->assertSame('ana.garcia@example.com', $user->email);

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();

        $loginResponse = $this->post('/login', [
            'email' => 'ANA.GARCIA@EXAMPLE.COM',
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}
