<?php

namespace common\models\wrappers;

use common\models\EventToSeat;
use Yii;

class EventToSeatWrapper extends EventToSeat
{

    public $ticket_unique_code, $seat_name;

    public function getEvent()
    {
        return $this->hasOne(EventWrapper::className(), ['id' => 'event_id']);
    }

    public function getTicket()
    {
        return $this->hasOne(TicketWrapper::className(), ['id' => 'ticket_id']);
    }

    public function getSeatGroup()
    {
        return $this->hasOne(SeatGroupWrapper::className(), ['id' => 'seat_group_id']);
    }

    public function getSeat()
    {
        return $this->hasOne(SeatWrapper::className(), ['id' => 'seat_id']);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!isset($this->seat_group_id)) {
                $seat = $this->seat;
                if (isset($seat)) {
                    $this->seat_group_id = $seat->seat_group_id;
                }
            }
            return true;
        } else {
            return false;
        }
    }


    const STATUS_AVAILABLE = 0, STATUS_BOOKED = 1, STATUS_PENDING_PAYMENT = 2, STATUS_SOLD = 3, STATUS_OCCUPIED = 4;

    public static function getStatusOptions()
    {
        return array(
            self::STATUS_AVAILABLE => Yii::t('app', 'STATUS_AVAILABLE'),
            self::STATUS_BOOKED => Yii::t('app', 'STATUS_BOOKED'),
            self::STATUS_SOLD => Yii::t('app', 'STATUS_SOLD'),
            self::STATUS_PENDING_PAYMENT => Yii::t('app', 'STATUS_PENDING_PAYMENT'),
            self::STATUS_OCCUPIED => Yii::t('app', 'STATUS_OCCUPIED')
        );
    }

    public function getStatusText()
    {
        $statusOptions = $this->getStatusOptions();
        return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : '';
    }


    public function isSeatAvailable($is_booked_available = false)
    {

        if ($this->status == self::STATUS_AVAILABLE)
            return true;

        if ($is_booked_available) {
            if ($this->status == self::STATUS_BOOKED)
                return true;
        }

        if ($this->status == self::STATUS_PENDING_PAYMENT && isset($this->status_change_time)) {
            $failedPaymentExpirePeriod = isset(Yii::$app->params['paymentOrder.paymentPendingExpireSecs']) ? (int)Yii::$app->params['paymentOrder.paymentPendingExpireSecs'] : 300;
            $lastFailedPaymentExpireDate = new \DateTime();
            $lastFailedPaymentExpireDate->sub(new \DateInterval("PT" . $failedPaymentExpirePeriod . "S"));

            $lastStatusChangeDateTime = new \DateTime($this->status_change_time);
            if ($lastStatusChangeDateTime < $lastFailedPaymentExpireDate) {
                return true;
            }
        }

        //otherwise reutrn false
        return false;
    }
}
