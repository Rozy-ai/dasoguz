<?php
use yii\helpers\Html;

$items = $this->context->items;
$forDate = new \common\models\CommonActiveRecord();
if (isset($items) && count($items) > 0) { ?>

    <?php foreach ($items as $key => $data) { ?>
        <?php
        if ($count == $this->context->items['limit'])
            break;
        if ($data->date_event == null)
            continue;
        $date_event = Yii::$app->formatter->asDate($data->date_event, 'dd-MM-Y');
        $day = Yii::$app->formatter->asDate($data->date_event, 'd');
        $month = Yii::$app->formatter->asDate($data->date_event, 'm');
        $year = Yii::$app->formatter->asDate($data->date_event, 'Y');

        if ( strtotime($date_event)<time()){
              continue;
            } else
                $count++;

        ?>
        <div class="near_event_article">
            <div class="date" style="text-align: left;">
                <span  class="top_date">
                    <?php
                    $month = Yii::$app->formatter->asDate($data->date_event, 'MM');
                    $day = Yii::$app->formatter->asDate($data->date_event, 'dd');
                    $date = Yii::$app->controller->renderDateToWord($date_event,'m',null).', '.trim(Yii::$app->controller->renderDateWeekDay($data->date_event));
                    echo Html::a($date, $data->url, array('rel' => 'bookmark'))?>
                </span>
            </div>
            <div class="near_event_title">
                <span><?php
                    $title = Yii::$app->controller->truncate($data->title, 20, 100);
                    echo Html::a($title, $data->url, array('rel' => 'bookmark'));
                    ?></span>
            </div>
        </div>
    <?php }; ?>
<?php } ?>
