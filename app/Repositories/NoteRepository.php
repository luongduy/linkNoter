<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 3/12/16
 * Time: 10:41 AM
 */

namespace App\Repositories;


use App\Note;

class NoteRepository
{
    private static $_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * @param $categoryId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function forCategory($categoryId)
    {
        return Note::query()->where('category_id', $categoryId);
    }


}