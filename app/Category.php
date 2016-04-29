<?php

namespace App;

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
class Category extends AppModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    protected $fillable = [
        'name'
    ];
}
