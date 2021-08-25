<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\wrappers\RouteWrapper;
use common\models\wrappers\PointWrapper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Route');
$this->params['breadcrumbs'][] = $searchModel->getTypeText();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="heading_main text-center" style="padding-top: 40px;">

                <h1>
                    <span class="theme_color"></span>
                    <?=yii::t('app', 'TYPE_IN_CITY')?>
                </h1>

            </div>
        </div>
    </div>
</div>

        <div class="container" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
 
            <?php echo $this->render('_search', ['model' => $searchModel,'search' => $search]); ?>
            <div class="divider">
                <div class="strong-border"></div>
            </div>
                 <?php if ($routes_from > 0): ?>

            <div class="routes-table mbot-5">
                <div id="w1" class="grid-view"><table class="table table-striped table-hover table-condensed"><colgroup><col width="120px">
<col>
<col>
<col width="120px">
<col width="120px"></colgroup>
<thead>
<tr><th><a href="#" data-sort="route_no"><?= yii::t('app','Direction number') ?></a></th><th><?= yii::t('app','From point') ?></th><th><?= yii::t('app','To point') ?></th><th><a href="#" data-sort="length"><?= yii::t('app','The length of the route') ?></a></th><th><a href="#" data-sort="cycle_min"><?= yii::t('app','A lap time') ?></a></th></tr>
</thead>
<tbody>
    <?php foreach ($routes_from as $key => $route) : ?>
<tr data-key="<?= $route->id ?>"><td><h4 style="font-size:24px;font-weight:600;"><?= $route->route_no ?></h4></td><td><h4><?php 
$points = json_decode($route->points);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
  $firstKey = $keys[0];
  $firstValue = $points[$firstKey];
}
$fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
echo $fromPoint->name;
 ?></h4></td><td><h4>
     <?php 
$points = json_decode($route->points);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
   $lastKey = $keys[$count - 1];
$lastValue = $points[$lastKey];
}
$toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
echo $toPoint->name;
      ?>
 </h4></td><td>
    <?= (float)$route->length . ' ' . Yii::t('app', 'km'); ?>
     
 </td><td>
     <?= $route->cycle_min . ' ' . Yii::t('app', 'min');
      ?>
 </td></tr>
 <?php endforeach ?>
</tbody></table></div>            
</div>

            <?php elseif($routes_to > 0): ?>
<div class="routes-table mbot-5">
                <div id="w1" class="grid-view"><table class="table table-striped table-hover table-condensed"><colgroup><col width="120px">
<col>
<col>
<col width="120px">
<col width="120px"></colgroup>
<thead>
<tr><th><a href="#" data-sort="route_no"><?= yii::t('app','Direction number') ?></a></th><th><?= yii::t('app','From point') ?></th><th><?= yii::t('app','To point') ?></th><th><a href="#" data-sort="length"><?= yii::t('app','The length of the route') ?></a></th><th><a href="#" data-sort="cycle_min"><?= yii::t('app','A lap time') ?></a></th></tr>
</thead>
<tbody>
    <?php foreach ($routes_to as $key => $route) : ?>
<tr data-key="<?= $route->id ?>"><td><h4 style="font-size:24px;font-weight:600;"><?= $route->route_no ?></h4></td><td><h4><?php 
$points = json_decode($route->points);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
  $firstKey = $keys[0];
  $firstValue = $points[$firstKey];
}
$fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
echo $fromPoint->name;
 ?></h4></td><td><h4>
     <?php 
$points = json_decode($route->points);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
   $lastKey = $keys[$count - 1];
$lastValue = $points[$lastKey];
}
$toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
echo $toPoint->name;
      ?>
 </h4></td><td>
    <?= (float)$route->length . ' ' . Yii::t('app', 'km'); ?>
     
 </td><td>
     <?= $route->cycle_min . ' ' . Yii::t('app', 'min');
      ?>
 </td></tr>
 <?php endforeach ?>
