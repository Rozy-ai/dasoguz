<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = Yii::t('app', 'Order');
$this->params['breadcrumbs'][] = $this->title;
$lat = isset($ownInfo->my_latitude) ? $ownInfo->my_latitude : "0";
$lng = isset($ownInfo->my_longitude) ? $ownInfo->my_longitude : "0";
//$this->registerJsFile('http://maps.google.com/maps/api/js?key=AIzaSyBDJ1dE9OjJtp33gBzRMad6iasRnAW_4xQ&libraries=places', ['depends' => [\yii\web\JqueryAsset::className(), \yii\bootstrap\BootstrapAsset::className()]]);
//$this->registerJsFile('https://api-maps.yandex.ru/2.1/?apikey=aa8b1537-d8d3-4049-bd5e-68df6b1e5a67&lang=ru_RU',['position' => \yii\web\View::POS_HEAD,'depends' => [\yii\web\JqueryAsset::className(), \yii\bootstrap\BootstrapAsset::className()]]);
?>


<div class="contact_section">
    <div class="container">
        <div class="row">
            <h2 class="text-uppercase decorated"><span><?= Yii::t('app', 'Ordering') ?></span></h2>
            <div class="contact-text right-side">
                <?php $form = ActiveForm::begin([
                    'id' => 'order-form']); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'name')->textInput(['placeholder' =>Yii::t('app', 'name'), 'class' => 'form-control input-lg'])->label("") ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'email')->textInput(['type' => 'email','placeholder' => Yii::t('app', 'Email'), 'class' => 'form-control input-lg'])->label("") ?>
                    </div>
 <div class="col-md-6 col-sm-6 col-xs-12">
<?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+\9\93 69-99-99-99',
                        'options' => [
                            'class' => 'form-control input-lg',
                            'placeholder' => Yii::t('app', 'Phone number')
                        ],
                        'clientOptions' => [
                            'clearIncomplete' => true
                        ]
                    ])->label("") ?>
 </div>


                
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($model, 'time')->textInput(['type' => 'number','placeholder' => Yii::t('app', 'Duration order'), 'class' => 'form-control input-lg'])->label("") ?>
                </div>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                  <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::className(),
    [ 'dateFormat' => 'php:Y-m-d',
      'clientOptions' => [
        'changeYear' => true,
        'changeMonth' => true,
        'yearRange' => '-50:+1',
        'altFormat' => 'Y-m-d',
      ]],['placeholder' => 'Y-m-d'])
    ->textInput(['placeholder' => \Yii::t('app', 'ý/a/g'),'class'=>'form-control input-lg'])->label("") ;?>
                </div>

<!-- 
                <div class="col-md-6 col-sm-6 col-xs-12"> -->
                    <?php
                     // echo $form->field($model, 'price')->textInput(['type' => 'number','placeholder' => mb_strtoupper($model->getAttributeLabel("Bahasy (sag 4man)")), 'class' => 'form-control input-lg'])->label("") 
                     ?>

        <!--         </div> -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($model, 'where')->textInput(['placeholder' => Yii::t('app', 'Vehicle destination'), 'class' => 'form-control input-lg'])->label("") ?>
                </div>
                <div class="col-xs-12">
                <?= $form->field($model, 'message')->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Message'), "style" => "resize: none;", 'class' => 'form-control input-lg'])->label("") ?>
                </div>
                <div class="form-group input-box col-md-3 col-sm-4 col-xs-8">
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-lg btn-block btn-success', 'name' => 'contact-button']) ?>
                </div>
</div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php

//die;
?>
