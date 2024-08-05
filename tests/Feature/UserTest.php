<?php

namespace Tests\Feature;

use App\Models\User_Auth;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_login(): void
    {
        $response = $this->post('/api/login', ['email' => 'user_1@email.com.br', 'password' => 'user_1%123']);
        $response->assertStatus(200)->assertJsonStructure([
            'token', 'type', 'expires_in'
        ]);
    }

    public function test_login_wrong(): void
    {
        $response = $this->post('/api/login', ['email' => 'user_1@email.com.br', 'password' => '12323']);
        $response->assertStatus(401);
    }

    public function test_login_required(): void
    {
        $response = $this->post('/api/login');
        $response->assertStatus(422)->assertJsonStructure([
            'email', 'password'
        ]);
    }

    public function test_logout(): void
    {
        $user = User_Auth::first();
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user->id))->post('/api/logout');
        $response->assertStatus(200);
    }
}
