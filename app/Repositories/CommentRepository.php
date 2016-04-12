<?php

namespace App\Repositories;

use App\Comment;
use App\Link;
use App\User;
use App\Vote;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    public function forLink(Link $link){
        return Comment::where('link_id', $link->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
    public function getVotes(Collection $comments, User $user) {
        $arr = array();
        foreach ($comments as $comment) {
            $vote = $user->votes()->where('comment_id', $comment->id)->where('type', 'comment')->first();
            if ($vote == null) array_push($arr, 0);
            else array_push($arr, $vote->current_vote);
        }
        return $arr;
    }

    public function increaseCommentVote(Comment $comment, User $user) {
        $existedVote = Vote::where('user_id', $user->id)->where('comment_id', $comment->id)->where('type', 'comment')->first();
        if ($existedVote != null) {
            $newVote = $existedVote;
        }
        else $newVote = new Vote;
        $newVote->user_id = $user->id;
        $newVote->comment_id = $comment->id;
        $newVote->type = 'comment';
        $newVote->current_vote ++;
        $newVote->save();
        $comment->voted ++;
        $comment->save();
    }
    public function decreaseCommentVote(Comment $comment, User $user) {
        $existedVote = Vote::where('user_id', $user->id)->where('comment_id', $comment->id)->where('type', 'comment')->first();
        if ($existedVote != null) $newVote = $existedVote;
        else $newVote = new Vote;
        $newVote->user_id = $user->id;
        $newVote->comment_id = $comment->id;
        $newVote->type = 'comment';
        $newVote->current_vote --;
        $newVote->save();
        $comment->voted --;
        $comment->save();
    }
}
