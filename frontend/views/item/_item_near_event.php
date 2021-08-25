<?php
use yii\helpers\Html;

$href = $model->url;
$author = (isset($model->author) && strlen(trim($model->author)) > 0) ? $model->author : $model->create_username;

//$path = $model->getThumbPath(365, 215, '', true, false, true);
?>

<div class="near_event_article">
    <span class="date" style="margin-right: 10px;"><?=Yii::$app->formatter->asDate(substr($model->date_created,0,10), 'dd-MM-Y')?></span>
    <p><?= Html::a($model->title, $href) ?></p>
</div>
