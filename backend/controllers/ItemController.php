<?php

namespace backend\controllers;

use common\components\CommonController;
use common\models\ItemLang;
use iutbay\yii2kcfinder\KCFinder;
use Yii;
use common\models\wrappers\ItemWrapper;
use common\models\search\ItemSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for ItemWrapper model.
 */
class ItemController extends CommonController
{


    public function behaviors()
    {
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
     * Lists all ItemWrapper models.
     * @return mixed
     */
    public function actionIndex()
    {
//        yii::$app->cache->flush();
        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '-id';
        }
        $searchModel = new ItemSearch();
        $searchModel->type = ItemWrapper::TYPE_TEXT;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, null, 1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemWrapper model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ItemWrapper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemWrapper();
        $model->type = ItemWrapper::TYPE_TEXT;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $post['ItemWrapper']['title'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['title']);
            $post['ItemWrapper']['content'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['content']);
            $post['ItemWrapper']['description'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['description']);
            $post['ItemWrapper']['title_ru'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['title_ru']);
            $post['ItemWrapper']['content_ru'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['content_ru']);
            $post['ItemWrapper']['description_ru'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['description_ru']);
            $model->load($post);
            $post = $post['ItemWrapper'];

            if (isset($post['docs']) && strlen(trim($post['docs'])) > 0){
                $model->docs = explode(',', $post['docs']);

            }

            if (isset($model->date_event) & $model->date_event != '') {
                $date_event = new \DateTime($model->date_event);
                $model->date_event = $date_event->format('Y-m-d H:i:s');
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        $model->docs = implode($model->docs, ',');

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItemWrapper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->type = ItemWrapper::TYPE_TEXT;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $post['ItemWrapper']['title'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['title']);
            $post['ItemWrapper']['content'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['content']);
            $post['ItemWrapper']['description'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['description']);
            $post['ItemWrapper']['title_ru'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['title_ru']);
            $post['ItemWrapper']['content_ru'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['content_ru']);
            $post['ItemWrapper']['description_ru'] = preg_replace('/&nbsp;/' , " " , $post['ItemWrapper']['description_ru']);

            $model->load($post);
            $post = $post['ItemWrapper'];
            if (isset($post['docs']) && strlen(trim($post['docs'])) > 0)
                $model->docs = explode(',', $post['docs']);
            else
                $model->docs = [];

            if (isset($model->date_event) & $model->date_event != '') {
                $date_event = new \DateTime($model->date_event);
                $model->date_event = $date_event->format('Y-m-d H:i:s');
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        $model->docs = implode($this->trimNonexistentDocuments($model->docs), ',');
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ItemWrapper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $itemLangModels = ItemLang::find()->where(['item_id' => $id])->all();
        foreach ($itemLangModels as $itemLangModel) {
            if (isset($itemLangModel))
                $itemLangModel->delete();
        }


        $model = $this->findModel($id);
        $documents = $model->documents;
        if (isset($documents)) {
            foreach ($documents as $doc) {
                $doc->fullDelete('tbl_item_to_document');
            }
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemWrapper::find()->where(['id' => $id])->multilingual()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionEventList($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = ItemWrapper::find()->joinWith('translations')->where(['like', 'title', $q])->multilingual()->limit(20)->all();
            foreach ($data as $d) {
                $out['results'] = array($d->id, $d->title);
            }
//            $data = ArrayHelper::map($data, 'id', 'title', 'id');

//            $query = new Query();
//            $query->select('id, visited_count')
//                ->from('tbl_item')
////                ->where(['like', 'name', $q])
//                ->limit(20);
//            $command = $query->createCommand();
//            $data = $command->queryAll();

//            echo "<pre>";
//            print_r($out['results']);
//            echo "</pre>";
//            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => $this->findModel($id)->title];
        }
        return $out;
    }

    public function actionWorks($id)
    {
        $searchModel = new ItemSearch();
        $searchModel->type = ItemWrapper::TYPE_TEXT;
        $params = Yii::$app->request->queryParams;
//        var_dump($params);die;
        $params['ItemSearch']['user_id'] = $id;
        $dataProvider = $searchModel->search($params);

        return $this->render('works', [
            'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
