<?php

use yii\helpers\Html;

$list = $this->context->list;
$item_class = isset($this->context->item_class) ? $this->context->item_class : 'col-sm-4 col-md-4 col-lg-4 col-xl-4';

if (isset($list) && count($list) > 0) { ?>
    <div class="currency_slider">
        <?php
        foreach ($list as $key => $data):
            ?>
        <div class="currency_slide">
            <a href="<?=$data->getUrl()?>" style="text-align: center">
                <div>
                    <span class="tbwb">
                    <?=yii::t('app', 'TBPB')?>
                </span>
                </div>
                <div>
                   <span class="proportion_currency">
                        <?=$data->code?>/<span style="color: green;">TMT <?=round($data->rate_tmt,2)?></span>
                    </span>
                </div>
                <?php
                if ($data->code != 'USD'):
                    ?>
                    <div onfocus="null">
                       <span class="proportion_currency">
                           <?php
                           $arr = ['AUD', 'GBP', 'XDR', 'EUR'];
                           if (in_array($data->code, $arr)){
                               echo $data->code.'/USD';
                           } else {
                               echo 'USD/'.$data->code;
                           }
                           ?> <?=round($data->rate_usd,2)?>
                </span>
                    </div>
                <?php
                endif;
                ?>
            </a>
        </div>
        <?php
        endforeach;
        ?>
    </div>
<?php } ?>


<?php
$this->registerJs('
        $(".currency_slider").slick({
          infinite: true,
                        arrows: true,
                        appendArrows: ".currency_slider",
                        dots: false,
                        autoplay: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        swipeToSlide: true,
                        responsive: [
                        {
                             breakpoint: 2560,
                             settings: {
                                 slidesToShow: 4,
                                 slidesToScroll: 1,
                             }
                         },
                        {
                             breakpoint: 1450,
                             settings: {
                                 slidesToShow: 4,
                                 slidesToScroll: 1,
                             }
                         },
                         {
                             breakpoint: 1024,
                             settings: {
                                 slidesToShow: 4,
                                 slidesToScroll: 1,
                             }
                         },
                         {
                             breakpoint: 768,
                             settings: {
                                 slidesToShow: 3,
                                 slidesToScroll: 1,
                                 arrows: false,
                             }
                         },
                         {
                             breakpoint: 480,
                             settings: {
                                 slidesToShow: 2,
                                 slidesToScroll: 1,
                                 arrows: false,
                             }
                         }
                     ]
                    });
    ',\yii\web\View::POS_END);
?>