<?php
use yii\helpers\Html;

$href = $model->url;
$author = (isset($model->author) && strlen(trim($model->author)) > 0) ? $model->author : $model->create_username;

//$path = $model->getThumbPath(365, 215, '', true, false, true);
?>


           <div class="item_articles col-md-12">
               <div class="col-md-5 col-sm-5 px-0">
                   <?php
                   $imgsrc = $model->getThumbPath(323, 205, 'w', true);
                   echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'img100']), $href);
                   ?>
               </div>
               <div class="col-md-7 col-sm-7 ">
                   <div class="entry-header">
                       <div class="about">
                           <span class="category"><?=$model->category->name?></span>
                           <span class="date" ><?=Yii::$app->formatter->asDate(substr($model->date_created,0,10), 'dd-MM-Y')?></span>
                           <span class="time"><?=substr($model->date_created,-9,6)?></span>
                           <span class="visited_count date" ><?=$model->visited_count?>  <i class="fa fa-eye"></i></span>

                       </div>
                       <div class="title">
                           <h3 class="item_title"><?= Html::a($model->title, $href) ?></h3>
                       </div>
                   </div>

                   <div class="text">
                       <p><?php
                           $desc = Yii::$app->controller->truncate($model->description, 20, 300);
                           echo $desc;
                           ?></p>
                   </div>
               </div>
           </div>
