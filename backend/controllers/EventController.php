<?php

namespace backend\controllers;

use backend\models\SeatPriceForm;
use common\components\CommonController;
use common\models\EventToSeat;
use common\models\search\EventSearch;
use common\models\search\TicketSearch;
use common\models\wrappers\EventToSeatWrapper;
use common\models\wrappers\EventWrapper;
use common\models\wrappers\SeatWrapper;
use common\models\wrappers\TicketWrapper;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * EventController implements the CRUD actions for EventWrapper model.
 */
class EventController extends CommonController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EventWrapper models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $searchModel->isActual = true;
        if (!isset($_GET['sort'])) {
            $_GET['sort'] = 'start_time';
        }

        $user = Yii::$app->user->identity;
        $searchModel->location_ids = $user->locs;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EventWrapper model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $eventModel = $this->findModel($id);
        $ticketModel = new \common\models\wrappers\TicketWrapper();
        $ticketModel->event_id = $eventModel->id;

        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '-id';
        }

        $ticketSearchModel = new TicketSearch();
//        $ticketSearchModel->status = TicketWrapper::STATUS_SUCCESS;
        $user = Yii::$app->user->identity;
        $ticketSearchModel->location_ids = $user->locs;
        $ticketSearchModel->event_id = $eventModel->id;

        $ticketDataProvider = $ticketSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('/event/view', array(
            'eventModel' => $eventModel,
            'ticketModel' => $ticketModel,
            'ticketSearchModel' => $ticketSearchModel,
            'ticketDataProvider' => $ticketDataProvider,
        ));
    }

    /**
     * Creates a new EventWrapper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EventWrapper();

        $post = Yii::$app->request->post();
        if (isset($post) && count($post) > 0) {
            $model->load($post);
            if (isset($model->start_time)) {
                $start_time = new \DateTime($model->start_time);
                $model->start_time = $start_time->format('Y-m-d H:i:s');
            }
            if ($model->save()) {
                if ($model->generateEventSeats()) {
                    \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'Event has been created please fill prices'));
                    return $this->redirect(['update', 'id' => $model->id]);
                }
            } else {
                \Yii::$app->getSession()->setFlash('danger', \Yii::t('app', 'Cannot create event'));
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EventWrapper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if (isset($post) && count($post) > 0) {
            $model->load($post);
            if (isset($model->start_time)) {
                $start_time = new \DateTime($model->start_time);
                $model->start_time = $start_time->format('Y-m-d H:i:s');
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->generateEventSeats();
//            $eventSeatCount = EventToSeatWrapper::find()->where(['event_id' => $model->id])->count();
//            if ($eventSeatCount == 0) {
//                $model->generateEventSeats();
//            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EventWrapper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionToggle($id)
    {
        $model = $this->findModel($id);
        $model->status = !$model->status;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the EventWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventWrapper::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionSeatPrice($seat_group_id)
    {
        $model = new SeatPriceForm();
        if (isset($_GET['seat_group_id']) && isset($_GET['event_id'])) {
            $model->seat_group_id = $_GET['seat_group_id'];
            $model->event_id = $_GET['event_id'];

            $eventToSeat = EventToSeatWrapper::find()->where(['event_id' => $model->event_id, 'seat_group_id' => $model->seat_group_id])->one();
            if (isset($eventToSeat)) {
                $model->price = $eventToSeat->price;
                $model->discount = $eventToSeat->discount;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $message = array();
            if (isset($model->event_id) && isset($model->seat_group_id)) {
                if (EventToSeatWrapper::updateAll(['price' => $model->price, 'discount' => $model->discount], ['event_id' => $model->event_id, 'seat_group_id' => $model->seat_group_id])) {
                    $message['status'] = 'success';
                    $message['message'] = 'Message successfully sent';
                } else {
                    $message['status'] = 'error';
                    $message['message'] = 'Message failed due to internal error';
                }
            }

            echo Json::encode($message);
        } else {
            return $this->renderAjax('_seat_price_dialog', [
                'model' => $model,
            ]);
        }
    }


    /**
     * [actionJsoncalendar description]
     * @param  [type] $start [description]
     * @param  [type] $end   [description]
     * @param  [type] $_     [description]
     * @return [type]        [description]
     */
    public function actionEventCalendar($start = NULL, $end = NULL, $_ = NULL)
    {
        $events = array();

        $searchModel = new EventSearch();
        if (!Yii::$app->user->can('admin')) {
            $user = Yii::$app->user->identity;
            $location_ids = $user->locs;
            $searchModel->location_ids = $location_ids;
        }

        $date = new \DateTime();
        $searchModel->afterStartDatetime = $date;

        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '-start_time';
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, '');
        $dataProvider->pagination->pageSize = 100;
        $eventModels = $dataProvider->getModels();
        foreach ($eventModels as $eventModel) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $eventModel->id;
            $Event->title = $eventModel->title;
            $start_time = new \DateTime($eventModel->start_time);
            $Event->start = $start_time->format('Y-m-d');
