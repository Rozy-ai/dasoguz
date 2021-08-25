<?php

namespace common\models;

use common\models\wrappers\PointWrapper;
use Yii;

/**
 * This is the model class for table "{{%tbl_route_point}}".
 *
 * @property integer $id
 * @property integer $route_id
 * @property integer $point_id
 * @property integer $planned_period_min
 * @property string $price
 * @property integer $type
 * @property string $planned_departure_time
 */
class RoutePoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_route_point}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_id', 'point_id'], 'required'],
            [['route_id', 'point_id', 'planned_period_min', 'type'], 'integer'],
            [['planned_departure_time'], 'string'],
            [['planned_period_min', 'type'], 'default', 'value' => 0],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'route_id' => Yii::t('app', 'Route No'),
            'point_id' => Yii::t('app', 'Point ID'),
            'planned_period_min' => Yii::t('app', 'Planned Period Min'),
            'price' => Yii::t('app', 'Price'),
            'type' => Yii::t('app', 'Type'),
            'planned_departure_time' => Yii::t('app', 'Departure time'),
        ];
    }
}
