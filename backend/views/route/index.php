<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\wrappers\PointWrapper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Route Wrappers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-wrapper-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Route Wrapper'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'options' => ['width' => '80px']
            ],
            [
                'attribute' => 'route_no',
                'value' => function ($data) {
                    return 'No: ' . $data->route_no;
                },
                'format' => 'html',
                'options' => ['width' => '100px']
            ],
            [
                'attribute' => 'region',
                'filter' => $searchModel->getRegionOptions(),
                'value' => function ($data) {
                    return $data->getRegionText();
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'type',
                'filter' => $searchModel->getTypeOptions(),
                'value' => function ($data) {
                    return $data->getTypeText();
                },
                'format' => 'html',
            ],
            // [
            //     'attribute' => 'from_point_id',
            //     'filter' => $searchModel->getPointList(),
            //     'value' => function ($data) {
            //                     $points = json_decode($data->points);

            //                     $count = count($points);
            //                     if ($count > 0) {
            //                       $keys = array_keys($points);
            //                       $firstKey = $keys[0];
            //                       $firstValue = $points[$firstKey];
            //                     }

            //                     $fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
            //         if (isset($fromPoint))
            //             return $fromPoint->name;
            //         return "-";
            //     },
            //     'format' => 'html',
            // ],
            // [
            //     'attribute' => 'to_point_id',
            //     'filter' => $searchModel->getPointList(),
            //     'value' => function ($data) {
            //                      $points = json_decode($data->points);

            //                     $count = count($points);
            //                     if ($count > 0) {
            //                       $keys = array_keys($points);
            //                       $lastKey = $keys[$count - 1];
            //                       $lastValue = $points[$lastKey];
            //                     }

            //                     $toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
            //                      if(isset($toPoint))
            //                        return $toPoint->name ;
            //         return "-";
            //     },
            //     'format' => 'html',
            // ],
            [
                'attribute' => 'length',
                'value' => function ($data) {
                    return (float)$data->length . ' km';
                },
                'format' => 'html',
                'options' => ['width' => '120px']
            ],
            [
                'attribute' => 'cycle_min',
                'value' => function ($data) {
                    return $data->cycle_min . ' min';
                },
                'format' => 'html',
                'options' => ['width' => '120px']
            ],
            [
                'attribute' => 'planned_period_min',
                'value' => function ($data) {
                    return $data->planned_period_min . ' min';
                },
                'format' => 'html',
                'options' => ['width' => '120px']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['width' => '120px']
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
