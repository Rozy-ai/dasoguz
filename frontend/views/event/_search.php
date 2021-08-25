<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\RouteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-wrapper-search">

    <?php
    $locations = \common\models\wrappers\LocationWrapper::find()->where(['or', 'parent_id is null', 'parent_id=0'])->multilingual()->all();
    $locations_filter = [];
    foreach ($locations as $location) {
        $locations_filter[$location->id] = $location->title;
    }
    ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row ">
        <div class="col-md-5">
            <?= $form->field($model, 'show_title')->textInput(['placeholder' => $model->getAttributeLabel('title')])->label(false) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'location_id')->dropDownList($locations_filter, ['prompt' => $model->getAttributeLabel('location_id')])->label(false) ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('<i class="fa fa-search"></i> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-success btn-lg', 'style' => 'width:100%']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
