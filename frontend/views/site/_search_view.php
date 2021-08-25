<?php
$href = $model->url;
//echo "<pre>";
//var_dump($model);die;
?>


<div class="col-md-12">
    <h4 class="search_title">
        <a href="<?= $href ?>"><?php echo $model->title; ?></a>
    </h4>
    <p class="search_content"><?php echo Yii::$app->controller->getFragment(strip_tags($model->content), $query); ?></p>

</div>


