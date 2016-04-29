<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 4/16/16
 * Time: 11:24 PM
 */

namespace App\Repositories;


use App\Tag;
use App\User;
use Illuminate\Database\Query\JoinClause;

class UserRepository
{
    const AVATAR_PATH = 'avatars/';
    const AVATAR_EXT = '.jpg';

    const REPUTATION_PER_LINK_POST = 5;
    const REPUTATION_PER_LINK_COMMENT = 3;
    const REPUTATION_PER_LINK_VOTE = 2;
    const REPUTATION_PER_COMMENT_VOTE = 2;

    public function getReputation(User $user)
    {
        $linkPostsRepu   = $user->links()->getQuery()->getQuery()->count() * self::REPUTATION_PER_LINK_POST;
        $linkVoteRepu    = $user->links()->getQuery()->getQuery()->sum('voted') * self::REPUTATION_PER_LINK_VOTE;
        $commentsRepu    = $user->comments()->getQuery()->getQuery()->count() * self::REPUTATION_PER_LINK_COMMENT;
        $commentVoteRepu = $user->comments()->getQuery()->getQuery()->sum('voted') * self::REPUTATION_PER_COMMENT_VOTE;

        return $linkPostsRepu + $commentsRepu + $linkVoteRepu + $commentVoteRepu;
    }

    public function getTags(User $user)
    {
        //as __call() in Eloquent\Builder, $user->links()->getQuery()->pluck() === $user->links()->pluck()
        $linkIds = $user->links->pluck('id')->toArray();

        $tags = Tag::query()->getQuery()->join('link_tag', function (JoinClause $join) use ($linkIds) {
            $joinClause = $join->on('tags.id', '=', 'link_tag.tag_id');
            $joinClause->on('link_tag.link_id', 'in', $linkIds ?: [-1], 'and', true);
        })->groupBy('link_tag.tag_id')->get();

        return $tags;
    }

    /**
     * @param $id
     * @return User
     */
    public function findOne($id)
    {

        $query = User::query()->where('id', $id);

        return $query->firstOrFail();
    }

}