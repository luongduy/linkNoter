<?php

namespace App;

class Link extends AppModel
{
	public function user() {
		return $this->belongsTo('App\User');
	}
	public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function votes() {
        return $this->hasMany('App\Vote');
    }
	public function tags() {
		return $this->belongsToMany('App\Tag');
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
