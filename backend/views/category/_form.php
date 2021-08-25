<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\CategoryWrapper */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-wrapper-form">

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

    <?= $form->field($model, 'url_prefix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($model->getParentCategoryList($model->id), ['prompt' => Yii::t('backend', 'Select Parent')]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'top')->checkbox() ?>

    <?= $form->field($model, 'status')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
