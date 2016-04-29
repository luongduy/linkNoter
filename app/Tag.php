<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Tag
 * @package App
 *
 * @property $id
 * @property $user_id
 * @property $title
 * @property $href
 * @property $voted
 * @property $viewed
 * @property $created_at
 * @property $updated_at
 * @property Collection|Link[] $links
 */
class Tag extends AppModel
{
	public function links() {
		return $this->belongsToMany('App\Link');
	}
}
