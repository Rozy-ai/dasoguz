<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\RoutePoint */
/* @var $route \common\models\wrappers\RouteWrapper */
/* @var $form yii\widgets\ActiveForm */


$this->title = Yii::t('app', 'Create Route Point');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Route Wrappers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Route') . ": " . $route->route_no, 'url' => ['view', 'id' => $route->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-wrapper-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(["enableClientValidation" => false]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'route_id')->hiddenInput(["value" => $route->id])->label(false) ?>

    <?= $form->field($model, 'point_id')->dropDownList($route->getPointList(), ['options' => $route->getPointOptionList()]) ?>

    <?= $form->field($model, 'planned_period_min')->textInput() ?>

    <?= $form->field($model, 'planned_departure_time')->textInput(["type" => "time"]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['view', 'id' => $route->id], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>