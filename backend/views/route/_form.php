<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\RouteWrapper */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="route-wrapper-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <div class="route_type">
            <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions()) ?>
        </div>

        <?= $form->field($model, 'route_no')->textInput() ?>
        <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'cycle_min')->textInput() ?>

        <?php
        $initial_sources_css = '';
        if (isset($model->type) && $model->type == \common\models\wrappers\RouteWrapper::TYPE_BETWEEN_CITY) {
            $initial_sources_css = "hidden";
        }
        ?>
        <div class="internal_route <?= $initial_sources_css ?>">
            <?= $form->field($model, 'price')->textInput() ?>
            <?= $form->field($model, 'planned_period_min')->textInput() ?>
            <?= $form->field($model, 'region')->dropDownList($model->getRegionOptions()) ?>
        </div>

        <?php
         // echo $form->field($model, 'from_point_id')->dropDownList($model->getPointList(), ['options' => $model->getPointOptionList(), 'prompt' => '-']) 
         ?>
        <?php
         // echo $form->field($model, 'to_point_id')->dropDownList($model->getPointList(), ['options' => $model->getPointOptionList(), 'prompt' => '-']) 
         ?>
<?= 
          $form->field($model, 'points')->textInput() 
  ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


<?php
$script = <<< JS
$(document).on('change', '.route_type select', function() {
    debugger;
    var type=$(this).find("option:selected" ).val();
    var internal_route=$(this).parents('form').find('.internal_route');
    // $('select#eventwrapper-sources').val('').trigger('change');
    if(type==2){
              internal_route.slideUp();      
           
    }else{
      internal_route.removeClass('hidden');
        internal_route.slideDown();   
    }
});

JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>











<!-- 1 gidyan  ["2","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","5"]

14 gidyan  ["3","73","85","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","61","128","129","130","131","132","135","136","137","141","140","139","138","133","134","11"]




14 gelyan  ["11","139","142","14144","145","146","137","148","149","150","151","152","153","154","147","108","84","122","155","156","157","158","159","160","161","162","113","112","111","164","107","3"] -->