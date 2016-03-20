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
            $vote = Vote::where('user_id', $user->id)->where('link_id', $link->id)->first();
            if ($vote == null) array_push($arr, 0);
            else array_push($arr, $vote->current_vote);
        }
        return $arr;
    }
    public function increaseVote(Link $link, User $user) {
        $existedVote = Vote::where('user_id', $user->id)->where('link_id', $link->id)->first();
        if ($existedVote != null) {
            $newVote = $existedVote;
            Log::info("NOT NULL");
        }
        else $newVote = new Vote;
        $newVote->user_id = $user->id;
        $newVote->link_id = $link->id;
        Log::info($newVote->current_vote);
        $newVote->current_vote = $newVote->current_vote + 1;
        Log::info($newVote->current_vote);
        $newVote->save();
        $link->voted ++;
        $link->save();
    }
    public function decreaseVote(Link $link, User $user) {
        $existedVote = Vote::where('user_id', $user->id)->where('link_id', $link->id)->first();
        if ($existedVote != null) $newVote = $existedVote;
        else $newVote = new Vote;
        $newVote->user_id = $user->id;
        $newVote->link_id = $link->id;
        $newVote->current_vote = $newVote->current_vote - 1;
        Log::info($newVote->current_vote);
        $newVote->save();
        $link->voted --;
        $link->save();
    }
}
