<?php
use yii\helpers\Html;

$href = '/item/'.$model->item_id;
?>



      <?php if (isset($model->item->documents) && count($model->item->documents) > 0){
                $image=[];
        foreach ($model->item->documents as $doc){
            $image[] = $doc->getThumb();
        }
    } ?>

<div class="">
  <div class="category_cart">
        <div class="img_block_cart_category">
          <a href="<?= $href; ?>">
             
                     
                     <?php if (isset($image[0]) && strlen($image[0])>0){
                                echo html::img($image[0],['class' => 'my_img2']);
                            } else{
                                echo html::img($image[0],['class' => 'my_img2']);
                            } ?>
                
            </a>
<div class="signature"></div>
        </div>
            <div class="caption_cart" style="box-sizing:border-box">
                
                    <a href="<?= $href; ?>" style="text-decoration: none;"> <h4 style="color: #05988D;"><?=$model->title?></h4></a>
            
                <p>                             <?php


           echo Yii::$app->controller->getFragment(strip_tags($model->description), $query); 
                   ?></p>
               

            </div>

            </div>
    

        </div>


