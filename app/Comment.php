<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
