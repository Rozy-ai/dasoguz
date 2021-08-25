<?php
use yii\web\JsExpression;

/* @var $this yii\web\View */

$this->title = 'Welcome to ' . Yii::$app->name . 'admin panel!';
?>
<?php
echo 'Current PHP version: ' . phpversion();
echo "current time: ";
$dateTime = new DateTime();
echo $dateTime->format('d-m-Y H:i:s');
echo \Yii::$app->formatter->asDate(new \DateTime(), 'yyyy-MM-dd HH:mm:ss');
?>

<?php

//
//echo "PHP: " . PHP_VERSION . "\n";
//echo "ICU: " . INTL_ICU_VERSION . "\n";
?>

<div class="site-index">
    <?php
    $JSCode = <<<EOF
        function(start, end) {
            var title = prompt('Event Title:');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#w0').fullCalendar('renderEvent', eventData, true);
            }
            $('#w0').fullCalendar('unselect');
        }
EOF;
    $JSDropEvent = <<<EOF
        function(date) {
            alert("Dropped on " + date.format());
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        }
EOF;
    $JSEventClick = <<<EOF
                function(calEvent, jsEvent, view) {
                    alert('Event: ' + calEvent.title);
                    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                    alert('View: ' + view.name);
                    // change the border color just for fun
                    $(this).css('border-color', 'red');
                }
EOF;
    ?>


<!--    <div class="row">-->
<!--        <div class="col-md-8">-->
<!--            --><?php
//            echo \yii2fullcalendar\yii2fullcalendar::widget(array(
//                'clientOptions' => [
//                    'selectable' => true,
//                    'selectHelper' => true,
//                    'droppable' => true,
//                    'editable' => true,
//                    'firstDay' => 1,
//                    'drop' => new JsExpression($JSDropEvent),
////        'select' => new JsExpression($JSCode),
////        'eventClick' => new JsExpression($JSEventClick),
////            'defaultDate' => date('Y-m-d')
//                ],
//                'ajaxEvents' => \yii\helpers\Url::toRoute(['/event/event-calendar'])
//            ));
//            ?>
<!--        </div>-->
<!--    </div>-->
