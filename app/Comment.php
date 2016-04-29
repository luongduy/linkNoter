<?php

namespace App;

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
