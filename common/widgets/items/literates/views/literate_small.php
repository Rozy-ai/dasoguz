<?php
use yii\helpers\Html;

$items = $this->context->items;

if (isset($items) && count($items) > 0) { ?>
    <?php foreach ($items as $key => $data) {
        ?>
        <?php
        if (!in_array($data->id, yii::$app->params['page_items']))
            if ($count< 1):
                $count++;
        ?>
                <div>
                    <div class="business_card">
                        <a href="<?= $data->url; ?>">
                            <div class="business_card_img">
                                <?php
                                $imgsrc = $data->getThumbPath(320, 240, 'w', true, false, true);
                                echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
                                ?>
                            </div>
                            <div class="business_card_content">
                                <div class="business_card_title">
                                    <a href="<?=$data->url;?>">
                                        <h4><?php
                                            $title = yii::$app->controller->truncate($data->title,10,70);
                                            echo html::a($title,$data->url);
                                            ?></h4>
                                    </a>
                                </div>

                                <div class="business_card_content_text d-flex aling-item-center" >
                                    <div class="business_card_desc">
                                        <p class="text-muted">
                                            <?php
                                            $desc = Yii::$app->controller->truncate($data->description, 20, 150);
                                            echo $desc;
                                            ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endif;?>
    <?php } ?>
<?php } ?>
