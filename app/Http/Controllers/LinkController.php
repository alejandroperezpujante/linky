<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $short_code)
    {
        $link = Link::where('short_code', $short_code)->first();
        if (! $link) {
            abort(404);
        }

        if ($link->isInactive()) {
            abort(423);
        }

        return redirect()->away($link->original_url);
    }
}
