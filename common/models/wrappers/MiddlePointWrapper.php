<?php

namespace common\models\wrappers;

use common\models\MiddlePoint;
use common\models\MiddlePointLang;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;

/**
 * This is the model class for table "{{%tbl_middle_point}}".
 *
 * @property integer $id
 * @property string $code
 * @property integer $status
 */
class MiddlePointWrapper extends MiddlePoint
{
    public function rules() {
        return \yii\helpers\ArrayHelper::merge(parent::rules(), [
            [['name', 'description'], 'string'],
            [['name', 'description', 'name_ru', 'description_ru', 'name_en', 'description_en'], 'safe'],
        ]);
    }

    public function behaviors() {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages'=>Yii::$app->urlManager->languages,
//                'languages' => [
//                    'tk' => 'Turkmen',
//                    'ru' => 'Russian',
//                    'en' => 'English',
//                ],
                //'languageField' => 'language',
                //'localizedPrefix' => '',
                //'requireTranslations' => false',
                //'dynamicLangClass' => true',
                'langClassName' => MiddlePointLang::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => 'tk',
                'langForeignKey' => 'middle_point_id',
                'tableName' => "{{%tbl_point_lang}}",
                'attributes' => [
                    'name', 'description',
                ]
            ],
        ];
    }

    public static function find() {
        return new MultilingualQuery(get_called_class());
    }

    public function getTranslations() {
        return $this->hasMany(MiddlePointLang::className(), ['middle_point_id' => 'id']);
    }

    // public function getFromRoutes() {
    //     return $this->hasMany(RouteWrapper::className(), ['from_point_id' => 'id']);
    // }

    // public function getToRoutes() {
    //     return $this->hasMany(RouteWrapper::className(), ['to_point_id' => 'id']);
    // }

}
