<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Sign in');
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
            'id'                     => 'login-form',
            'options' => [
                'class' => 'formBone',
            ],
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
        ]) ?>


        <h1><?=yii::t('app', 'Login to your account')?></h1>



        <div class="row">
            <?= $form->field(
                $model,
                'login',
                [
                    'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'ctrl w100p', 'tabindex' => '1','placeholder'=>$model->getAttributeLabel('login')],
                    'labelOptions'=>[]
                ]
            )->label(yii::t('app','Login')) ?>
        </div>

        <div class="row">
            <?= $form
                ->field(
                    $model,
                    'password',
                    [
                        'inputOptions' => ['placeholder'=>$model->getAttributeLabel('password'),'class' => 'ctrl w100p'],
                        'labelOptions'=>['class'=>'control-label ']
                    ]
                )
                ->passwordInput()
                ->label(
                    Yii::t('app', 'Password')."<span class='floatRight'>".html::a(yii::t('app','Forgot password?'),['/user/recovery/request'])."</span>"

                )

            ?>
        </div>

        <ul class="actionBone">
            <li class="fullsize">
                <?= Html::submitButton(
                    Yii::t('app', 'Sign in'),['class' => 'button']
                ) ?>
            </li>
        </ul>
        <?php if ($module->enableRegistration): ?>
            <?= Html::a(Yii::t('app', "Don't have an account? Sign up!"), ['/user/registration/register'],['style' => 'display: block; margin-top: 25px; text-align: center']) ?>
        <?php endif ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>


<?= Connect::widget([
    'baseAuthUrl' => ['/user/security/auth'],
]) ?>








