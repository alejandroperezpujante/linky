<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;
use App\LinkStatus;

class LinkPolicy
{
    /**
     * Determine if the given link can be redirected.
     */
    public function follow(User $user, Link $link): bool
    {
        return $link->status === LinkStatus::ACTIVE;
    }

    /**
     * Determine if the given link can be edited by the user.
     */
    public function edit(User $user, Link $link): bool
    {
        return $link->user_id === $user->id;
    }

    /**
     * Determine if the given link can be updated by the user.
     */
    public function update(User $user, Link $link): bool
    {
        return $link->user_id === $user->id;
    }

    /**
     * Determine if the given link can be deleted by the user.
     */
    public function delete(User $user, Link $link): bool
    {
        return $link->user_id === $user->id;
    }

    /**
     * Determine if the given link's status can be toggled by the user.
     */
    public function toggle(User $user, Link $link): bool
    {
        return $link->user_id === $user->id;
    }
}
