<?php 
use yii\bootstrap\ActiveForm;
 ?>

 <?php $form = ActiveForm::begin(['action'=>['/search/index'],'method'=>'get']); ?>
<div class="tng-section">
	<div class="search-box-container" style="position: relative;">
		<div class="container" style="margin-top: 5%">
			<div class="input-group d-lg-block w-100 px-10" style="border: none; box-shadow: none; outline: none;width: 100%">
				<div class="input-group" style="width: 100%">
				<input type="search" placeholder="<?= yii::t('app','Write the word you are looking for') ?>" aria-label="<?= yii::t('app','Write the word you are looking for') ?>" autocomplete="off" class="form-control" style="padding: 20px" name="query"> 
				<div class="input-group-append">
					<button class="btn btn-primary" type="submit" style="position: absolute;right: 0;top: 0;z-index: 9;padding: 10px 20px">
            <?= Yii::t('app','Search') ?>
          </button>
       </div>
    </div>
     <div class="list-group shadow vbt-autcomplete-list" style="display: none; width: 1034.02px; margin-left: 41px;">
     	
     </div>
  </div>
</div>
</div>
</div>
<?php ActiveForm::end(); ?>