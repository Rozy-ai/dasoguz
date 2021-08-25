<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_subscriber}}".
 *
 * @property integer $id
 * @property string $email
 * @property integer $category
 * @property string $date
 */
class Subscriber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_subscriber}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'date'], 'required'],
            [['category'], 'integer'],
            [['date'], 'safe'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'category' => Yii::t('app', 'Category'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
