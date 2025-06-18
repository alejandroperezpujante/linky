<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UpdateProfilePasswordController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'confirmed', Rules\Password::default()],
        ]);

        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return app(AuthenticationController::class)->destroy($request);
    }
}
