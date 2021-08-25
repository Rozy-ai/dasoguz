<?php

namespace backend\controllers;

use common\components\CommonController;
use common\models\RoutePoint;
use common\models\wrappers\RoutePointWrapper;
use Yii;
use common\models\wrappers\RouteWrapper;
use common\models\wrappers\PointWrapper;
use common\models\search\RouteSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


/**
 * RouteController implements the CRUD actions for RouteWrapper model.
 */
class RouteController extends CommonController {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all RouteWrapper models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RouteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->pagination->setPageSize(100);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RouteWrapper model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $routePoint = new RoutePoint();

        $dataProvider = new ActiveDataProvider([
            'query' => RoutePoint::find()->where('route_id=:route_id', [':route_id' => $model->id])->orderBy('price'),
        ]);

        return $this->render('view', [
            'model' => $model,
            'point' => $routePoint,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new RouteWrapper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new RouteWrapper();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
              // $model->route_no = $model->route_no+1;
              $model = RouteWrapper::find()->where(['route_no'=>$model->route_no])->one();
              $model->type = 1;
              // $model->points = "";
              // var_dump($model->points);die;
                // RoutePointWrapper::savePoint($model->id, $model->from_point_id);
                // RoutePointWrapper::savePoint($model->id, $model->to_point_id);
              return $this->render('create', [
            'model' => $model,
        ]);
                // return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RouteWrapper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddPoint($route_id, $route_point_id) {
        $model = $this->findModel($route_id);
        $routePoint = RoutePoint::findOne($route_point_id);

        if (!isset($routePoint))
            $routePoint = new RoutePoint();

        if (Yii::$app->request->isPost) {

            $routePoint->load(Yii::$app->request->post());
            if ($routePoint->save()) {
                $model->setWayPoints();
            }

            return $this->redirect(['view', 'id' => $route_id]);
        }

        return $this->render('add_point', [
            'route' => $model,
            'model' => isset($routePoint) ? $routePoint : new RoutePoint()
        ]);
    }

    /**
     * Deletes an existing RouteWrapper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletePoint($id) {
        $routePoint = RoutePoint::findOne($id);
        $model = $this->findModel($routePoint->route_id);

        if (isset($routePoint)) {
            $routePoint->delete();

            $model->setWayPoints();
            return $this->redirect(['route/view', 'id' => $routePoint->route_id]);
        }

        return $this->redirect(['index']);
    }

    public function actionUpdateWaypoints() {
        if (isset($_POST["route_id"]) && $_POST["waypoints"]) {
            $model = $this->findModel($_POST["route_id"]);
            $model->waypoints = $_POST["waypoints"];

            $model->update(false);
        }
    }

    /**
     * Finds the RouteWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RouteWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RouteWrapper::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


      public function actionPoints($id)
    {
        $route = $this->findModel($id);
        $selectedPoints = json_decode($route->points);


        $points = ArrayHelper::map(PointWrapper::find()->all(),'id','name');
  
  

        if (Yii::$app->request->Ispost) {
             // var_dump(Yii::$app->request->post());die;
            $points = Yii::$app->request->post('routes');
            $points = explode(',', $points);
            unset($points[count($points) -1]);
            $points = json_encode($points);

            $route->points = $points;
            $route->save();
            return $this->redirect(['view','id'=>$route->id ]);
        }

        return $this->render('points', [
            'selectedPoints' => $selectedPoints,
            'points' => $points,
        ]
    );
    }
}
