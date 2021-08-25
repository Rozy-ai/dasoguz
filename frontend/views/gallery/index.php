<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerCssFile(Yii::$app->request->baseUrl . '/source/css/jquery.fancybox.min.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/source/js/jquery.fancybox.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gallery');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="page-header">
        <div class="container">
            <h1 class="page-title text-center">
                <?php
                echo $this->title;
                ?>
            </h1>
        </div>
    </div>


<div class="tng-section">
        <div class="container">
        <div class="row py-3">
            <div class="col-12">
          

            <!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'id' => 'gallery-list',
                'itemView' => '_view',
                'options' => ['class' => 'gallery-wrapper'],
                'layout' => "{items}\n{pager}",
                'viewParams' => [],
                'itemOptions' => [
                    'tag' => false,
//                    'class' => 'col-md-3 col-lg-3 col-xs-12'
                ],
            ]); ?>
       
            </div>
            <!--            </div>-->
        </div>
    </div>
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


