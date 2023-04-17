<?php

// Import necessary classes
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

// Define the LoginController class
class LoginController extends Controller
{
    // Define the login method for authenticating a user
    public function login(Request $request)
    {
        // Validate the email and password fields in the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user using the email and password provided in the request
        if (!Auth::attempt($request->only('email', 'password'))) {
            // If authentication fails, return a ValidationException with an error message
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Retrieve the authenticated user instance
        $user = User::where('email', $request->email)->first();

        // Create a new API token for the user and retrieve its plain-text value
        $token = $user->createToken('ApiToken')->plainTextToken;

        // Return a JSON response with the access token, token type, and success message
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Login successful',
        ]);
    }

    // Define the logout method for revoking a user's API token
    public function logout(Request $request)
    {
        // Delete all API tokens associated with the authenticated user
        $request->user()->tokens()->delete();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
