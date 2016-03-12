<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 3/12/16
 * Time: 9:51 AM
 */

namespace App\Repositories;

use App\Category;
use App\User;

class CategoryRepository
{
    protected function __construct(){}

    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $userQuery;

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function forUser(User $user)
    {
        if ($this->userQuery === null) {
            $this->userQuery = Category::query()
                ->where('user_id', $user->id);
        }
        return $this->userQuery;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCategories()
    {
        return Category::query()
            ->get();
    }

    /**
     * @param $id
     * @return Category
     */
    public function findOne($id)
    {
        return Category::query()->where('id', $id)->first();
    }

}