</tbody></table></div>            
</div>

            
<?php elseif($routes> 0 && !isset($transfers)): ?>   
                                      
       <div class="routes-table mbot-5">
                <div id="w1" class="grid-view"><table class="table table-striped table-hover table-condensed"><colgroup><col width="120px">
<col>
<col>
<col width="120px">
<col width="120px"></colgroup>
<thead>
<tr><th><a href="#" data-sort="route_no"><?= yii::t('app','Direction number') ?></a></th><th><?= yii::t('app','From point') ?></th><th><?= yii::t('app','To point') ?></th><th><a href="#" data-sort="length"><?= yii::t('app','The length of the route') ?></a></th><th><a href="#" data-sort="cycle_min"><?= yii::t('app','A lap time') ?></a></th></tr>
</thead>
<tbody>
    <?php foreach ($routes as $key => $route) : ?>
<tr data-key="<?= $route->id ?>"><td><h4 style="font-size:24px;font-weight:600;"><?= $route->route_no ?></h4></td><td><h4><?php 
$points = json_decode($route->points);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
  $firstKey = $keys[0];
  $firstValue = $points[$firstKey];
}
$fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
echo $fromPoint->name;
 ?></h4></td><td><h4>
     <?php 
$points = json_decode($route->points);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
   $lastKey = $keys[$count - 1];
$lastValue = $points[$lastKey];
}
$toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
echo $toPoint->name;
      ?>
 </h4></td><td>
    <?= (float)$route->length . ' ' . Yii::t('app', 'km'); ?>
     
 </td><td>
     <?= $route->cycle_min . ' ' . Yii::t('app', 'min');
      ?>
 </td></tr>
 <?php endforeach ?>
</tbody></table></div>            
</div>
         


        

<?php elseif(empty($routes) && isset($transfers)): ?>
                  <div class="routes-table mbot-5">
                <div id="w1" class="grid-view"><table class="table table-striped table-hover table-condensed"><colgroup><col width="120px">
<col>
<col>
<col width="120px">
<col width="120px"></colgroup>
<thead>
<tr><th><a href="#" data-sort="route_no"><?= yii::t('app','Direction number') ?></a></th><th><?= yii::t('app','From point') ?></th><th><?= yii::t('app','To point') ?></th><th><a href="#" data-sort="length"><?= yii::t('app','The length of the route') ?></a></th><th><a href="#" data-sort="cycle_min"><?= yii::t('app','A lap time') ?></a></th></tr>
</thead>
<tbody>
<tr data-key="<?= $transfers['from']['id'] ?>"><td><h4 style="font-size:24px;font-weight:600;"><?= $transfers['from']['route_no'] ?></h4></td><td><h4><?php 
$points = json_decode($transfers['from']['points']);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
  $firstKey = $keys[0];
  $firstValue = $points[$firstKey];
     $lastKey = $keys[$count - 1];
$lastValue = $points[$lastKey];
}
$fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
echo $fromPoint->name;
 ?></h4></td><td><h4>
     <?php 

$toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
echo $toPoint->name;
      ?>
 </h4></td><td>
    <?= (float)$transfers['from']['length']. ' ' . Yii::t('app', 'km'); ?>
     
 </td><td>
     <?= $transfers['from']['cycle_min'] . ' ' . Yii::t('app', 'min');
      ?>
 </td></tr>
</tbody></table></div>            
</div>
<br>
               <?php   $stop = PointWrapper::find()->where(['id' => $transfers['stop']])->one();
               ?>
               <h4><?= "Awtobus çalyşmaly nokady : " . $stop->name; ?></h4><br>
                             <div class="routes-table mbot-5">
                <div id="w1" class="grid-view"><table class="table table-striped table-hover table-condensed"><colgroup><col width="120px">
<col>
<col>
<col width="120px">
<col width="120px"></colgroup>

