<?php
use yii\helpers\Html;

$items = $this->context->items;
if (isset($items) && count($items) > 0) { ?>
    <?php foreach ($items as $key => $data) { ?>


        <div class="col-sm-12 item">
            <div class="col-md-offset-1 col-sm-offset-1 col-md-2 col-sm-2 ">
                <?php
                $imgsrc = $data->getThumbPath(100, 100, 'w', true, false, false, 'profile');
                echo Html::img($imgsrc, ['alt' => '', 'class' => ' profile']);
                ?>
            </div>

            <div class="col-md-9 col-sm-9 fitem">
                <div class="text">
                    <h4 class="name_freelancer"><b><?=html::a($data->username,$data->url)?></b></h4>

                    <span class="skils"><b><?=$data->skills?></b></span><br><br>
                    <p>
                        <?php
                            $about = 'about_'.yii::$app->language;
                            echo $data->$about;
                        ?>
                    </p>

                    <span><?=yii::t('app', 'Service charge')?>: </span><span><?=$data->service_charge?> <?=yii::t('app', 'Man')?></span><br>
                    <span><?=yii::t('app', 'Work')?>: </span><span><?=$data->amount_work?></span><br>
<!--                    <span>Yyldyz: </span><span>--><?//=$data->star?><!--</span><br>-->
                    <span ><i class="fa fa-envelope"></i> <?=$data->email?></span>
<!--                    <span style="margin-right: 20px; "><i class="fa  fa-phone"></i> --><?//=$data->phone_number?><!--</span><br>-->
                </div>
            </div>

        </div>

    <?php } ?>
<?php } ?>


