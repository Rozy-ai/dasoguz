<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tbl_route}}".
 *
 * @property integer $id
 * @property integer $route_no
 * @property integer $points
 * @property string $length
 * @property integer $cycle_min
 * @property integer $planned_period_min
 * @property string $price
 * @property integer $region
 * @property integer $type
 * @property string $waypoints
 * @property string $waypoints_back
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_route}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_no', 'length', 'cycle_min'], 'required'],
            [['route_no', 'cycle_min', 'planned_period_min', 'region', 'type'], 'integer'],
            [['length', 'price'], 'number'],
            [['waypoints', 'waypoints_back', 'points'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'route_no' => Yii::t('app', 'Route No'),
            'points' => Yii::t('app', 'Points'),
            'length' => Yii::t('app', 'Length'),
            'cycle_min' => Yii::t('app', 'Cycle Min'),
            'planned_period_min' => Yii::t('app', 'Planned Period Min'),
            'price' => Yii::t('app', 'Price'),
            'region' => Yii::t('app', 'Region'),
            'type' => Yii::t('app', 'Type'),
            'waypoints' => Yii::t('app', 'Waypoints'),
            'waypoints_back' => Yii::t('app', 'Waypoints Reverse'),
        ];
    }


    /**
    //  * {@inheritdoc}
    //  * @return JobQuery the active query used by this AR class.
    //  */
    // public static function find()
    // {
    //     return new RouteQuery(get_called_class());
    // }

    //  public function getPoints(){
    //     return $this->hasMany(Point::className(),['id'=>'middle_point_id'])->viaTable('route_middle',['route_id'=>'id']);
    // }

    // public function getSelectedPoints()
    // {
    //     $selectedIds = $this->getPoints()->select('id')->asArray()->all();
    //     return ArrayHelper::getColumn($selectedIds, 'id');
    // }

    // public function savePoints($points){
    //     if (is_Array($points)){
    //         // serialize($points);
    //         return $this->save(false);
    //         // foreach($points as $point){
    //         //     $point = Point::findOne($point);
    //         //                 var_dump($point);die;
    //         //     $this->link('middlePoints',$point);
    //         // }
    //     }
    // }

    // public function clearCurrentMiddlePoints()
    // {
    //     RouteMiddle::deleteAll(['route_id'=>$this->id]);
    // }
}
