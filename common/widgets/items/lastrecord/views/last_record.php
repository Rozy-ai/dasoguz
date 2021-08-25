<?php
use yii\helpers\Html;

$items = $this->context->items;
if (isset($items) && count($items) > 0) { ?>
    <?php foreach ($items as $key => $data) {
        yii::$app->params['page_items'][] = $data->id;
        ?>
        <?php
        $imgsrc = $data->getThumbPath($img_width,$img_height, 'w',true, false, true);
//        $imgsrc = $data->getThumbPath(, , '', true);
        if ($data->getCheckPhoto()){
            echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
        } else {
            echo "<div class='no_photo_block'>";
            echo Html::img($imgsrc, ['alt' => '', 'class' => 'no_photo']);
            echo "</div>";
        }
        ?>
        <a href="<?=$data->url;?>">
            <div class="last_article_hover">
                <div class="last_article_hovery">
                    <div class="last_article_content">
                        <span class="category"><?=$data->category->name;?></span>
                        <p class="title">
                            <?php
                            $title = Yii::$app->controller->truncate($data->title, 100, 500);
                            echo $title;
                            ?>
                        </p>
                        <span>
                            <?php
                            $desc = Yii::$app->controller->truncate($data->description, 10, 100);
//                            echo $desc;
                            ?>
                        </span>
                        <div class="empty_block">

                        </div>
<!--                        <span class="read_more">--><?php
//                           echo yii::t('app' , 'Read more')
                            ?>
<!--                        </span>-->
                    </div>
                </div>
            </div>
        </a>
    <?php } ?>
<?php } ?>
