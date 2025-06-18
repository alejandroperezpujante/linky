<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
