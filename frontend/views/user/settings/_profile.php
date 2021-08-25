<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Profile $profile
 */
//var_dump($profile->GetDocument());
?>

<?php $this->beginContent('@frontend/views/user/settings/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

<div class="row">
    <div class="col-sm-8">
        <?= $form->field($profile, 'name') ?>
        <?= $form->field($profile, 'surname') ?>
        <?= $form->field($profile, 'license') ?>
        <?= $form->field($profile, 'phone') ?>
        <?= $form->field($profile, 'public_email') ?>

        <?= $form->field($profile, 'address') ?>
        <?= $form->field($profile, 'company') ?>
        <?= $form->field($profile, 'bio')->textarea() ?>
        <?php
        $document = $profile->document;
        if (!isset($document)) {
            $profile->document_id = null;
        }
        ?>
        <?php
        echo \common\widgets\dropzone\DropZoneYii2::widget([
            'dropzoneName' => 'userProfileDropzone',
            'inputId' => 'userProfile',
            'mockFiles' => $profile->makeMockFiles($document),
            'uploadUrl' => '/document/upload',
            'deleteUrl' => '/document/deleteupload',
            'enableMetadataEdit' => false,
            'options' => [
                'maxFilesize' => 100,
                'maxFiles' => 1,
                'acceptedFiles' => 'image/*'
            ]
        ]);
        ?>
        <?= $form->field($profile, 'document_id')->input(['id' => "userProfile"])->label("") ?>
    </div>


    <div class="col-sm-4">
        <div class="ad-wrapper-form">

        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
