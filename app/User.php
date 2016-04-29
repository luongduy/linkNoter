<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @package App
 *
 * @property integer $id
 * @property string $avatar_path
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Collection|Link[] $links
 * @property Collection|Comment[] $comments
 * @property Collection|Vote[] $votes
 * @property Collection|Category[] $categories
 * @property Collection|Notification[] $notifications
 */
class User extends AppModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function getNotificationCount(){
        return $this->notifications()->getQuery()->getQuery()->where('is_read', 0)->count();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_path',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
