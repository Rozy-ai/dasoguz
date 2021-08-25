<?php
use yii\helpers\Html;

$items = $this->context->items;
if (isset($items) && count($items) > 0) { ?>
    <?php foreach ($items as $key => $data) { ?>
        <?php
        if (!in_array($data->id, yii::$app->params['page_items']))
            if ($count< 2):
                $count++;
                ?>
            <div class="col-md-4  px-0">
                <div class="mini_last_article_1 col-md-12 col-sm-6 px-0" >
                    <?php
                    $imgsrc = $data->getThumbPath(360, 255, 'w',  true, false, true);
                    echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
                    ?>
                    <a href="<?=$data->url;?>">
                        <div class="last_article_hover">
                            <div class="last_article_hovery">
                                <div class="last_article_content">
                                    <span class="category"><?=$data->category->name?></span>
                                    <p><?php
                                        $desc = Yii::$app->controller->truncate($data->title, 100, 500);
                                        echo $desc;
                                        ?></p>
                                    <div class="empty_block">

                                    </div>
<!--                                    <span>--><?//=yii::t('app' , 'Read more')?><!--</span>-->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
                if ($key == 1 && Yii::$app->controller->isMobile()) {
                    $banner = \common\models\wrappers\BannerWrapper::findOne(24);

                    ?>
                <div class="bannerS" style="padding-bottom: 10px;">
                    <?=html::img($banner->getThumbPath(), ['style' => 'width:100%;']); ?>
                </div>

                    <?php
                }
                    ?>
        <?php endif;?>

<!--      -->
    <?php } ?>
<?php } ?>
