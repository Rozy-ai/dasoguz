<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_user_location}}".
 *
 * @property int $id
 * @property int $location_id
 * @property string $user_id
 */
class UserLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_user_location}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_id', 'user_id'], 'required'],
            [['location_id'], 'integer'],
            [['user_id'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
