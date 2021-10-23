
<?php
use yii\helpers\Html;

$items = $this->context->items;
$count = 0;
$limit = $this->context->limit;
if (isset($items) && count($items) > 1) { ?>
<!--    <h3 style="margin: 20px 0 30px 20px;">--><?//=YII::t('app','Similar')?><!--</h3>-->
    <?php foreach ($items as $key => $data) { ?>
        <?php
            if ($data->id == yii::$app->request->get('id') || $count == $limit)
                continue;
            else
                $count++;
        ?>

        <div class="related-page">
            <div class="related-page-image-wrapper">
                <?php
                $imgsrc = $data->getThumbPath();
                echo Html::img($imgsrc, ['alt' => "$data->title"]);
                ?>
            </div>
            <div class="bar-beneath" style="height: 0.4rem"></div>
                <div class="d-flex flex-column justify-content-between">
                    <div class="related-page-title">
                        <a href="<?=$data->url;?>">
                         <?php 
    $title = Yii::$app->controller->truncate($data->title, 10, 180);
     echo $title;
     ?>
                      </a>
                  </div>
              </div>
  </div>




<!--      -->
    <?php } ?>
<?php } ?>
