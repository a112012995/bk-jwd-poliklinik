<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // * Login function
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Get the user
        $user = User::where('username', $request->username)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Check if the password is correct using bcrypt
        if (!password_verify($request->password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect password',
            ], 401);
        }

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ])->header('Location', '/');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    // * Register function
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Create user
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ])->header('Location', '/');
    }

    // Show register form
    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    // * Logout function
    public function logout(Request $request)
    {
        // Revoke token
        $request->user()->currentAccessToken()->delete();

        // Return response
        return response()->json([
            'message' => 'Logged out',
        ])->header('Location', '/');
    }
}
