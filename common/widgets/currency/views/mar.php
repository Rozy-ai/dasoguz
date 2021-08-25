<?php
use yii\helpers\Html;
$items = $this->context->list;

?>
<section class="ticker_section">

    <div class=" next-block ticker" >

        <div class="ticker_block">
            <div class="marquee-div">

                <marquee behavior="scroll" direction="left" id="marquee1">

                    <?php
                    foreach ($items as $key => $data) {?>

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
                    }
                    ?>
                </marquee>
            </div>
        </div>

    </div>
</section>



