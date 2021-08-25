<?php

namespace common\models\wrappers;

use common\models\Point;
use common\models\Route;
use common\models\RoutePoint;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%tbl_route}}".
 *
 * @property integer $id
 * @property integer $route_no
 * @property integer $points
 * @property string $length
 * @property integer $cycle_min
 * @property integer $planned_period_min
 * @property integer $region
 * @property integer $type
 * @property integer $price
 * @property string $waypoints
 * @property string $waypoints_back
 */
class RouteWrapper extends Route
{
    public function getPointList()
    {
        return ArrayHelper::map(PointWrapper::find()->with('translations')->where(['status'=>'1'])->all(), 'id', 'name');
    }

    public function getPointOptionList()
    {
        $points = PointWrapper::find()->where(['status'=>'1'])->all();
        $options = [];
        foreach ($points as $point) {
            $options[$point->id] = array('data-lat' => $point->latitude, 'data-lng' => $point->longitude);
        }
        return $options;
    }

    public function getBusImage()
    {
        return Html::img(Url::to('@web/source/img/yellow-bus-icon.png'));
    }

    public function getPoints()
    {
        return $this->hasMany(PointWrapper::className(), ['id' => 'point_id'])
            ->viaTable('tbl_route_point', ['route_id' => 'id'])
            ->orderBy('id');
    }



    public function setWayPoints()
    {
//        $points = $this->points;
        $routePoints = RoutePointWrapper::find()->where('route_id=:route_id', [':route_id' => $this->id])->orderBy('id')->all();

        $pointsString = "";

        foreach ($routePoints as $routePoint) {
            $onepoint = $routePoint->point;
            $pointsString .= "[$onepoint->latitude,$onepoint->longitude],";
        }

        $this->waypoints = '{"waypoints":[' . substr($pointsString, 0, -1) . ']}';

        $this->update(false);
    }


    // public function getFromPoint()
    // {
    //     return $this->hasOne(PointWrapper::className(), ['id' => 'from_point_id']);
    // }

    // public function getToPoint()
    // {
    //     return $this->hasOne(PointWrapper::className(), ['id' => 'to_point_id']);
    // }

    const TYPE_COMING = 0;
    const TYPE_GOING = 1;
    const TYPE_BETWEEN_CITY = 2;

    public static function getTypeOptions()
    {
        return array(
            self::TYPE_COMING => Yii::t('app', 'TYPE_COMING'),
            self::TYPE_GOING => Yii::t('app', 'TYPE_GOING'),
            self::TYPE_BETWEEN_CITY => Yii::t('app', 'TYPE_BETWEEN_CITY'),
        );
    }

    public function getTypeText()
    {
        $typeOptions = $this->getTypeOptions();
        return isset($typeOptions[$this->type]) ? $typeOptions[$this->type] : '';
    }


    const REGION_BALKAN = 1, REGION_AHAL = 2, REGION_MARY = 3, REGION_LEBAP = 4, REGION_DASHOGUZ = 5, REGION_ASHGABAT = 6;

    public static function getRegionOptions()
    {
        return array(
            self::REGION_ASHGABAT => Yii::t('app', 'REGION_ASHGABAT'),
            self::REGION_BALKAN => Yii::t('app', 'REGION_BALKAN'),
            self::REGION_AHAL => Yii::t('app', 'REGION_AHAL'),
            self::REGION_MARY => Yii::t('app', 'REGION_MARY'),
            self::REGION_LEBAP => Yii::t('app', 'REGION_LEBAP'),
            self::REGION_DASHOGUZ => Yii::t('app', 'REGION_DASHOGUZ'),
        );
    }

    public function getRegionText()
    {
        $regionOptions = $this->getRegionOptions();
        return isset($regionOptions[$this->region]) ? $regionOptions[$this->region] : '';
    }

}
