<?php

namespace common\models\wrappers;

use common\models\Event;
use yii\db\Query;
use yii\helpers\Url;
use Yii;


class EventWrapper extends Event
{
    private $_url;
    private $_content;
    public $afterStartDatetime;

    public function getUrl($absolute = false)
    {
        if ($this->_url === null)
            $this->_url = Url::to(['event/view', 'id' => $this->id]);

        if ($absolute == true)
            $this->_url = Url::toRoute($this->_url);
        return $this->_url;
    }

    public function rules()
    {
        return \yii\helpers\ArrayHelper::merge(parent::rules(), [
            [['status'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return \yii\helpers\ArrayHelper::merge(parent::attributeLabels(), [
            'isActual' => Yii::t('app', 'Only Acutal events'),
            'location_id' => Yii::t('app', 'Location Title'),
            'title' => Yii::t('app', 'Event Title'),
            'show_title' => Yii::t('app', 'Event search by title'),
            'event_start_day' => Yii::t('app', 'Event day'),
            'event_start_hour' => Yii::t('app', 'Event hour'),
        ]);
    }

    public function getContent()
    {
        return $this->hasOne(ItemWrapper::className(), ['id' => 'content_item_id']);
    }

    public function getLocation()
    {
        return $this->hasOne(LocationWrapper::className(), ['id' => 'location_id']);
    }


    public function getShow()
    {
        return $this->hasOne(ShowWrapper::className(), ['id' => 'show_id']);
    }


    public function loadContent()
    {
        if (isset($this->_content))
            return $this->_content;

        if (isset($this->content_item_id)) {
            $this->_content = ItemWrapper::find()->where(['id' => $this->content_item_id])->multilingual()->one();
        } else {
            $show = $this->show;
            if (isset($show)) {
                $this->_content = $show->loadContent();
            }
        }

        return $this->_content;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $show = ShowWrapper::find()->where(['id' => $this->show_id])->one();
            if (isset($show) && isset($show->content_item_id)) {
                $this->content_item_id = $show->content_item_id;
                if (!isset($this->location_id))
                    $this->location_id = $show->location_id;


                if ($this->start_time) {
                    $event_start_date = new \DateTime($this->start_time);
                    if (!isset($show->latest_event_date)) {
                        $show->latest_event_date = \Yii::$app->formatter->asDate($event_start_date, 'yyyy-MM-dd HH:mm:ss');
                        $show->save();
                    } else {
                        $today = new \DateTime();
                        $latest_event_date = new \DateTime($show->latest_event_date);
                        if ($event_start_date < $latest_event_date || $latest_event_date < $today) {
                            $show->latest_event_date = \Yii::$app->formatter->asDate($event_start_date, 'yyyy-MM-dd HH:mm:ss');
                            $show->save();
                        }
                    }
                }
            }

            return true;
        } else {
            return false;
        }
    }

    public function generateEventSeats()
    {
        $commited = true;
        if (isset($this->location_id)) {
            $seatModels = SeatWrapper::find()->where(['location_id' => $this->location_id])->all();
            foreach ($seatModels as $seatModel) {
                $eventToSeat = EventToSeatWrapper::find()->where(['event_id' => $this->id, 'seat_id' => $seatModel->id])->one();
                if (!isset($eventToSeat)) {
                    $eventToSeat = new EventToSeatWrapper();
                    $eventToSeat->event_id = $this->id;
                    $eventToSeat->seat_id = $seatModel->id;
                    $eventToSeat->seat_group_id = $seatModel->seat_group_id;
                    $eventToSeat->price = 0;
                    $eventToSeat->discount = 0;
                    if (!$eventToSeat->save()) {
                        $commited = false;
                        break;
                    }
                }
            }

            if (!$commited) {
                EventToSeatWrapper::deleteAll(['event_id' => $this->id]);
            }
        }

        return $commited;
    }


    public function fields()
    {
        $fields = parent::fields();
        $fields['title'] = function () {
            $content = $this->loadContent();
            if (isset($content))
                return $content->title;
        };

        $fields['description'] = function () {
            $content = $this->loadContent();
            if (isset($content))
                return $content->description;
        };

        $fields['thumbUrl'] = function () {
            $content = $this->loadContent();
            if (isset($content))
                return $content->getThumbPath(185, 151, 'h', false, false, true);;
        };

        $fields['location_name'] = function () {
            $locationModel = $this->location;
            if (isset($locationModel)) {
                return $locationModel->fullTitle;
            }
        };

        unset($fields['date_created'], $fields['date_modified'], $fields['create_username'], $fields['create_username'], $fields['content_item_id']);
        return $fields;
    }


    public function extraFields()
    {
        $extraFields = parent::extraFields();
        $extraFields['documents'] = function () {
            $thumbs = [];
            $content = $this->loadContent();
            if (isset($content)) {
                $docs = $content->documents;
                foreach ($docs as $document) {
                    $thumb['id'] = $document->id;
                    $thumb['thumbUrl'] = $document->getThumb(250, 250, 'h');
                    $thumb['fullUrl'] = $document->getFullPath();
                    $thumbs[] = $thumb;
                }
            }
            return $thumbs;
        };


        $extraFields['seats'] = function () {
//            $query = $this->getAvailableSeatsQuery();
//            $eventToSeats = $query->all();

            $eventToSeats = EventToSeatWrapper::find()->where(['event_id' => $this->id])->all();
            $seatsData = [];
            foreach ($eventToSeats as $eventToSeat) {
                $eventSeatData = [];
                $seatModel = $eventToSeat->seat;
                if (isset($seatModel)) {
                    $eventSeatData['seat_label_x'] = $seatModel->label_x;
                    $eventSeatData['seat_label_y'] = $seatModel->label_y;
                    $eventSeatData['seat_name'] = $seatModel->name;
                    $eventSeatData['seat_group_id'] = $seatModel->seat_group_id;
                    $eventSeatData['seat_id'] = $eventToSeat->seat_id;
                    $eventSeatData['event_id'] = $eventToSeat->event_id;
                    $eventSeatData['price'] = $eventToSeat->price;
                    $eventSeatData['discount'] = $eventToSeat->discount;

                    $currentStatus = $eventToSeat->status;
                    if ($eventToSeat->isSeatAvailable())
                        $currentStatus = \common\models\wrappers\EventToSeatWrapper::STATUS_AVAILABLE;
                    $eventSeatData['status'] = $currentStatus;
                    $seatsData[] = $eventSeatData;
                }
            }
            return $seatsData;
        };

        $extraFields['seatGroups'] = function () {
            $seatGroups = SeatGroupWrapper::find()->where(['location_id' => $this->location_id])->all();
            $seatGroupsData = [];
            foreach ($seatGroups as $seatGroup) {
                $seatGroupData = [];
                $seatGroupData['id'] = $seatGroup->id;
                $seatGroupData['name'] = $seatGroup->name;
                $seatGroupData['description'] = $seatGroup->description;
//                $seatGroupData['location_id'] = $seatGroup->location_id;
//                $seatGroupData['parent_id'] = $seatGroup->parent_id;
                $seatGroupsData[] = $seatGroupData;
            }
            return $seatGroupsData;
        };

        $extraFields['location'] = function () {
            return $this->location;
        };

        $extraFields['show'] = function () {
            return $this->show;
        };

        return $extraFields;
    }


    /**
     * @return Query the new Query object
     */
    public function getAvailableSeatsQuery()
    {
        $query = EventToSeatWrapper::find()->where(['event_id' => $this->id]);
        $query->andWhere(['>', 'price', 0]);

        $failedPaymentExpirePeriod = isset(Yii::$app->params['paymentOrder.paymentPendingExpireSecs']) ? (int)Yii::$app->params['paymentOrder.paymentPendingExpireSecs'] : 300;
        $lastFailedPaymentExpireDate = new \DateTime();
        $lastFailedPaymentExpireDate->sub(new \DateInterval("PT" . $failedPaymentExpirePeriod . "S"));
        $query->andWhere(['or', ['status' => EventToSeatWrapper::STATUS_AVAILABLE],
            ['and', 'status="' . EventToSeatWrapper::STATUS_PENDING_PAYMENT . '"', 'status_change_time<"' . $lastFailedPaymentExpireDate->format('Y-m-d H:i:s') . '"']]);
        return $query;
    }


    public function getAvailableSeatCount()
    {
        $query = $this->getAvailableSeatsQuery();
        return $query->count();
    }

    public function getTitle()
    {
        $content = $this->loadContent();
        if (isset($content)) {
            return $content->title;
        }
    }

    public function getDescription()
    {
        $content = $this->loadContent();
        if (isset($content)) {
            return $content->description;
        }
    }
}
