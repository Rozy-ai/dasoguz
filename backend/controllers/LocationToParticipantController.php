<?php

namespace backend\controllers;

use common\models\wrappers\LocationWrapper;
use common\models\wrappers\ShowWrapper;
use Yii;
use common\models\wrappers\LocationToParticipantWrapper;
use common\models\search\ShowToParticipantSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShowToParticipantController implements the CRUD actions for LocationToParticipantWrapper model.
 */
class LocationToParticipantController extends Controller
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
     * Lists all LocationToParticipantWrapper models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShowToParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LocationToParticipantWrapper model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LocationToParticipantWrapper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LocationToParticipantWrapper();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LocationToParticipantWrapper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LocationToParticipantWrapper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the LocationToParticipantWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LocationToParticipantWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LocationToParticipantWrapper::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionDialog()
    {
        $model = new LocationToParticipantWrapper();
        if (isset($_GET['id'])) {
            $model = LocationToParticipantWrapper::find()->where(['id' => $_GET['id']])->one();
        }

        if (isset($_GET['location_id'])) {
            $location = LocationWrapper::find()->where(['id' => $_GET['location_id']])->one();
            $model->location_id = $location->id;
        }

        $post = Yii::$app->request->post();
        if (isset($post['LocationToParticipantWrapper']) && $model->load($post)) {
            $post = $post['LocationToParticipantWrapper'];


            if (isset($post['date_joined']) && strlen(trim($post['date_joined'])) > 0)
                $model->date_joined = \Yii::$app->formatter->asDate($model->date_joined, 'yyyy-MM-dd');
            else
                $model->date_joined = null;

            if (isset($post['date_leaved']) && strlen(trim($post['date_leaved'])) > 0) {
                $model->date_leaved = \Yii::$app->formatter->asDate($model->date_leaved, 'yyyy-MM-dd');
                $model->status = LocationToParticipantWrapper::STATUS_ARCHIVE;
            } else {
                $model->date_leaved = null;
                $model->status = LocationToParticipantWrapper::STATUS_ACTIVE;
            }

            $message = array();
            if ($model->save()) {
                $message['status'] = 'success';
                $message['message'] = 'Seat saved';
            } else {
                $message['status'] = 'error';
                $message['message'] = 'Seat save failed';
                $message['errors'] = $model->getErrors();
            }

            echo Json::encode($message);
        } else {
            return $this->renderAjax('_dialog', [
                'model' => $model,
            ]);
        }
    }
}
