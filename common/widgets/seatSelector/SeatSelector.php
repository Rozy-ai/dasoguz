<?php
/**
 * Created by PhpStorm.
 * User: Fujitsu
 * Date: 1.4.2017
 * Time: 9:00 AM
 */

namespace common\widgets\seatSelector;

use common\models\wrappers\EventToSeatWrapper;
use common\models\wrappers\EventWrapper;
use common\models\wrappers\ItemWrapper;
use common\models\wrappers\SeatWrapper;
use common\widgets\items\listview\ListWidget;
use yii\helpers\ArrayHelper;

class SeatSelector extends \yii\base\Widget
{
    public $eventId;
    public $list;
    public $inputId;
    public $seats;
    public $availableSeats;
    public $isShowOnlyAvailableSeats;
    public $location;
    public $viewType;


    public function init()
    {
        $view = $this->getView();
        SeatSelectorAsset::register($view);
        parent::init();

        if (!isset($this->isShowOnlyAvailableSeats)) {
            $this->isShowOnlyAvailableSeats = true;
        }

        $this->seats = [];
        $this->availableSeats = [];
        if (!isset($this->viewType)) {
            $this->viewType = 'grid';
        }

    }


    public function run()
    {

        $eventModel = EventWrapper::find()->where(['id' => $this->eventId])->one();
        if (isset($eventModel)) {
            $this->location = $eventModel->location;
            $seats = SeatWrapper::find()->where(['location_id' => $eventModel->location_id])->orderBy('label_y asc')->all();

            if ($this->isShowOnlyAvailableSeats) {
                $eventToSeats = $eventModel->getAvailableSeatsQuery()->all();
            } else
                $eventToSeats = EventToSeatWrapper::find()->where(['event_id' => $eventModel->id])->all();

            $eventToSeatBySeatIdList = [];
            foreach ($eventToSeats as $eventToSeat) {
                $eventToSeatBySeatIdList[$eventToSeat->seat_id] = $eventToSeat;

                $seat = $eventToSeat->seat;
                $seatPrice = (float)$eventToSeat->price;
                if (isset($eventToSeat->discount))
                    $seatPrice -= (float)$eventToSeat->discount;

                $this->availableSeats[$seat->id] = [
                    'seat_id' => $seat->id,
                    'seat_group_name' => $seat->seatGroup->name,
                    'seat_label_x' => $seat->label_x,
                    'seat_label_y' => $seat->label_y,
                    'seat_price' => $seatPrice,
                    'seat_name' => $seat->name,
                ];
            }


            foreach ($seats as $seat) {
                if (!isset($this->seats[$seat->seat_group_id])) {
                    $this->seats[$seat->seat_group_id] = [];
                }

                if (!isset($this->seats[$seat->seat_group_id][$seat->label_y])) {
                    $this->seats[$seat->seat_group_id][$seat->label_y] = [];
                }

                $price = 0;
                if (isset($eventToSeatBySeatIdList[$seat->id])) {
                    $price = $eventToSeatBySeatIdList[$seat->id]->price;
                    $seat->eventToSeat = $eventToSeatBySeatIdList[$seat->id];
                }

                if (!isset($this->seats[$seat->seat_group_id][$seat->label_y][$price])) {
                    $this->seats[$seat->seat_group_id][$seat->label_y][$price] = [];
                }

                if (isset($seat->eventToSeat))
                    $this->seats[$seat->seat_group_id][$seat->label_y][$price][] = $seat;
            }
        }

        return $this->render($this->viewType);
    }
}