<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class AuthenticationController
{
    /**
     * Handle the incoming request.
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|string|email']);
        $user_exists = User::where('email', $request->email)->exists();

        return match ($user_exists) {
            true => $this->handleLogin($request),
            false => $this->handleRegister($request)
        };
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('landing', absolute: false));
    }

    private function handleRegister(Request $request) {
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'string', Rules\Password::default()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    private function handleLogin(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
