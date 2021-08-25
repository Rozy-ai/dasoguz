<?php
use yii\helpers\Html;

$items = $this->context->items;
if (isset($items) && count($items) > 0) { ?>
    <?php foreach ($items as $key => $data) { ?>
        <?php
            if (!in_array($data->id, yii::$app->params['page_items']))
                if ($count< $limit):
                    $count++;
        ?>
            <div>
                <div class="business_card">
                    <a href="<?= $data->url; ?>">
                        <div class="business_card_img">
                            <?php
                            $imgsrc = $data->getThumbPath('360','220', 'w',true, false, true);
                            //        $imgsrc = $data->getThumbPath(, , '', true);
                            if ($data->getCheckPhoto()){
                                echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
                            } else {
                                echo "<div class='no_photo_block'>";
                                echo Html::img($imgsrc, ['alt' => '', 'class' => 'no_photo']);
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="business_card_content">
                            <div class="business_card_title">
                                <h4><?php
                                    $title = yii::$app->controller->truncate($data->title,10,70);
                                    echo $title;
                                    ?>
                                </h4>
                            </div>

                            <div class="business_card_content_text d-flex aling-item-center" >
                                <div class="business_card_desc">
                                    <p class="text-muted">
                                        <?php
                                        $desc = Yii::$app->controller->truncate($data->description, 35, 200);
                                        echo $desc;
                                        ?>
                                    </p>
                                </div>
<!--                                <div style="width: 2px;" class="col-xs-none business_card_arr">-->
<!--                                    <i class="fa fa-angle-right ihover"></i>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;?>
    <?php } ?>
<?php } ?>
