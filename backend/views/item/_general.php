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
echo $this->render('_content', [
    'model' => $model,
    'form' => $form,
])
?>
<?=$form->field($model, 'date_event' )->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,

    ]
])->label('Çäraniň geçiriljek wagty');
?>
<?=$form->field($model, 'date_created' )->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,

    ]
])->label('Hacan döredildi');
?>


<?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList(), ['prompt' => '--Select CATEGORY--',
    'options' => $model->getCategoryCodeDataList()]) ?>




<?= $form->field($model, 'status')->checkbox() ?>
<?= $form->field($model, 'is_main')->checkbox() ?>
<?= $form->field($model, 'is_menu')->checkbox() ?>


