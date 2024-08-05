<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class System extends Controller
{
    public function login(Request $request)
    {
        $credentials = $this->validate($request, ['email' => 'email|required', 'password' => 'string|required']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['erro' => 'login', 'message' => 'User Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return response()->json(['message' => 'user logout'], 200);
        } else {
            return response()->json(['erro' => 'login', 'message' => 'User Unauthorized'], 401);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]);
    }
}
