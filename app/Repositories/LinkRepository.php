<?php

namespace App\Repositories;

use App\User;
use App\Link;

class LinkRepository
{
    /**
     * Get all of the links for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Link::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
    public function getAllLinks() {
        return Link::all();
    }
}
