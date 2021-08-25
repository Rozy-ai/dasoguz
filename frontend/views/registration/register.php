<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('app', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module form-module">
    <div class="">
    </div>
    <div class="form">

    <?php $form = ActiveForm::begin([
        'id'                     => 'registration-form',
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'email',[
            'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>$model->getAttributeLabel('email')],
            'labelOptions' =>['class'=>'control-label'],
    ]) ?>

    <?= $form->field($model, 'username',[
        'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>$model->getAttributeLabel('username')],
        'labelOptions' =>['class'=>'control-label'],
    ]) ?>

    <?php if ($module->enableGeneratingPassword == false): ?>
        <?= $form->field($model, 'password',[
            'inputOptions' => ['placeholder'=>$model->getAttributeLabel('password')],
            'labelOptions'=>['class'=>'control-label ']
        ])->passwordInput() ?>
    <?php endif ?>

    <?= Html::submitButton(Yii::t('app', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

    <?php ActiveForm::end(); ?>
    <!--            </div>
            </div>-->
    <p class="text-center">
        <?= Html::a(Yii::t('app', 'Already registered? Sign in!'), ['/user/security/login']) ?>
    </p>
    </div>

</div>

