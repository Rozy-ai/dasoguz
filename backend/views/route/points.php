<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="middle-form">


    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
    	<div class="col-md-6">


	<?= Html::dropDownList('points',$selectedPoints, $points,['class'=>'form-control','size' => count($points)]); ?>
    	</div>
    	<div class="col-md-6">
    		<div >
    			<ol class="" id="jogaps">
    				<?php
    					foreach ($selectedPoints as $key => $value) {
    						echo "<li data-value='$value'>".$points[$value]."</li>";
    					}
    				?>
    			</ol>
    		</div>
    	</div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    		</div>
    		<?php

    			$selectedPoints = implode(',', $selectedPoints).',';
    		?>
    <input type="hidden" name='routes' id="routes" value="<?=$selectedPoints?>">
    <?php ActiveForm::end(); ?>

</div>

<style>
    option[selected]{
  background-color: #ccc;
}
</style>
<?php
	
	$this->registerJs('

		$("option").on("click", function(e){
				var value = $(this).attr("value");
				var points = $("#routes").val();
				var result = points.search(value);
				if	(result > -1){
					points = points.replace(value+",", "");
					$("li[data-value=\""+value+"\"]").remove();
				} else{
					points= points + value + ",";
					$("#jogaps").append("<li   data-value=\""+value+"\" >"+ $(this).html() + "</li>");
				}
				$("#routes").val(points);
			});

		', yii\web\View::POS_END);

?>
