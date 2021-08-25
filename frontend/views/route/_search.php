<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\RouteSearch */
/* @var $form yii\widgets\ActiveForm */
// var_dump($search['RouteSearch']['point_from']);die;
?>

<div class="route-wrapper-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <!--    --><?php //$form = \yii\bootstrap\ActiveForm::begin([
    //        'enableClientValidation' => false,
    //        'action' => ['index'],
    ////                    'layout' => 'horizontal',
    //        'fieldConfig' => [
    //            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    //            'horizontalCssClasses' => [
    //                'label' => 'col-sm-3 col-md-3',
    //                'offset' => 'col-sm-offset-3 ',
    //                'wrapper' => 'col-sm-9',
    //                'error' => '',
    //                'hint' => '',
    //            ],
    //        ],
    //    ]);
    ?>
    <div class="row ">
        <div class="col-md-2">
            <?= $form->field($model, 'route_no')->textInput(['placeholder' => Yii::t('app', 'route_no')])->label(false) ?>
        </div>
        <div class="col-md-4">

            <?php if(!empty($search['RouteSearch']['point_from'])): ?>
            <?= $form->field($model, 'point_from')->dropDownList($model->getPointList(), ['value' => $search['RouteSearch']['point_from'] ])->label(false) ?>
            <?php else: ?>
                <?= $form->field($model, 'point_from')->dropDownList($model->getPointList(), [
                    'prompt' => Yii::t('app', 'From point'),
                ])->label(false) ?>
        <?php endif; ?>

        </div>
        <div class="col-md-4">

            <?php if(!empty($search['RouteSearch']['point_to'])): ?>
            <?= $form->field($model, 'point_to')->dropDownList($model->getPointList(), ['value' => $search['RouteSearch']['point_to'] ])->label(false) ?>
            <?php else: ?>
                <?= $form->field($model, 'point_to')->dropDownList($model->getPointList(), [
                    'prompt' => Yii::t('app', 'To point')
                ])->label(false) ?>
        <?php endif; ?>
            
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('<img src="/source/img/Vector.png" style="float:right;margin-left: 20px;" alt="search"> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-success btn-lg', 'style' => 'background: #325D56;']) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'from_point_id')->dropDownList($model->getPointList(),['prompt'=>Yii::t('app','Choose direction')]) ?>
    <?php // echo $form->field($model, 'to_point_id')->dropDownList($model->getPointList(),['prompt'=>Yii::t('app','Choose direction')]) ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'cycle_min') ?>

    <?php // echo $form->field($model, 'planned_period_min') ?>

    <!--    --><?php //\yii\bootstrap\ActiveForm::end(); ?>

    <?php ActiveForm::end(); ?>

    <?php
    //    $sorted_by = isset($_GET['sort']) ? $_GET['sort'] : '';
    //    echo "<ul>";
    //    echo '<li>' . Html::a(Yii::t('app', 'shortest length'), \yii\helpers\Url::to(['index', 'sort' => 'length']), ['class' => $sorted_by == 'length' ? "selected" : ""]) . '</li>';
    //    echo '<li>' . Html::a(Yii::t('app', 'shortest cycle_min'), \yii\helpers\Url::to(['index', 'sort' => 'cycle_min']), ['class' => $sorted_by == 'cycle_min' ? "selected" : ""]) . '</li>';
    ?>
</div>

