<?php
use yii\helpers\Html;

$items = $this->context->items;
if (isset($items) && count($items) > 0) { ?>
    <?php foreach ($items as $key => $data) { ?>
        <div class="col-md-3 col-sm-6 fc_item" >
            <div class="freelance_card_hover" >
                <div class="freelance_card_img">
                    <div class="freelance_card_category">
                        <span>
                            <?=yii::$app->controller->truncate($data->category->name,3,120);?>
                        </span>
                    </div>
                    <?php
                    $imgsrc = $data->getThumbPath(260, 180, 'w', true, false, true);
                    echo Html::img($imgsrc, ['alt' => '', 'class' => 'img100']);
                    ?>
                </div>
                <div class="freelance_card_content">
                    <div class="row">
                        <div class="col-xs-12" style="clear: both;">

                            <div class="title_freelance">
                                
                                  <?php
                                  $username = yii::$app->controller->truncate($data->username,10,40);
                                  echo html::a("<span class=\"name\">$username</span>",$data->url,['style' => 'display:inline-block;padding:5px 0;'])?>
                                
                            </div>

                            <!-- <div class="price d-flex justify-content-between align-items-center">
                                <span></span>
                                <span>
                                  <?php
                                    // echo $data->service_charge
                                  ?>
                              </span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
