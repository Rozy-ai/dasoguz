<?php

namespace frontend\controllers;

use common\components\CommonController;
use Yii;
use common\models\wrappers\RouteWrapper;
use common\models\search\RouteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RouteController implements the CRUD actions for RouteWrapper model.
 */
class RouteController extends CommonController {

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
     * Lists all RouteWrapper models.
     * @return mixed
     */
    public function actionIndex() {
        $this->layout = "bootstrap_bg_solid";
  $searchModel = new RouteSearch();

        if (Yii::$app->request->get()){
            $search = Yii::$app->request->get();
            if (!empty($search['RouteSearch']['point_from']) && empty($search['RouteSearch']['route_no']) && empty($search['RouteSearch']['point_to'])){

                $from = $search['RouteSearch']['point_from'];
                $from = "\"".$from."\"";
                $routes_from = RouteWrapper:: find()->orFilterWhere(['like', 'points', $from])->orderBy('route_no', ASC)->all();  

            
            } else if(!empty($search['RouteSearch']['point_to']) && empty($search['RouteSearch']['route_no'])&& empty($search['RouteSearch']['point_from'])){
             
                $to = $search['RouteSearch']['point_to'];
                $to = "\"".$to."\"";
                $routes_to = RouteWrapper:: find()->orFilterWhere(['like', 'points', $to])->orderBy('route_no', ASC)->all();
                $searchModel->route_no = $search['RouteSearch']['route_no'];
             
            }else if(!empty($search['RouteSearch']['point_to']) && !empty($search['RouteSearch']['point_from']) && empty($search['RouteSearch']['route_no'])){
                 $from = $search['RouteSearch']['point_from'];
                 $to = $search['RouteSearch']['point_to'];
                 // $from = (int)$from;
                 $from = "\"".$from."\"";
                 $to = "\"".$to."\"";
                  $routes = RouteWrapper:: find()->andWhere(
        ['and',
            ['like', 'points', $from],
            ['like', 'points', $to]
        ])->orderBy('route_no', ASC)->all();

     
               
                 if (empty ($routes)) {
                     $routes_from_rf = RouteWrapper:: find()->orFilterWhere(['like', 'points', $from])->orderBy('route_no', ASC)->all();
                     $routes_to_rt = RouteWrapper:: find()->orFilterWhere(['like', 'points', $to])->orderBy('route_no', ASC)->all();



                     foreach ($routes_from_rf as $key => $rfrom) {

                                          $x = 0;
                                          while ( $x<= count($routes_to_rt)) {


                                        // $firsPos = strripos($rfrom->points, $from);
                                        // var_dump($firsPos);die;
                                        // $rfrom->points = mb_substr($rfrom->points, 0, $firsPos); 

                                            // var_dump($rfrom->points);die;
                                        $from_point = json_decode($rfrom->points);
                                        $to_point = json_decode($routes_to_rt[$x]['points']);
                                        $from = json_decode($from);
                                        $to = json_decode($to);
                                        $key = array_search($from, $from_point);
                                        $from_point = array_slice($from_point, $key);

                                        $key = array_search($to, $to_point);
                                        $to_point = array_slice($to_point, 0, $key+1);

                                        foreach ($from_point as $key => $fr) {
                                            if (in_array($fr, $to_point)) {
                                                $transfers = [];
                                                $transfers['from'] = $rfrom;
                                                $transfers['to'] = $routes_to_rt[$x];
                                                $transfers['stop'] = $fr;
                                            }
                                        }

                                          $x++;
                                          }
                                      }


                 }
                 
            } else{
                // $routes = RouteWrapper:: find()->where(['route_no' => $search['RouteSearch']['route_no']])->all();
                $searchModel->route_no = $search['RouteSearch']['route_no'];
            }

    
        }
        if (!isset($_GET['region'])) {
            $searchModel->region = RouteWrapper::REGION_ASHGABAT;
        } else {
            $searchModel->region = $_GET['region'];
        }

        if (isset($_GET['type'])) {
            $searchModel->type = $_GET['type'];
        } else {
            $searchModel->type = RouteWrapper::TYPE_COMING;
        }

        if (isset($_GET['points'])) {
            $searchModel->points = $_GET['type'];
        } else {
            $searchModel->type = RouteWrapper::TYPE_COMING;
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->setPageSize(100);
        return $this->render($searchModel->type == RouteWrapper::TYPE_BETWEEN_CITY ? 'index2' : 'index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'routes_from' => $routes_from,
            'routes_to' => $routes_to,
            'routes' => $routes,
            'transfers' => $transfers,
            'search' => $search,
        ]);
    }


    public function actionMap($id) {
        $model = RouteWrapper::findOne($id);

        return $this->renderAjax('_leaflet_map', [
            'model' => $model,
        ]);
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
}
