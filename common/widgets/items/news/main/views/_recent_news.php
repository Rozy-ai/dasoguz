<?php
use yii\helpers\Html;

foreach ($items as $key => $data) { ?>
    <div class="list-item inline-block type-post ">
        <div class="inner_block">
            <?php
            $title = $data->title;
            ?>
            <div class="pull-left">
                <?php
                $path = $data->getThumbPath(75, 55, 'w', true);
                if (isset($path) && strlen(trim($path)) > 1) { ?>
                    <span class="media-object responsive news-index">
                        <?php echo Html::a(Html::img($path, array('style' => 'margin-right:15px;', 'alt' => $title)), $data->url, array('class' => "thumb")); ?>
                    </span>
                <?php } ?>
            </div>
            <div class="media-body">
                <div class="entry-title">
                    <span class="entry-date">
                        <time
                            datetime="<?php echo Yii::$app->controller->dateToW3C($data->date_created); ?>"> <?php echo Yii::$app->controller->renderDate($data->date_created); ?></time>
                    </span>
                    <?php
                    $title = Yii::$app->controller->truncate($title, 20, 300);
                    echo Html::a($title, $data->url, array('rel' => 'bookmark'));
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>