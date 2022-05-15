<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\ItemWrapper */
/* @var $form yii\widgets\ActiveForm */

?>
<?= $form->field($model, 'docs')->hiddenInput(['id' => "item"])->label("") ?>
<?php
echo \common\widgets\dropzone\DropZoneYii2::widget([
    'dropzoneName' => 'itemDropzone',
    'inputId' => 'item',
    'mockFiles' => $model->makeMockFiles($model->documents),
    'uploadUrl' => '/document/upload',
    'deleteUrl' => '/document/deleteupload',
    'options' => [
        'maxFilesize' => 100,
        'acceptedFiles' => 'image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf'
    ]
]);
?>

