<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_point_lang}}".
 *
 * @property integer $id
 * @property integer $point_id
 * @property string $language
 * @property string $name
 * @property string $description
 */
class PointLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_point_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['point_id', 'language', 'name'], 'required'],
            [['point_id'], 'integer'],
            [['name'], 'unique'],
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
            'point_id' => Yii::t('app', 'Point ID'),
            'language' => Yii::t('app', 'Language'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
