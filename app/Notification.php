<?php

namespace App;

/**
 * Class Notification
 * @package App
 *
 * @property integer $id
 * @property integer $user_id
 * @property bool $is_read
 * @property string $title
 * @property string $desc
 * @property string $type eg: link, comment for notification of entity, or global such as welcome notification, linkNoter events...
 * @property integer $entity_id
 * @property string $created_at
 * @property string $updated_at
 */
class Notification extends AppModel
{

}
