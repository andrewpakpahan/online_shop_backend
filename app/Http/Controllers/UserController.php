<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Fetch all users
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();
        // Return a JSON response with a success message and the retrieved users
        return response()->json(['message' => 'Hooray!! Successfully fetched users', 'data' => $users], 200);
    }

    // Create a new user
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Create a new User model instance
        $user = new User();
        // Assign values to the user model instance properties
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        // Save the new user model instance to the database
        $user->save();

        // Return a JSON response with a success message and the newly created user
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);
    }

    // Fetch a single user by ID
    public function show(User $user)
    {
        // Return a JSON response with a success message and the retrieved user
        return response()->json(['message' => 'Successfully fetched user', 'data' => $user], 200);
    }

    // Update an existing user
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable',
        ]);

        // Update the user model instance properties with new values from the request
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // If a new password is provided, hash it and assign it to the user model instance
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the updated user model instance to the database
        $user->save();

        // Return a JSON response with a success message and the updated user
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }

    // Delete a user by ID
    public function destroy(User $user)
    {
        // Delete the user from the database
        $user->delete();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'User successfully deleted'
        ], 200);
    }
}
