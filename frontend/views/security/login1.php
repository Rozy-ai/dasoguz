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
<!-- Form Module-->
<div class="module form-module">
    <div class="">
    </div>
    <div class="form">
        <h2><?=yii::t('app', 'Sign in')?></h2>
        <?php $form = ActiveForm::begin([
            'id'                     => 'login-form',
            'class'                     => 'login-form',
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
        ]) ?>
            <?= $form->field(
                $model,
                'login',
                [
                    'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>$model->getAttributeLabel('login')],
                    'labelOptions'=>['class'=>'control-label']
                ]
            ) ?>
        <?= $form
            ->field(
                $model,
                'password',
                [
                    'inputOptions' => ['placeholder'=>$model->getAttributeLabel('password')],
                    'labelOptions'=>['class'=>'control-label ']
                ]
            )
            ->passwordInput()
            ->label(
                Yii::t('app', 'Password')

            ) ?>

        <?= Html::submitButton(
            Yii::t('app', 'Sign in')
        ) ?>

        <?php ActiveForm::end(); ?>

    </div>
<!--    <div class="cta"><a href="http://andytran.me">Açarsözi unutdym?</a></div>-->
    <?php if ($module->enableRegistration): ?>
    <button  >
<!--            --><?//=Yii::t('user', 'Don\'t have an account? Sign up!')?>
            <?= Html::a(Yii::t('app', 'Don\'t have an account? Sign up!'), ['/user/registration/register'],['style' => 'color:#fff;text-decoration:none;display:block;']) ?>
    </button>
        <?php endif ?>



    
</div>
<?= Connect::widget([
    'baseAuthUrl' => ['/user/security/auth'],
]) ?>









<!---->
<!--<div class="form">-->
<!--    <h2>Registrasiýa etmek</h2>-->
<!--    <form>-->
<!--        <input type="text" placeholder="Adyňyz"/>-->
<!--        <input type="password" placeholder="Gizlin kod"/>-->
<!--        <input type="email" placeholder="Email poçtanyň"/>-->
<!--        <input type="tel" placeholder="Telefon nomeryňyz"/>-->
<!--        <button>Registrasiýa</button>-->
<!--    </form>-->
<!--</div>-->
<!---->
<!---->
<!---->



