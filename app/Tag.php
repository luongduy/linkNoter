<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public function links() {
		return $this->belongsToMany('App\Link');
	}
}
