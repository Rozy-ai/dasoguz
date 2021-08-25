<?php
//$dropZoneName=$this->context->dropzoneName;
//$options=$this->context->options;
//$deleteUrl=\yii\helpers\Url::to([$this->context->deleteUrl]);
//$uploadUrl=\yii\helpers\Url::to([$this->context->uploadUrl]);
//$inputId=$this->context->inputId;
$images = $this->context->images;
$galleryHref = \yii\helpers\Url::to(['gallery/index']);

if (isset($images)) { ?>
    <div class="single-widget">
        <div class="widget-header text-center">
            <h2><?= \yii\bootstrap\Html::a(Yii::t('app', 'Gallery'), $galleryHref) ?></h2>
        </div>

        <?php foreach ($images as $image) {
            $thumbImageUrl = $image->getThumbPath(350, 200, 'h', true);
            $href = $image->getGalleryUrl();
            if (strlen(trim($thumbImageUrl)) > 5) { ?>
                <div class="sma-img gallery col-md-3">
                    <?php ?>
                    <a href="<?= $href ?>"><img src="<?php echo $thumbImageUrl; ?>" alt="">
                        <span class="gallery-title"><?= $image->title ?></span>
                        <?php if ($image->type == \common\models\wrappers\ImageWrapper::IMAGE_VIDEO) { ?>
                            <span class="video-icon"></span>
                        <?php } ?>
                    </a>
                </div>
            <?php }
        } ?>
    </div>
<?php } ?>
