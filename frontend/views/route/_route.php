<?php

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\RouteSearch */
/* @var $form yii\widgets\ActiveForm */

$fromPoint = $model->fromPoint;
$toPoint = $model->toPoint;

$routePoints = \common\models\wrappers\RoutePointWrapper::find()->where('route_id=:route_id', [':route_id' => $model->id])->orderBy('price')->all();
?>
<div class="route-wrapper-search">

    <div class="routes-table mbot-5">
        <div id="w1" class="grid-view">
            <h4 style="font-size:24px;font-weight:600;">
                <?= Html::a('<i class="fas fa-map-marked"></i> ', ['/route/map', 'id' => $model['id']], ['class' => 'addData',]) ?>
                <?= "№" . $model->route_no . " / " . (isset($fromPoint) ? $fromPoint->name : "") . " - " . (isset($toPoint) ? $toPoint->name : "") ?>
            </h4>
            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th></th>
                    <th>Duralgalar:</th>
                    <th>Wagty:</th>
                    <th>Bahasy:</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($routePoints as $routePoint) {
                    ?>
                    <tr>
                        <td><?= $model->getBusImage() ?></td>
                        <td style="text-align: left;"><h5><?= $routePoint->point->name ?></h5></td>
                        <td><h5><?= $routePoint->planned_departure_time ?></h5></td>
                        <td><h5><?= $routePoint->price == 0 ? "-" : $routePoint->price . " man." ?></h5></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
