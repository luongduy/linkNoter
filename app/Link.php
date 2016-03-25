<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	public function user() {
		return $this->belongsTo('App\User');
	}
	public function tags() {
		return $this->belongsToMany('App\Tag');
	}
	public function voted_by() {
		return $this->belongsToMany('App\User', 'votes');
	}
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'href','voted','viewed'
    ];
}
