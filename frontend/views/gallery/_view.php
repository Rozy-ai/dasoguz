<?php
use yii\helpers\Html;

$thumbImageUrl = $model->getThumbPath(350, 200, 'h', true);
$href = $model->getGalleryUrl();
?>
<a href="<?= $href ?>">
<?php if (strlen(trim($thumbImageUrl)) > 5) { ?>
    <div class="gallery-item">
        <div class="gredient"></div>
            
                <img src="<?php echo $thumbImageUrl; ?>" alt="">
                <div class="gallery-desc"><?= Yii::$app->controller->truncate($model->title, 10, 100) ?></div>
         
    </div>
<?php } ?>
</a>
