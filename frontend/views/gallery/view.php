<?php

use common\models\wrappers\ImageWrapper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->registerCssFile(Yii::$app->request->baseUrl . '/source/css/jquery.fancybox.min.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/source/js/jquery.fancybox.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title . " | " . Yii::t('app', 'Gallery');
$this->params['breadcrumbs'][] = array('url' => \yii\helpers\Url::to(['gallery/index']), 'label' => Yii::t('app', 'Gallery'));
$this->params['breadcrumbs'][] = Yii::$app->controller->truncate($model->title, 8, 65);


?>


    <!-- Item Page -->
    <div class="container gallery_detail">
<!--        <div class="col-md-12 col-sm-12 col-xs-12">-->
            <div class="row" id="gallery-list">
                <h1 class="page-title">
                    <?php echo $model->title; ?>
                </h1>
                <div class="gallery-wrapper">

          <?php $model_docs =  $model->documents; ?>



                <?php foreach ($model_docs as $model_doc) : ?>


         <img src="<?= '/uploads/',$model_doc->path ?>" class="gallery-item" style="max-width: 400px;" alt="<?= $model_docs->description ?>">
    
<?php endforeach; ?>
                </div>

            </div>
<!--        </div>-->
    </div>


<?php
$script = <<< JS
    var visible = $('.fancybox');
    $("body").on("click",".fancybox",function(e){
        e.preventDefault();
        $.fancybox.open( visible, {
            infobar : true,
            arrows  : true,
            loop : true,
            protect: true,
            image : {
                preload : "auto",
            },
            thumbs : {
                autoStart : true
            }
        }, visible.index( this ) );
    
        return false;
    });
JS;

$this->registerJs($script, yii\web\View::POS_READY);

?>