<tbody>
<tr data-key="<?= $transfers['to']['id'] ?>"><td><h4 style="font-size:24px;font-weight:600;"><?= $transfers['to']['route_no'] ?></h4></td><td><h4><?php 
$points = json_decode($transfers['to']['points']);
$count = count($points);
if ($count > 0) {
  $keys = array_keys($points);
  $firstKey = $keys[0];
  $firstValue = $points[$firstKey];
     $lastKey = $keys[$count - 1];
$lastValue = $points[$lastKey];
}
$fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
echo $fromPoint->name;
 ?></h4></td><td><h4>
     <?php 

$toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
echo $toPoint->name;
      ?>
 </h4></td><td>
    <?= (float)$transfers['to']['length']. ' ' . Yii::t('app', 'km'); ?>
     
 </td><td>
     <?= $transfers['to']['cycle_min'] . ' ' . Yii::t('app', 'min');
      ?>
 </td></tr>
</tbody></table></div>            
</div>            
                      
            
         
            <?php else: ?>
                <div class="routes-table mbot-5">
                <?= GridView::widget([
                    'tableOptions' => ['class' => 'table table-striped table-hover table-condensed'],
                    'layout' => "{items}",
                    'dataProvider' => $dataProvider,
                    'emptyText' => 'Maglumat ýok',
                    'columns' => [

                        [
                            'attribute' => 'route_no',
                            'value' => function ($data) {
                                return "<h4 style='font-size: 24px; font-weight: 600;'>" . $data->route_no . "</h4>";
                            },
                            'format' => 'html',
                            'options' => ['width' => '120px']
                        ],
                        [
                            'attribute' => yii::t('app','From Point ID'),
                            'filter' => $searchModel->getPoints(),
                            'value' => function ($data) {
                                $points = json_decode($data->points);

                                $count = count($points);
                                if ($count > 0) {
                                  $keys = array_keys($points);
                                  $firstKey = $keys[0];
                                  $firstValue = $points[$firstKey];
                                }

                                $fromPoint = PointWrapper::find()->where(['id' => $firstValue])->one();
                                return (isset($fromPoint)) ? "<h4>" . $fromPoint->name . "</h4>" : "";
                            },
                            'format' => 'html',
                        ],
                        [
                            'attribute' =>  yii::t('app','To Point ID'),
                            'filter' => $searchModel->getPoints(),
                            'value' => function ($data) {
                                 $points = json_decode($data->points);

                                $count = count($points);
                                if ($count > 0) {
                                  $keys = array_keys($points);
                                  $lastKey = $keys[$count - 1];
                                  $lastValue = $points[$lastKey];
                                }

                                $toPoint = PointWrapper::find()->where(['id' => $lastValue])->one();
                                return (isset($toPoint)) ? "<h4>" . $toPoint->name . "</h4>" : "";
                            },
                            'format' => 'html',
                        ],
                        [
                            'attribute' => 'length',
                            'value' => function ($data) {
                                return (float)$data->length . ' ' . Yii::t('app', 'km');
                            },
                            'format' => 'html',
                            'options' => ['width' => '120px']
                        ],
                        [
                            'attribute' => 'cycle_min',
                            'value' => function ($data) {
                                return $data->cycle_min . ' ' . Yii::t('app', 'min');
                            },
                            'format' => 'html',
                            'options' => ['width' => '120px']
                        ],
                        // [
                        //     'attribute' => 'planned_period_min',
                        //     'value' => function ($data) {
                        //         return $data->planned_period_min . ' ' . Yii::t('app', 'min');
                        //     },
                        //     'format' => 'html',
                        //     'options' => ['width' => '120px']
                        // ],
                        [
                            'attribute' => 'price',
                            'value' => function ($data) {
                                return (float)$data->price . ' ' . Yii::t('app', 'dtm');
                            },
                            'format' => 'html',
                            'options' => ['width' => '120px'],
                            'visible' => $searchModel->type != RouteWrapper::TYPE_COMING
                        ]
                    ],
                ]); ?>
            </div>
            <?php endif ?>

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
