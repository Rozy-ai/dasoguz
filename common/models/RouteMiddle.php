<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_middle".
 *
 * @property int $id
 * @property int|null $route_id
 * @property int|null $middle_point_id
 *
 * @property Route $route
 * @property Middle Point $middlePoint
 */
class RouteMiddle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_middle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_id', 'middle_point_id'], 'integer'],
            [['route_id'], 'exist', 'skipOnError' => true, 'targetClass' => Route::className(), 'targetAttribute' => ['route_id' => 'id']],
            [['middle_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => MiddlePoint::className(), 'targetAttribute' => ['middle_point_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_id' => 'Route ID',
            'middle_point_id' => 'Middle Point ID',
        ];
    }

    /**
     * Gets query for [[Route]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(Route::className(), ['id' => 'route_id']);
    }

    /**
     * Gets query for [[Middle Point]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMiddlePoint()
    {
        return $this->hasOne(MiddlePoint::className(), ['id' => 'middle_point_id']);
    }
}
