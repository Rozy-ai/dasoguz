<?php

namespace backend\controllers;

use common\components\CommonController;
use Yii;
use common\models\wrappers\PointWrapper;
use common\models\search\PointSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PointLang;

/**
 * PointController implements the CRUD actions for PointWrapper model.
 */
class PointController extends CommonController {
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
     * Lists all PointWrapper models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PointSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->pagination->setPageSize(100);
         $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PointWrapper model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PointWrapper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PointWrapper();

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $post['PointWrapper']['name'] = trim($post['PointWrapper']['name']);
            $post['PointWrapper']['name_en'] = trim($post['PointWrapper']['name_en']);
            $post['PointWrapper']['name_ru'] = trim($post['PointWrapper']['name_ru']);
            $model->load($post);
            $post = $post['PointWrapper'];
            
            $names =  PointLang::find()->select('name')->asArray()->all();
            foreach ($names as $key => $name) {
                if (in_array($post['name'], $name)){
                    $bar = true;
                    
                }
            }
  
                if (!$bar) {
              
                   if ($model->save()) {
\Yii::$app->session->addFlash('info', 'Maglumat save boldy');
                return $this->render('create', [
            'model' => $model,
        ]);
                // return $this->redirect(['index']);
            } else{
              \Yii::$app->session->addFlash('info', 'Maglumat save bolmady');
                   return $this->render('create', [
            'model' => $model,
        ]);
            }


                } else {


                 \Yii::$app->session->addFlash('info', 'Maglumat öň girizilen');
                   return $this->render('create', [
            'model' => $model,
        ]);

   
                }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing PointWrapper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $post['PointWrapper']['name'] = trim($post['PointWrapper']['name']);
            $post['PointWrapper']['name_en'] = trim($post['PointWrapper']['name_en']);
            $post['PointWrapper']['name_ru'] = trim($post['PointWrapper']['name_ru']);
            $model->load($post);
            $post = $post['PointWrapper'];

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PointWrapper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PointWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PointWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PointWrapper::find()->where(['id' => $id])->multilingual()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
