<?php
use yii\helpers\Html;

$list = $this->context->list;

if (isset($list) && count($list) > 0) { ?>
    <?php foreach ($list as $key => $model) {
        $href = $model->url;
        ?>
        <article class="entry-list">
            <div class="row">
                <div class="col-md-6">
                    <div class="entry-image">
                        <?php
                        $imgsrc = $model->getThumbPath(260, 150);
                        echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'entry-featured-image-url']), $href);
                        ?>
                    </div>
                </div>
                <div class="col-md-6 col-wide-left">
                    <div class="entry-header">
                        <h6 class="entry-title">
                            <?= Html::a($model->title, $href) ?>
                        </h6>
                    </div>

                    <!--                    <div class="entry-desc">-->
                    <!--                        --><?php
                    //                        $desc = Yii::$app->controller->truncate($model->description, 20, 300);
                    //                        echo $desc;
                    //                        ?>
                    <!--                    </div>-->
                </div>
            </div>
        </article>
    <?php } ?>
<?php } ?>

