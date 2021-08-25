<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_middle_point_lang}}".
 *
 * @property integer $id
 * @property integer $middle_point_id
 * @property string $language
 * @property string $name
 * @property string $description
 */
class MiddlePointLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_middle_point_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['middle_point_id', 'language', 'name'], 'required'],
            [['name'], 'unique'],
            [['middle_point_id'], 'integer'],
            [['language'], 'string', 'max' => 6],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'middle_point_id' => Yii::t('app', 'Middle Point ID'),
            'language' => Yii::t('app', 'Language'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
