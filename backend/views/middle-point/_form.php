<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\MiddlePointWrapper */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="point-wrapper-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    $languages = $model->languages;
    if (isset($languages)) {
        $items = [];
        foreach ($languages as $lang) {
            $items[] = [
                'label' => Yii::t('app', $lang),
                'content' => $this->render('_lang', [
                    'model' => $model,
                    'form' => $form,
                    'lang' => $lang,
                ]),
            ];
        }

        echo \yii\bootstrap\Tabs::widget([
            'items' => $items
        ]);
    }
    ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'latitude')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'longitude')->hiddenInput()->label(false) ?>

    <?= Html::label(Yii::t('app', 'coordination')) ?>

    <?php
    echo \common\widgets\leaflet\LeafletWidget::widget([
        'height' => 500,
        'latId' => 'middlepointwrapper-latitude',
        'lngId' => 'middlepointwrapper-longitude',
        'lat' => $model->latitude,
        'lng' => $model->longitude,
        'zoom' => 13,
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

