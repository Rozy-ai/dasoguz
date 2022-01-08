<?php

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\ItemWrapper */

$this->title = $model->title;
$categoryModel = $model->category;
if (isset($categoryModel) && $categoryModel->top == true) {
    $this->params['breadcrumbs'] = $categoryModel->getBreadcrumbs(true);
}
$this->params['breadcrumbs'][] = Yii::$app->controller->truncate($model->title, 8, 65);

$item = \common\models\wrappers\ItemWrapper::findOne(1007);

?>
<!-- product-details-area are start-->

<div class="container" style="margin-top: 60px;margin-bottom: 80px">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?=$item->title?></h1>
                <p><?=$item->description?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="single-blog">
                <div class="ep-content">
                    <?=$item->content?>
                </div>
            </div>
        </div>
    </div>
</div>
