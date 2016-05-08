<?php

namespace App;

/**
 * Class Comment
 * @package App
 *
 * @property int $user_id
 * @property int $link_id
 * @property string $content
 */
class Comment extends AppModel
{
   public function user() {
		return $this->belongsTo('App\User');
	}
	public function link() {
		return $this->belongsTo('App\Link');
	}
	public function votes() {
        return $this->hasMany('App\Vote');
    }
}
