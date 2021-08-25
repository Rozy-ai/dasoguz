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
            <div class="literate_card">

                <div style="height:420px;">
                    <?php
                    $imgsrc = $data->getThumbPath(750, 0, 'w', true, false, true);
                    echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
                    ?>
                </div>
                    <div class="literate_desc">
                        <div class="literate_content" >
                            <a href="<?=$data->url;?>">
                                <h3><?=$data->title?></h3>
                            </a>

                            <p class="mt-4"><?php
                                $desc = Yii::$app->controller->truncate($data->description, 30, 400);
                                echo $desc;
                                ?>

                            </p>
                        </div>
                    </div>

            </div>
        <?php endif;?>
    <?php } ?>
<?php } ?>