//            $Event->url = $eventModel->url;
            $Event->url = Url::to(['/event/view', 'id' => $eventModel->id]);
            $events[] = $Event;
        }
        header('Content-type: application/json');
        echo Json::encode($events);
        exit(1);
//        Yii::$app->end(1);
    }


//    public function actionBook()
//    {
//        $user = Yii::$app->user->identity;
//        $location_ids = $user->locs;
//        $errors = [];
//
//        $data = Yii::$app->request->getBodyParams();
//        $response = array();
//        $booked_seats = [];
//
//        if (!isset($data) || count($data) == 0)
//            $errors[] = 'No body request provided';
//
//        if (!isset($location_ids) || count($location_ids) == 0)
//            $errors[] = 'No locations found related to user';
//
//
//        if (!isset($data['event_id']))
//            $errors[] = 'Event id not provided';
//
//
//        if (count($errors) == 0) {
//            $eventModel = EventWrapper::find()->where(['id' => $data['event_id']])
//                ->andWhere(['in', 'location_id', $location_ids])
//                ->one();
//
//            if (isset($eventModel)) {
//                $query = EventToSeatWrapper::find();
//                $query->andWhere(['event_id' => $eventModel->id]);
////                $query->andWhere(['status' => EventToSeatWrapper::STATUS_AVAILABLE]);
//                if (isset($data['seats'])) {
//                    $query->andWhere(['in', 'seat_id', $data['seats']]);
//                }
//
//                $availableEventToSeats = $query->all();
//                if (isset($availableEventToSeats) && count($availableEventToSeats) > 0) {
//                    foreach ($availableEventToSeats as $availableEventToSeat) {
//                        if ($availableEventToSeat->isSeatAvailable()) {
//                            $availableEventToSeat->status = EventToSeatWrapper::STATUS_BOOKED;
//                            if ($availableEventToSeat->save()) {
//                                $booked_seats[] = $availableEventToSeat->seat_id;
//                            }
//                        }
//                    }
//
//                    $response['status'] = 'success';
//                    $response['message'] = 'Seats booked';
//                    $response['data'] = $booked_seats;
//                } else {
//                    $errors[] = 'No available seats found for booking';
//                }
//            }
//        }
//
//        if (isset($errors) && count($errors) > 0) {
//            $response['status'] = 'error';
//            $response['message'] = 'Error occured';
//            $response['errors'] = ArrayHelper::merge(['message' => null], $errors);
//        }
//
//
//        echo Json::encode($response);
//    }
//
//
//    public function actionUnbook()
//    {
//        $user = Yii::$app->user->identity;
//        $location_ids = $user->locs;
//        $errors = [];
//
//        $data = Yii::$app->request->getBodyParams();
//        $response = array();
//        $unbooked_seats = [];
//
//        if (!isset($data) || count($data) == 0)
//            $errors[] = 'No body request provided';
//
//        if (!isset($location_ids) || count($location_ids) == 0)
//            $errors[] = 'No locations found related to user';
//
//
//        if (!isset($data['event_id']))
//            $errors[] = 'Event id not provided';
//
//
//        if (count($errors) == 0) {
//            $eventModel = EventWrapper::find()->where(['id' => $data['event_id']])
//                ->andWhere(['in', 'location_id', $location_ids])
//                ->one();
//
//            if (isset($eventModel)) {
//                $query = EventToSeatWrapper::find();
//                $query->andWhere(['event_id' => $eventModel->id]);
////                $query->andWhere(['status' => EventToSeatWrapper::STATUS_AVAILABLE]);
//                if (isset($data['seats'])) {
//                    $query->andWhere(['in', 'seat_id', $data['seats']]);
//                }
//
//                $availableEventToSeats = $query->all();
//                if (isset($availableEventToSeats) && count($availableEventToSeats) > 0) {
//                    foreach ($availableEventToSeats as $availableEventToSeat) {
//                        if ($availableEventToSeat->status == EventToSeatWrapper::STATUS_BOOKED) {
//                            $availableEventToSeat->status = EventToSeatWrapper::STATUS_AVAILABLE;
//                            if ($availableEventToSeat->save()) {
//                                $unbooked_seats[] = $availableEventToSeat->seat_id;
//                            }
//                        }
//                    }
//
//                    $response['status'] = 'success';
//                    $response['message'] = 'Seats unbooked';
//                    $response['data'] = $unbooked_seats;
//                } else {
//                    $errors[] = 'No available seats found for booking';
//                }
//            }
//        }
//
//        if (isset($errors) && count($errors) > 0) {
//            $response['status'] = 'error';
//            $response['message'] = 'Error occured';
//            $response['errors'] = ArrayHelper::merge(['message' => null], $errors);
//        }
//
//
//        echo Json::encode($response);
//    }


    public function actionBook($event_id)
    {
        $message = array();
        $eventQuery = EventWrapper::find()->where(['id' => $event_id]);
        if (!Yii::$app->user->can('admin')) {
            $user = Yii::$app->user->identity;
            $eventQuery->andWhere(['in', 'location_id', $user->locs]);
        }

        $eventModel = $eventQuery->one();
        $seatModel = new SeatWrapper();
        $seatModel->location_id = $eventModel->location_id;

        $post = Yii::$app->request->post();
        if (isset($post['SeatWrapper']) && $seatModel->load($post) && isset($eventModel)) {
            $post = $post['SeatWrapper'];

            $query = EventToSeatWrapper::find()->where(['event_id' => $eventModel->id]);
            if (isset($seatModel->seat_group_id)) {
                $query->joinWith('seat s', false)
                    ->andFilterWhere(['s.seat_group_id' => $seatModel->seat_group_id]);
            }

            if (isset($seatModel->label_y)) {
                $query->joinWith('seat s', false)
                    ->andFilterWhere(['s.label_y' => $seatModel->label_y]);
            }

            if (isset($seatModel->label_x_start) && isset($seatModel->label_x_end)) {
                $query->joinWith('seat s', false)
                    ->andFilterWhere(['and', 's.label_x>=' . $seatModel->label_x_start, 's.label_x<=' . $seatModel->label_x_end]);
            }


            $availableEventToSeats = $query->all();
            if (isset($availableEventToSeats) && count($availableEventToSeats) > 0) {
                foreach ($availableEventToSeats as $availableEventToSeat) {
                    if ($availableEventToSeat->isSeatAvailable()) {
                        $availableEventToSeat->status = EventToSeatWrapper::STATUS_BOOKED;
                        if ($availableEventToSeat->save()) {
                            $booked_seats[] = $availableEventToSeat->seat_id;
                        }
                    }
                }

                $message['status'] = 'success';
                $message['message'] = 'Seats booked';
                $message['data'] = $booked_seats;
            } else {
                $message['errors'] = 'No available seats found for booking';
            }

            echo Json::encode($message);
        } else {
            return $this->renderAjax('_book_dialog', [
                'seatModel' => $seatModel,
            ]);
        }
    }


    public function actionUnbook($event_id)
    {
        $message = array();
        $eventQuery = EventWrapper::find()->where(['id' => $event_id]);
        if (!Yii::$app->user->can('admin')) {
            $user = Yii::$app->user->identity;
            $eventQuery->andWhere(['in', 'location_id', $user->locs]);
        }

        $eventModel = $eventQuery->one();
        $seatModel = new SeatWrapper();
        $seatModel->location_id = $eventModel->location_id;

        $post = Yii::$app->request->post();
        if (isset($post['SeatWrapper']) && $seatModel->load($post) && isset($eventModel)) {
            $post = $post['SeatWrapper'];

            $query = EventToSeatWrapper::find()->where(['event_id' => $eventModel->id]);
            if (isset($seatModel->seat_group_id)) {
                $query->joinWith('seat s', false)
                    ->andFilterWhere(['s.seat_group_id' => $seatModel->seat_group_id]);
            }

            if (isset($seatModel->label_y)) {
                $query->joinWith('seat s', false)
                    ->andFilterWhere(['s.label_y' => $seatModel->label_y]);
            }

            if (isset($seatModel->label_x_start) && isset($seatModel->label_x_end)) {
                $query->joinWith('seat s', false)
                    ->andFilterWhere(['and', 's.label_x>=' . $seatModel->label_x_start, 's.label_x<=' . $seatModel->label_x_end]);
            }


            $availableEventToSeats = $query->all();
            if (isset($availableEventToSeats) && count($availableEventToSeats) > 0) {
                foreach ($availableEventToSeats as $availableEventToSeat) {
                    if ($availableEventToSeat->status == EventToSeatWrapper::STATUS_BOOKED) {
                        $availableEventToSeat->status = EventToSeatWrapper::STATUS_AVAILABLE;
                        if ($availableEventToSeat->save()) {
                            $unbooked_seats[] = $availableEventToSeat->seat_id;
                        }
                    }
                }

                $message['status'] = 'success';
                $message['message'] = 'Seats unbooked';
                $message['data'] = $unbooked_seats;
            } else {
                $message['errors'] = 'No available seats found for booking';
            }

            echo Json::encode($message);
        } else {
            return $this->renderAjax('_unbook_dialog', [
                'seatModel' => $seatModel,
            ]);
        }
    }


}
