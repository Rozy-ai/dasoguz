<?php

use common\models\wrappers\RouteWrapper;
use common\widgets\leafletRouter\LeafletRouterWidget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\RouteWrapper */

$this->title = Yii::t('app', 'Route') . ": " . $model->route_no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Route Wrappers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$isBetweenCityType = $model->type == RouteWrapper::TYPE_BETWEEN_CITY;
?>
<div class="route-wrapper-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Points'), ['points', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'route_no',
            'length',
            'cycle_min',
            'planned_period_min',
            [
                'attribute' => 'region',
                'value' => $model->getRegionText()
            ],
            [
                'attribute' => 'type',
                'value' => $model->getTypeText()
            ],
        ],
    ]) ?>

    <p>
        <?= $isBetweenCityType ? Html::a("<i class='fa fa-plus'></i> " . Yii::t('app', 'Add point'), ['route/add-point', 'route_id' => $model->id, 'route_point_id' => 0], ['class' => 'btn btn-success']) : "" ?>
    </p>
</div>

<?php
if ($isBetweenCityType) {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'point_id',
                'value' => function ($data) {
                    $point = \common\models\wrappers\PointWrapper::findOne($data->point_id);
                    if (isset($point))
                        return $point->name;

                    return "";
                },
            ],
            [
                'attribute' => 'planned_departure_time',
                'value' => function ($data) {
                    return $data->planned_departure_time;
                },
            ],
            [
                'attribute' => 'planned_period_min',
                'value' => function ($data) {
                    return $data->planned_period_min . ' min';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'price',
                'value' => function ($data) {
                    return $data->price . ' man';
                },
                'format' => 'html',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['width' => '100px', 'class' => 'activity-view-link',],
                'contentOptions' => ['style' => 'text-align:right'],
                'buttons' => array (
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-pencil"></span>', Url::to(['/route/add-point', 'route_id' => $model->route_id, 'route_point_id' => $model->id]));
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-trash"></span>', Url::to(['/route/delete-point', 'id' => $model->id]), [
                            'data' => [
                                'confirm' => 'Pozmak islemegiňiz çynmy?',
                                'method' => 'post',
                            ]
                        ]);
                    },
                ),
                'options' => ['width' => '120'],
            ],
        ],
    ]);
}
?>

<div class="col-lg-12 col-md-12">
    <?php
    if (!$isBetweenCityType) {
        echo Html::hiddenInput("waypoints", $model->waypoints, ["id" => "waypoints"]);
        echo Html::hiddenInput("waypoints_back", $model->waypoints, ["id" => "waypoints_back"]);
//        LeafletRouterWidget::widget([
//            "cssId" => "map",
//            "height" => 500,
//            "defWaypointsId" => "waypoints",
//            "type" => "draw",
//            "widgetNumber" => 1,
//            "routeId" => $model->id,
//        ]);

        ?>
        <div class="col-lg-6 col-md-12">
            <?= Html::label(Yii::t('app', 'coordination')) ?>
            <?php
            // echo LeafletRouterWidget::widget([
            //     "cssId" => "map_one",
            //     "routeId" => $model->id,
            //     "height" => 400,
            //     "defWaypointsId" => "waypoints",
            //     "type" => "draw",
            //     "widgetNumber" => 1,
            // ]);
            ?>

        </div>
        <div class="col-lg-6 col-md-12">
            <?= Html::label(Yii::t('app', 'coordination')) ?>
            <?php
            // echo LeafletRouterWidget::widget([
            //     "cssId" => "map_back",
            //     "routeId" => $model->id,
            //     "height" => 400,
            //     "defWaypointsId" => "waypoints_back",
            //     "type" => "draw",
            //     "widgetNumber" => 2,
            // ]);
            ?>
        </div>
        <?php
    }
    ?>
</div>
