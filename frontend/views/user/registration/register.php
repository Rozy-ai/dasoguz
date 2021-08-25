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
<div class="center_center">
    <div class="register_logo">
        <a class="logo" href="<?=yii::$app->homeUrl;?>" style="text-decoration: none;">
            <span style="font-weight: 600;
    font-size: 30px;
    padding: 0 3px;"><span style="color: #fdab01;">özişim</span></span>
        </a>
    </div>
    <div id="content">

        <?php $form = ActiveForm::begin([
            'id'                     => 'registration-form',
            'options' =>[
                'class' => 'formBone',
            ],
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
        ]); ?>



        <h1><?=yii::t('app', 'Create account')?></h1>


        <div class="row">
            <?= $form->field($model, 'email',[
                'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'ctrl w100p', 'tabindex' => '1','placeholder'=>$model->getAttributeLabel('email')],
                'labelOptions' =>['class'=>'control-label'],
            ])->label(yii::t('app','Email')) ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'username',[
                'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'ctrl w100p', 'tabindex' => '1','placeholder'=>$model->getAttributeLabel('username')],
                'labelOptions' =>['class'=>'control-label'],
            ])->label(yii::t('app','Username')) ?>
        </div>

        <div class="row">
            <?php if ($module->enableGeneratingPassword == false): ?>
                <?= $form->field($model, 'password',[
                    'inputOptions' => ['placeholder'=>$model->getAttributeLabel('password'), 'class' => 'ctrl w100p'],
                    'labelOptions'=>['class'=>'']
                ])->passwordInput()->label(yii::t('app', 'Password')) ?>
            <?php endif ?>
        </div>


        <ul class="actionBone">
            <li class="fullsize">
                <?= Html::submitButton(Yii::t('app', 'Sign up'), ['class' => 'button']) ?>
            </li>
        </ul>

        <?= Html::a(Yii::t('app', 'Already registered? Sign in!'), ['/user/security/login'],['style' => 'display: block; margin-top: 25px; text-align: center']) ?>


        <?php ActiveForm::end(); ?>

    </div>
</div>

