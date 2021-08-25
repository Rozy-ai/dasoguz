<?php
use yii\helpers\Html;

$showModel = $model->show;
$href = $showModel->url;
$contentModel = $model->loadContent();
?>
<div class="">
    <div class="entry-box">

        <div class="entry-image">
            <?php
            $imgsrc = $contentModel->getThumbPath(450, 250);
            echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'entry-featured-image-url']), $href);
            ?>
        </div>

        <div class="entry-content">
            <div class="entry-header">
                <h6 class="entry-title">
                    <?= Html::a($contentModel->title, $href) ?>
                </h6>
            </div>

            <div class="entry-desc">
                <?php
                $location = $showModel->location;
                if (isset($location)) {
                    $desc = Yii::$app->controller->truncate($location->fullTitle, 20, 300);
                    echo '<i class="fa fa-map-marker"></i> ';
                    echo $desc;
                }
                ?>
            </div>

            <div class="entry-date">
                <i class="fa fa-calendar"></i>
                <time
                    datetime="<?php echo Yii::$app->controller->dateToW3C($model->start_time); ?>">
                    <?php echo  Yii::$app->controller->renderDateToWord($model->start_time)." ".Yii::$app->controller->renderTime($model->start_time); ?>
                </time>
            </div>
        </div>
    </div>
</div>