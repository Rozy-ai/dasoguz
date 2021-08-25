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


<?php
echo $this->render('work_content', [
    'model' => $model,
    'form' => $form,
])
?>

<?= $form->field($model, 'status')->checkbox() ?>



