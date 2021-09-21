<?php
use yii\helpers\Html;

$items = $this->context->items;
$unset_id = $this->context->message;

if (isset($items) && count($items) > 0) : ?>
    <?php foreach ($items as $key => $data):  ?>
   <?php if($data->id == $unset_id): ?>
        <div class="news-additional-item" style="display: none;">
                    <div class="news-additional-item-date">
                        <?php
                        $date = New DateTime($data->date_created);
                                         echo $date->format('d-m-Y');
                          ?>
                    </div>
                    <a href="<?=$data->url ?>" class="news-additional-item-title">
                        <?php 
    $title = Yii::$app->controller->truncate($data->title, 10, 180);
     echo $title;
     ?>
  </a>
</div>
<?php else: ?>
          <div class="news-additional-item">
                    <div class="news-additional-item-date">
                        <?php
                        $date = New DateTime($data->date_created);
                                         echo $date->format('d-m-Y');
                          ?>
                    </div>
                    <a href="<?=$data->url ?>" class="news-additional-item-title">
                        <?php 
    $title = Yii::$app->controller->truncate($data->title, 10, 180);
     echo $title;
     ?>
  </a>
</div>
<?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>