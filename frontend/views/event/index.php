<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ShowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
//$this->params['breadcrumbs'][] = $this->title;
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


<div class="container">
    <div class="row">

        <div class="col-md-12 ">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="col-md-12 ">
            <!--            <div class="row">-->
            <!--                <div class="event-carousel">-->
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
                'options' => ['class' => 'row event-carousel event-list'],
//                      'filterModel' => $searchModel,
                'viewParams' => [],
                'itemOptions' => ['class' => 'col-md-4'],
                'layout' => "{items}\n{pager}",
            ]); ?>
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</div>