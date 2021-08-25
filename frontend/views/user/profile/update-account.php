<?php
    use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="user_info">

    <?php

    $form = ActiveForm::begin([
        'id' => 'item-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <?= $form->field($usermodel, 'username' . $lang)->textInput(['maxlength' => true]) ?>
    <?= $form->field($usermodel, 'email' . $lang)->textInput(['maxlength' => true]) ?>
    <?= $form->field($usermodel, 'password' . $lang)->passwordInput() ?>


            <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>

    <?php ActiveForm::end(); ?>
</div>