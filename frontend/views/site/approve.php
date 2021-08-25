<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 ?>
<div class="container">
	<div class="row">
		

		   <?php $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'class' => 'mr_10',
                    'action' => Url::to(['site/order', 'finish' => '1'])
                ]); ?>
                  
                    	<div class="col-xs-12" style="margin: 10% 0">
                    		<div class="list-group">
<ul>
	<li class="list-group-item list-group-item-light"><b>Ady: </b><?=$model->name?></li>
	<?php if(isset($model->email)){ 
		echo "<li class='list-group-item list-group-item-light'><b>Email: </b>".$model->email."</li>";
	} ?>
	<li class="list-group-item list-group-item-light"><b>Telefon: </b><?=$model->phone?></li>
	<li class="list-group-item list-group-item-light"><b>Wagty: </b><?=$model->time?> sagat</li>
	<li class="list-group-item list-group-item-light"><b>Sene: </b><?=$model->date?></li>
	<li class="list-group-item list-group-item-light"><b>Nira: </b><?=$model->where?></li>
	<li class="list-group-item list-group-item-light"><b>Bahasy: <?=$model->price?> manat</b></li>
</ul>
</div>
 			<?= $form->field($model, 'price')->hiddenInput(['value' => $model->price])->label(false) ?>
             
                <?= $form->field($model, 'name')->hiddenInput(['value' => $model->name])->label(false) ?>
                <?= $form->field($model, 'email')->hiddenInput(['value' => $model->email])->label(false) ?>
                <?= $form->field($model, 'name')->hiddenInput(['value' => $model->name])->label(false) ?>
                <?= $form->field($model, 'phone')->hiddenInput(['value' => $model->phone])->label(false) ?>
                <?= $form->field($model, 'time')->hiddenInput(['value' => $model->time])->label(false) ?>
                <?= $form->field($model, 'date')->hiddenInput(['value' => $model->date])->label(false) ?>
                <?= $form->field($model, 'where')->hiddenInput(['value' => $model->where])->label(false) ?>
                 <?= $form->field($model, 'message')->hiddenInput(['value' => $model->message])->label(false) ?>

             
                    	<?= Html::submitButton(Yii::t('app', 'Verify'), ['class' => 'btn btn-lg btn-block btn-success', 'name' => 'approve-button']) ?>
                    </div>
                     <?php ActiveForm::end(); ?>

	
</div>
</div>