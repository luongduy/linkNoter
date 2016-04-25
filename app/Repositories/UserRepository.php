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

    public function getTags(User $user)
    {
        $links = $user->links;
        /**@var $links \Illuminate\Database\Eloquent\Collection */
        $linkIds = array_map(function($value) {return $value['id'];}, $links->toArray());

        $tags = Tag::query()
            ->join('link_tag', function (JoinClause $join) use ($linkIds) {
                $join->on('tags.id', '=', 'link_tag.tag_id')
                    ->on('link_tag.link_id', 'in', $linkIds, 'and', true);
            })
            ->groupBy('link_tag.tag_id')
            ->get();

        return $tags;
    }

}