<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UpdateProfileEmailController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'current_email' => 'required|string|lowercase|email|max:255|exists:users,email',
            'new_email' => 'required|string|lowercase|email|max:255|unique:users,email',
        ]);

        $user = $request->user();
        $user->update([
            'email' => $request->new_email,
        ]);

        return to_route('profile');
    }
}
