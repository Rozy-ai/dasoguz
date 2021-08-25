<?php

use yii\helpers\Html;

$list = $this->context->list;
$item_class = isset($this->context->item_class) ? $this->context->item_class : 'col-sm-4 col-md-4 col-lg-4 col-xl-4';

if (isset($list) && count($list) > 0) { ?>
    <div class="currency_slider">
        <?php
        foreach ($list as $key => $data):
            ?>
            <a href="<?=$data->getUrl()?>" class="currency_lenta_item">
                            <span class="proportion_currency">
                        <?= $data->code ?>/<span style="color: green;">TMT <?= round($data->rate_tmt, 2) ?></span>
                    </span> <span style="padding: 0 5px;">|</span>
                <?php
                if ($data->code != 'USD'):
                    ?>
                    <span class="proportion_currency">
                           <?php
                           $arr = ['AUD', 'GBP', 'XDR', 'EUR'];
                           if (in_array($data->code, $arr)) {
                               echo $data->code . '/USD';
                           } else {
                               echo 'USD/' . $data->code;
                           }
                           ?> <?= round($data->rate_usd, 2) ?>
                </span>
                <?php
                else: echo "<span class='proportion_currency'>&nbsp;</span>";
                endif;
                ?>
            </a>
        <?php
        endforeach;
        ?>
    </div>
<?php } ?>


<?php
//    $this->registerJs('
//
//    ',\yii\web\View::POS_END);
?>