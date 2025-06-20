<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        return view('profile', ['user' => $user]);
    }

    // Show profile
    public function show(Request $request)
    {
        $user = $request->user();
        return view('profile', ['user' => $user]);
    }

    // Update email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'current_email' => 'required|string|lowercase|email|max:255|exists:users,email',
            'new_email' => 'required|string|lowercase|email|max:255|unique:users,email',
        ]);
        $user = $request->user();
        $user->update([
            'email' => $request->new_email,
        ]);
        return back();
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'confirmed', Rules\Password::default()],
        ]);
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        // Log out after password change
        return app(AuthenticationController::class)->destroy($request);
    }
}
