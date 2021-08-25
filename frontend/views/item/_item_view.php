<?php
use yii\helpers\Html;

$href = $model->url;
$author = (isset($model->author) && strlen(trim($model->author)) > 0) ? $model->author : $model->create_username;
if  ($model->category->parent_id == 16){
    $category = $model->category->parent->name;
} else {
    $category = $model->category->name;
}
//$path = $model->getThumbPath(365, 215, '', true, false, true);
?>


           <div class="item">
               <div class="item_articles">
                   <div class="col-md-5 col-sm-5 px-0">
                       <div class="list_item_img">
                           <?php
                           $imgsrc = $model->getThumbPath(280, 220, 'w', true, false, true);
                           echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'img200']), $href);
                           ?>
                       </div>
                   </div>
                   <div class="col-md-7 col-sm-7 ">
                       <div class="entry-header">
                           <div class="about">
                               <span class="category"><?=$category?></span>
                               <span class="date" >
                               <?php
                               //                               echo Yii::$app->formatter->asDate(substr($model->date_created,0,10), 'dd-MM-Y')
                               ?>
                           </span>
                               <span class="time">
                               <?php
                               //                               echo substr($model->date_created,-9,6)
                               ?>
                           </span>


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
           </div>
        <?php

        if (($index+1) % 3 == 0 ):?>
           <div class="item">
               <div class="item_articles">
                   <div class="col-md-12">
                       <?php
                       echo \common\widgets\banners\BannersWidget::widget([
                           'type' => 'item_listview',
                           'outer_css_id' => '',
                           'outer_css_class' => ' ',
                           'is_mobile' => '1',
                       ]);
                       ?>
                   </div>

               </div>
           </div>

        <?php endif;?>
