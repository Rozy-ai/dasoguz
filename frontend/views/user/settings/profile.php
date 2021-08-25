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
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('app', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Html::encode($this->title) ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <?php $form = ActiveForm::begin([
                            'id' => 'profile-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                                'labelOptions' => ['class' => 'col-lg-3 control-label'],
                            ],
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                            'validateOnBlur' => false,
                        ]); ?>

                        <?= $form->field($model, 'name')->label(yii::t('app', 'name')) ?>
                        <?= $form->field($model, 'surname')->label(yii::t('app', 'surname')) ?>
                        <?php // $form->field($model, 'license') ?>
                        <?= $form->field($model, 'phone')->label(yii::t('app', 'Phone number')) ?>
                        <?= $form->field($model, 'public_email')->label(yii::t('app', 'Public Email')) ?>

                        <?php // $form->field($model, 'address') ?>
                        <?php // $form->field($model, 'company') ?>
                        <?php // $form->field($model, 'bio')->textarea() ?>



                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="ad-wrapper-form">
                            <?php
                            $document = $model->document;
                            if (!isset($document)) {
                                $model->document_id = null;
                            }
                            ?>
                            <?php
                            echo \common\widgets\dropzone\DropZoneYii2::widget([
                                'dropzoneName' => 'userProfileDropzone',
                                'inputId' => 'userProfile',
                                'mockFiles' => $model->makeMockFiles($document),
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
                            <?= $form->field($model, 'document_id')->hiddenInput(['id' => "userProfile"])->label("") ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
