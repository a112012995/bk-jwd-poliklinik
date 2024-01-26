<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // * Create function
    public function create(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        // Create user
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ])->header('Location', '/');
    }

    // * Read function
    public function read(Request $request)
    {
        // Get user
        $user = $request->user();

        // If user doesn't exist
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Return response
        return response()->json([
            'user' => $user,
        ]);
    }

    // * Update function
    public function update(Request $request)
    {
        // Get user
        $user = $request->user();

        // If user doesn't exist
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Validate the request
        $request->validate([
            'username' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        // Update user
        $user->update([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        // Return response
        return response()->json([
            'message' => 'User updated',
        ]);
    }

    // * Delete function (for testing purposes)
    public function delete(Request $request)
    {
        // Get user
        $user = $request->user();

        // If user doesn't exist
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Delete user
        $request->user()->delete();

        // Return response
        return response()->json([
            'message' => 'User deleted',
        ]);
    }
}
