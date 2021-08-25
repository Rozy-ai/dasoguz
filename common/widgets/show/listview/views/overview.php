<?php
use yii\helpers\Html;

$list = $this->context->list;
?>

<div class="event-box">
    <?php
    if (isset($list) && count($list) > 0) { ?>
        <div class="row">
            <?php foreach ($list as $key => $model) {
                $href = $model->url;
                ?>
                <div class="col-sm-4 col-md-4">
                    <article id="post-34" class="entry-box">

                        <div class="entry-image">
                            <?php
                            $imgsrc = $model->content->getThumbPath(350, 220);
                            echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'entry-featured-image-url']), $href);
                            ?>
                        </div>

                        <div class="entry-content">
                            <div class="entry-header">
                                <h6 class="entry-title">
                                    <?= Html::a($model->content->title, $href) ?>
                                </h6>
                            </div>

                            <div class="entry-desc">
                                <?php
                                $desc = Yii::$app->controller->truncate($model->content->description, 20, 300);
                                echo $desc;
                                ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php } ?>

            <div class="col-sm-12">
                <div class="widget-show-all">
                    <?php if (isset($this->context->show_all_url)) { ?>
                        <a href="<?= $this->context->show_all_url ?>"><?= $this->context->show_all_title ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
