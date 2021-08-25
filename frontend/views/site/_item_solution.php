<?php
use yii\helpers\Html;

$href = $model->url;
$author = (isset($model->author) && strlen(trim($model->author)) > 0) ? $model->author : $model->create_username;

//$path = $model->getThumbPath(365, 215, '', true, false, true);
?>





<div class="col-md-4">
    <div class="mini_last_article_1 col-md-12 col-sm-6">
        <?php
        $imgsrc = $model->getThumbPath(260, 150, 'w', true);
        echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
        ?>
        <a href="<?=$href?>">
            <div class="last_article_hover">
                <div class="last_article_content">
                    <span class="category"><?=$model->category->name?></span>
                    <p><?=$model->title?></p>
                    <span>Doly Okamak</span>
                </div>
            </div>
        </a>
    </div>
</div>