<?php

namespace App\Repositories;

use App\Tag;

class TagRepository
{
    /**
     * Get all of the tags
     *
     * @param  none
     * @return Collection
     */
    
    public function getAllTags() {
        return Tag::all();
    }
    public function getTagByName($name) {
        return Tag::where('name', $name)->first();
    }
    public function getLinksByTagName($tagName, $sortedBy) {
        switch ($sortedBy) {
            case 'time':
                return $this->getTagByName($tagName)->links()->orderBy('created_at', 'desc')->get();
            case 'vote':
                return $this->getTagByName($tagName)->links()->orderBy('voted', 'desc')->get();
            case 'view':
                return $this->getTagByName($tagName)->links()->orderBy('viewed', 'desc')->get();
        }
    }
}
