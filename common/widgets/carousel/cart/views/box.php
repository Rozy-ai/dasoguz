<?php
use yii\helpers\Html;

$list = $this->context->list;
$carouselCssClass = uniqid('carousel');
$item_class = isset($this->context->item_class) ? $this->context->item_class : 'col-sm-4 col-md-4 col-lg-4 col-xl-4';
?>
<div class="carousel-box">
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($this->context->widget_title)) { ?>
                <h3 class="widget-header pull-left"><?= $this->context->widget_title ?></h3>
            <?php } ?>
            <div class="owlNavigation pull-right">
                <a class="btn prev "><i class="fa fa-chevron-left"></i></a>
                <a class="btn next "><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="<?= $carouselCssClass ?>">
            <?php
            if (isset($list) && count($list) > 0) { ?>
                <?php foreach ($list as $key => $model) {
                    $href = $model->url;
                    ?>
                    <div class="<?= $item_class ?>">
                        <article class="pub-entry-box entry-box">

                            <div class="entry-image">
                                <?php
                                $imgsrc = $model->getThumbPath(275, 185, 'w', true);
                                echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'entry-featured-image-url']), $href);
                                ?>
                            </div>

                            <div class="entry-content">
                                <div class="entry-header">
                                    <h6 class="entry-title">
                                        <?= Html::a(Yii::$app->controller->truncate($model->title, 10, 110), $href) ?>
                                    </h6>
                                </div>

                                <div class="entry-desc">
                                    <?php
                                    $desc = Yii::$app->controller->truncate($model->description, 10, 180);
                                    echo $desc;
                                    ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="col-md-12">
            <div class="widget-show-all">
                <?php if (isset($this->context->show_all_url)) { ?>
                    <a href="<?= $this->context->show_all_url ?>"><?= $this->context->show_all_title ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs('
    function init(){
           var owl=$(".' . $carouselCssClass . '").owlCarousel({
            autoPlay: false,
            slideSpeed: 2000,
            loop:true,
            pagination: false,
            navigation: false,
            items: 4,
            navigationText: [""],
          });
          
      $(".next").click(function(){
        owl.trigger(\'owl.next\');
      })
      $(".prev").click(function(){
        owl.trigger(\'owl.prev\');
      })
  }
  
  init();
  
  ', \yii\web\View::POS_READY, 'carousel');
?>
