<?php

namespace App\Repositories;

use App\User;
use App\Link;
use App\Vote;
use Illuminate\Database\Eloquent\Collection;
use Log;
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
        return Link::orderBy('created_at', 'desc')->get();
    }
    public function getVotes(Collection $links, User $user) {
        $arr = array();
        foreach ($links as $link) {
            array_push($arr, $this->getVote($link, $user));
        }
        return $arr;
    }

    public function getVote(Link $link, User $user) {
        $vote = Vote::where('user_id', $user->id)->where('link_id', $link->id)->where('type', 'link')->first();
        if ($vote == null) return 0;
        else return $vote->current_vote;
    }

    public function increaseVote(Link $link, User $user) {
        $existedVote = Vote::where('user_id', $user->id)->where('link_id', $link->id)->where('type', 'link')->first();
        if ($existedVote != null) {
            $newVote = $existedVote;
            Log::info("NOT NULL");
        }
        else $newVote = new Vote;
        $newVote->user_id = $user->id;
        $newVote->link_id = $link->id;
        $newVote->type = 'link';
        $newVote->current_vote ++;
        $newVote->save();
        $link->voted ++;
        $link->save();
    }
    public function decreaseVote(Link $link, User $user) {
        $existedVote = Vote::where('user_id', $user->id)->where('link_id', $link->id)->where('type', 'link')->first();
        if ($existedVote != null) $newVote = $existedVote;
        else $newVote = new Vote;
        $newVote->user_id = $user->id;
        $newVote->link_id = $link->id;
        $newVote->type = 'link';
        $newVote->current_vote --;
        $newVote->save();
        $link->voted --;
        $link->save();
    }
    public function searchLinks($searchString) {
        return Link::where('title', 'LIKE', "%$searchString%")->get();
    }
}
