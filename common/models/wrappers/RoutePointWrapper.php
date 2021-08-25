<?php

namespace common\models\wrappers;

use common\models\RoutePoint;
use yii\helpers\ArrayHelper;

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
class RoutePointWrapper extends RoutePoint
{
    public function getPointList()
    {
        
        return ArrayHelper::map(PointWrapper::find()->all(), 'id', 'name');
    }

    public function getPoint()
    {
        return $this->hasOne(PointWrapper::class, ['id' => 'point_id']);
    }

    public static function savePoint($route_id, $point_id)
    {
        $model = new RoutePoint();
        $model->point_id = $point_id;
        $model->route_id = $route_id;
        $model->save(false);
    }

}
