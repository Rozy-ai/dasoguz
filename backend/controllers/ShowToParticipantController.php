<?php

namespace backend\controllers;

use common\models\wrappers\ShowWrapper;
use Yii;
use common\models\wrappers\ShowToParticipantWrapper;
use common\models\search\ShowToParticipantSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShowToParticipantController implements the CRUD actions for ShowToParticipantWrapper model.
 */
class ShowToParticipantController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all ShowToParticipantWrapper models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ShowToParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShowToParticipantWrapper model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShowToParticipantWrapper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ShowToParticipantWrapper();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ShowToParticipantWrapper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ShowToParticipantWrapper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ShowToParticipantWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShowToParticipantWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ShowToParticipantWrapper::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionDialog() {
        $model = new ShowToParticipantWrapper();
        if (isset($_GET['id'])) {
            $model = ShowToParticipantWrapper::find()->where(['id' => $_GET['id']])->one();
        }

        if (isset($_GET['show_id'])) {
            $show = ShowWrapper::find()->where(['id' => $_GET['show_id']])->one();
            $model->show_id = $show->id;
        }

//        if (isset($_GET['type'])) {
//            $model->type = $_GET['type'];
//        }

        $post = Yii::$app->request->post();
        if (isset($post['ShowToParticipantWrapper']) && $model->load($post)) {
            $post = $post['ShowToParticipantWrapper'];


            if (isset($post['date_joined']) && strlen(trim($post['date_joined'])) > 0)
                $model->date_joined = \Yii::$app->formatter->asDate($model->date_joined, 'yyyy-MM-dd');
            else
                $model->date_joined = null;

            if (isset($post['date_leaved']) && strlen(trim($post['date_leaved'])) > 0) {
                $model->date_leaved = \Yii::$app->formatter->asDate($model->date_leaved, 'yyyy-MM-dd');
                $model->status = ShowToParticipantWrapper::STATUS_ARCHIVE;
            } else {
                $model->date_leaved = null;
                $model->status = ShowToParticipantWrapper::STATUS_ACTIVE;
            }

            $message = array ();
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
