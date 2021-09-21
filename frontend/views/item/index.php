<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => yii::t('app', 'Site description')]);
if (isset($modelCategory)) {
    $this->title = $title = $modelCategory->name;
    $this->params['breadcrumbs'] = $modelCategory->getBreadcrumbs();
}
$this->params['breadcrumbs'][] = Yii::$app->controller->truncate($model->title, 8, 65);
$dataProvider = $searchModel->search([]);
?>


<?php
//echo "<pre>";
//var_dump($dataProvider);die;?>
<div class="content" >
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 px-0">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    //                    'class' => 'item',
                    'id' => 'item-list',
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_item_view', [
                            'model' => $model,
                            'key' => $key,
                            'index' => $index,
                            'widget' => $widget,
                        ]);
                    },
                    'viewParams' => [],
                    'itemOptions' => ['class' => ''],
                    'layout' => "{items}\n{pager}",
                ]); ?>
            </div>
        </div>
    </div>
</div>