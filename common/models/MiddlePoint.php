<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_middle_point}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $latitude
 * @property string $longitude
 * @property integer $status
 */
class MiddlePoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_middle_point}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

            public function getRoutes(){
        return $this->hasMany(Route::className(),['id'=>'route_id'])->viaTable('route_middle',['middle_point_id'=>'id']);
    }

    public function getSelectedRoutes()
    {
        $selectedIds = $this->getRoutes()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedIds, 'id');
    }
    public function saveRoutes($routes){
        if (is_Array($routes)){
           $this->clearCurrentRoutes();
            foreach($routes as $route_id){
                $route = Route::findOne($route_id);
                $this->link('routes',$route);
            }
        }
    }

     public function clearCurrentRoutes()
    {
        RouteMiddle::deleteAll(['middle_point_id'=>$this->id]);
    }

    /**
     * Gets query for [[routeMiddle]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getRouteMiddles()
    {
        return $this->hasMany(RouteMiddle::className(), ['middle_point_id' => 'id']);
    }

    /**
    //  * {@inheritdoc}
    //  * @return EmployeeQuery the active query used by this AR class.
    //  */
    // public static function find()
    // {
    //     return new EmployeeQuery(get_called_class());
    // }
}
