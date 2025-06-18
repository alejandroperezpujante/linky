<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Jobs\IncrementLinkUsage;

class LinkController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $short_code)
    {
        $link = Link::where('short_code', $short_code)->first();
        if (! $link) {
            return view('errors.404');
        }

        if ($link->isInactive()) {
            return view('errors.423');
        }

        IncrementLinkUsage::dispatch($link->id);
        return redirect()->away($link->original_url);
    }
}
