<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */

class Category extends Model
{
	public function user() {
		return $this->belongsTo('App\User');
	}
	public function note() {
		return $this->hasMany('App\Note');
	}
    //
}
