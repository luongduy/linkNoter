<?php

namespace App;

/**
 * Class Note
 * @package App
 *
 * @property Category $category
 */
class Note extends AppModel
{
	public function category() {
		return $this->belongsTo('App\Category');
	}

    protected $fillable = [
        'title', 'content',
    ];
}
