<?php

namespace common\models\wrappers;

use common\models\UserLocation;
use Yii;

/**
 * This is the model class for table "{{%tbl_user_location}}".
 *
 * @property int $id
 * @property int $location_id
 * @property string $user_id
 */
class UserLocationWrapper extends UserLocation
{
    public $locations;

    public function rules()
    {
        return \yii\helpers\ArrayHelper::merge(parent::rules(), [
            [['user_id', 'location_id', 'locations'], 'safe'],
        ]);
    }
}
