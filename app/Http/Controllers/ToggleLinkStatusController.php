<?php

namespace App\Http\Controllers;

use App\LinkStatus;
use App\Models\Link;
use Illuminate\Http\Request;

class ToggleLinkStatusController
{
    public function __invoke(Request $request, Link $link)
    {
        $user = $request->user();
        if ($link->user_id !== $user->id) {
            abort(403);
        }

        $new_status = match ($link->status) {
            LinkStatus::ACTIVE => LinkStatus::INACTIVE,
            LinkStatus::INACTIVE => LinkStatus::ACTIVE,
        };

        $link->update(['status' => $new_status]);

        return back();
    }
}
