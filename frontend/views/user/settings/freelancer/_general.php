<?php

//$kcfOptions = [
////    'uploadURL' => Yii::getAlias('@web').'/upload',
//    'uploadURL' => Yii::getAlias('@uploads'),
//    'access' => [
//        'files' => [
//            'upload' => true,
//            'delete' => false,
//            'copy' => false,
//            'move' => false,
//            'rename' => false,
//        ],
//        'dirs' => [
//            'create' => true,
//            'delete' => false,
//            'rename' => false,
//        ],
//    ],
//];
//
//// Set kcfinder session options
//Yii::$app->session->set('KCFINDER', $kcfOptions);
//
//echo "<pre>";
//print_r(Yii::$app->session->get('KCFINDER'));
//echo "</pre>";
?>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(yii::t('app', 'Name of announcement')) ?>

<?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList(), ['prompt' => '--'.yii::t('app', 'Select category').'--',
    'options' => $model->getCategoryCodeDataList()]) ?>

<?= $form->field($model, 'about_tk')->textarea()->label(yii::t('app', 'Content').' TM') ?>

<?= $form->field($model, 'about_ru')->textarea()->label(yii::t('app', 'Content').' RU') ?>


<?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(yii::t('app', 'Email')) ?>



<?= $form->field($model, 'phone_number')->textInput()->label(yii::t('app', 'Phone number')) ?>

<?= $form->field($model, 'service_charge')->textInput(['value' => 'Bahany gürleşmeli'])->label(yii::t('app', 'Service charge')) ?>

<?= $form->field($model, 'docs')->hiddenInput(['id' => "freelancer"])->label("") ?>
<?php
echo \common\widgets\dropzone\DropZoneYii2::widget([
    'dropzoneName' => 'freelancerDropzone',
    'inputId' => 'freelancer',
    'mockFiles' => $model->makeMockFiles($model->documents),
    'uploadUrl' => '/document/upload',
    'deleteUrl' => '/document/deleteupload',
    'options' => [
        'maxFilesize' => 100,
        'acceptedFiles' => 'image/*'
    ]
]);
?>




