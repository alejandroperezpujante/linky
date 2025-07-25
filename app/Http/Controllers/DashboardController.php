<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $links = $user->links()->latest()->limit(5)->get();

        return view('dashboard', [
            'user' => $user,
            'links' => $links
        ]);
    }
}
