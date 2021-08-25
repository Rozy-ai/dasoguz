<?php
use yii\helpers\Html;

$list = $this->context->list;
?>

<div class="event-list">
    <?php
    if (isset($list) && count($list) > 0) { ?>

        <?php foreach ($list as $key => $model) {
            $contentModel = $model->loadContent();
            $locationModel = $model->location;
            if (isset($contentModel) && isset($locationModel)) { ?>
                <div class="row event-entry">

                    <div class="col-md-2 col-xs-5">
                        <div class="entry-date">
                            <time datetime="<?php echo Yii::$app->controller->dateToW3C($model->start_time); ?>"></time>

                            <div
                                class="date_day"><?php echo Yii::$app->controller->renderDateToWord($model->start_time, null, null); ?></div>
                            <div class="date_other_parts">
                                <div
                                    class="date_week"><?php echo Yii::$app->controller->renderDateWeekDay($model->start_time); ?></div>
                                <div
                                    class="date_month"><?php echo Yii::$app->controller->renderDateToWord($model->start_time, 'm', null, false); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 col-xs-2">
                        <div class="entry-time">
                            <?php echo Yii::$app->controller->renderDateTime($model->start_time, true, 'H:i', null); ?>
                        </div>
                    </div>

                    <div class="col-md-5 hidden-xs">
                        <div class="entry-location">
                            <?php echo $locationModel->fullTitle; ?>
                        </div>
                    </div>

                    <div class="col-md-2 hidden-xs">
                        <div class="entry-seat-count">
                            <?php
                            $count = $model->getAvailableSeatCount();
                            if (isset($count)) {
                                echo Yii::t('app', 'Available seats') . ': ' . $count;
                            } ?>
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-5">
                        <div class="entry-ticket-select">
                            <?php
                            if (isset($count) && $count > 0) { ?>
                                <a href="<?= \yii\helpers\Url::to(['ticket/checkout', 'event_id' => $model->id]) ?>"
                                   class="btn btn-ticket"><?= Yii::t('app', 'Buy ticket') ?> <i
                                        class="fa fa-ticket"></i></a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-default"
                                   disabled="disabled"><?= Yii::t('app', 'No available seats') ?> </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>

    <?php } ?>
</div>
