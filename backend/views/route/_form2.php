<?php

use common\widgets\leafletRouter\LeafletRouterWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\RouteWrapper */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-wrapper-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_no')->textInput() ?>

    <?= $form->field($model, 'from_point_id')->dropDownList($model->getPointList(), ['options' => $model->getPointOptionList()]) ?>

    <?= $form->field($model, 'to_point_id')->dropDownList($model->getPointList(), ['options' => $model->getPointOptionList()]) ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cycle_min')->textInput() ?>

    <?= $form->field($model, 'planned_period_min')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'region')->dropDownList($model->getRegionOptions()) ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions()) ?>

    <?= $form->field($model, 'waypoints')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'waypoints_back')->hiddenInput()->label(false) ?>

    <div class="col-lg-6 col-md-12">
        <?= Html::label(Yii::t('app', 'coordination')) ?>
        <?php
        echo LeafletRouterWidget::widget([
            "cssId" => "map",
            "height" => 500,
            "defWaypointsId" => "routewrapper-waypoints",
            "type" => "draw",
            "widgetNumber" => 1,
        ]);
        ?>

    </div>
    <div class="col-lg-6 col-md-12">
        <?= Html::label(Yii::t('app', 'coordination')) ?>
        <?php
        echo LeafletRouterWidget::widget([
            "cssId" => "map_back",
            "height" => 500,
            "defWaypointsId" => "routewrapper-waypoints_back",
            "type" => "draw",
            "widgetNumber" => 2,
        ]);
        ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

