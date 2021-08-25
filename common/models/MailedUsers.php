<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_mailed_users".
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property string $date_sent
 */
class MailedUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_mailed_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'date_sent'], 'required'],
            [['user_id', 'item_id'], 'integer'],
            [['date_sent'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'date_sent' => 'Date Sent',
        ];
    }
}
