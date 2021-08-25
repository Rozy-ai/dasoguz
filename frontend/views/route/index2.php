<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\wrappers\RouteWrapper;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Route');
$this->params['breadcrumbs'][] = $searchModel->getTypeText();
?>
    <section class="breadcrumb_area_two parallaxie">

        <!-- <div class="overlay"></div> -->
        <div class="container-fluid" style="background: #F1F5FB;">
            <div class="container">
            <div class="row">
<!--                         <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav> -->
           <nav aria-label="breadcrumb">
      
                <?php if(isset($this->title) && !isset($this->params['no-title'])) { echo'<h1>'.$this->title.'</h1>'; } ?>
                <?php
                echo Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('app', 'Home'),
                        'url' => Yii::$app->homeUrl,
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                            'class' => 'breadcrumb'
                    ]
                ]);
                ?>
             
            </nav>

            </div>
        </div>
    </div>
    </section>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="divider">
                <div class="strong-border"></div>
            </div>
            <div class="routes-table mbot-5">
                <?= ListView::widget([
                    'layout' => "{items}\n{pager}",
                    'emptyText' => 'Maglumat ýok',
                    'dataProvider' => $dataProvider,
                    'itemView' => '_route',
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php
Modal::begin([
    "header" => "<h3>" . $this->title . " - " . $searchModel->getTypeText() . "</h3>",
    "id" => "modalRoute",
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();

$this->registerJs('
$(".addData").on("click", function(){
    $("#modalRoute").modal("show").find("#modalContent").load($(this).attr("href"));
    return false;
});
');
?>
