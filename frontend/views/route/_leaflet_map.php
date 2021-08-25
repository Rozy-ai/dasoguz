<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\RouteWrapper */
/* @var $form yii\widgets\ActiveForm */

$title = Yii::t('app', 'Route No') . ": <b>" . $model->route_no . '</b>  -  (' . $model->fromPoint->name . " - " . $model->toPoint->name . ')';
?>

<div class="modal-body">
    <h4 class="modal-title"><?= $title ?></h4>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'waypoints')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'waypoints_back')->hiddenInput()->label(false) ?>
    <?php

    echo \common\widgets\leafletRouter\LeafletRouterWidget::widget([
        "cssId" => "mapId",
        "height" => 500,
        "defWaypointsId" => "routewrapper-waypoints",
        "secWaypointsId" => "routewrapper-waypoints_back",
    ]);
    ?>
    <?php ActiveForm::end(); ?>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
</div>


