<?php
use yii\helpers\Html;

$items = $this->context->items;
$data = $this->context->mainItem;
$title = $data->title;
?>

<div class="row">
    <div class="col-md-7 col-xs-12">
        <div class="main_news_block">
            <span class="media-object responsive">
                <?php
                $path = $data->getThumbPath(630, 440, 'w', true);
                echo Html::a(Html::img($path, array('style' => 'width:100%', 'alt' => $title)), $data->url, array('class' => "thumb")); ?>
            </span>

            <h1 class="blog_header">
                <?php
                echo Html::a($title, $data->url, array('rel' => 'bookmark'));
                ?>
            </h1>
        </div>
        <div class="main_news_block_description">
            <?php
            echo $data->description;
            ?>
        </div>
    </div>

    <div class="col-md-5 col-xs-12">
        <?php
        echo $this->render('_recent_news', array('items' => $items));
        ?>
    </div>
</div>
