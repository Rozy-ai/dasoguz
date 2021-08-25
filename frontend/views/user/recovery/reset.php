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

/*
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('user', 'Reset your password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center_center">

    <div class="register_logo">
        <a href="<?=yii::$app->homeUrl?>">
            <img src="/img/png/logo.png" alt="">
        </a>
    </div>
    <div id="content">
        <?php $form = ActiveForm::begin([
            'id'                     => 'password-recovery-form',
            'options' => [
                'class' => 'formBone'
            ],
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
        ]); ?>

        <h1><?=yii::t('app', 'Change password')?></h1>

        <div class="row">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'ctrl w100p'])->label(yii::t('app', 'New password')) ?>
        </div>

        <ul class="actionBone">
            <li class="fullsize">
                <?= Html::submitButton(Yii::t('app', 'Change'), ['class' => 'button']) ?>
            </li>
        </ul>

        <?php ActiveForm::end(); ?>

    </div>
</div>
