<?php

namespace App\Http\Controllers;

use App\LinkStatus;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ToggleLinkStatusController
{
    public function __invoke(Request $request, Link $link)
    {
        Gate::authorize('toggle', $link);

        $new_status = match ($link->status) {
            LinkStatus::ACTIVE => LinkStatus::INACTIVE,
            LinkStatus::INACTIVE => LinkStatus::ACTIVE,
        };

        $link->update(['status' => $new_status]);

        return back();
    }
}
