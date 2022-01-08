<?php

namespace frontend\controllers;

use common\components\CommonController;
use common\models\ItemLang;
use common\models\wrappers\CategoryWrapper;
use common\models\wrappers\CommentWrapper;
use common\models\wrappers\MenuWrapper;
use Yii;
use common\models\wrappers\ItemWrapper;
use common\models\search\ItemSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for ItemWrapper model.
 */
class ItemController extends CommonController {
    public $layout = 'bootstrap';

    /**
     * @inheritdoc
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
     * Lists all ItemWrapper models.
     * @return mixed
     */
    public function actionIndex($path = null, $category_id = null) {

        $searchModel = new ItemSearch();
        $searchModel->status = 1;
        $modelCategory = CategoryWrapper::findByPath($path);
        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '-id';
        }


        if (isset($_GET['pub_date'])) {
            $searchModel->pub_date = $_GET['pub_date'];
            $old_date = strtotime($_GET['pub_date']);
            $_GET['pub_date'] = date('d-m-Y', $old_date);

            //if pub_date is not empty it means to show archive news so changing category to news
            $modelCategory = CategoryWrapper::find()->where(['code' => 'news'])->one();
        }


        if (isset($modelCategory)) {
            $children = $modelCategory->children;
            if (is_array($children) && count($children) == 0){
//                $searchModel->category_id = $modelCategory->id;
                $searchModel->parent_category_id = $modelCategory->id;

            }
            elseif (($modelCategory->parent_id == null || $modelCategory->parent_id == 0)){
                $searchModel->parent_category_id = $modelCategory->id;
//                $searchModel->category_id = $modelCategory->id;
            }
        }
        $viewpath = 'index';
        if ( $modelCategory->code = 'news'){

                 $category = CategoryWrapper::find()->where(['code' => 'news'])->one();
$catId = $category->id;

$events = ItemWrapper::find()->with(['translations','documents'])->where(['category_id' => $catId, 'status' => '1'])->orderBy('date_created DESC')->all();

            $pageSize = 10;
            $countQuery = count($events);
            $pages = new Pagination(['totalCount' => $countQuery, 'pageSize' => $pageSize,
                'forcePageParam' => false, 'pageSizeParam' => false]);

$events = ItemWrapper::find()->with(['translations','documents'])->where(['category_id' => $catId, 'status' => '1'])->orderBy('date_created DESC')->offset($pages->offset)->limit($pages->limit)->all();



            $categoryModel = CategoryWrapper::find()->where(['code' => $modelCategory->code])->one();

            return $this->render('calendar', [
                'events' => $events,
                'pages' => $pages,
                'categoryModel' => $categoryModel,
            ]);
        } else
        return $this->render($viewpath, [
            'searchModel' => $searchModel,
            'modelCategory' => $modelCategory,
        ]);
    }


    /**
     * Displays a single ItemWrapper model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $model = $this->findModel($id);
        $model->updateCounters(['visited_count' => 1]);
        $modelCategory = $model->category;


        $searchModel = new ItemSearch();
        $searchModel->status = 1;
        $viewpath = 'view';
        if (isset($modelCategory) && $modelCategory->code == 'location')
            $viewpath = 'location/view';
        if ($modelCategory->code == 'calendar')
            $viewpath = 'calendar-view';

//        $popular = ItemSearch::find()->orderBy(['visited_count'=>SORT_DESC])->all();
//        echo "<pre>";
//        var_dump($popular);die;
        return $this->render($viewpath, [
            'model' => $model,
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionEvents() {
        $items = ItemWrapper::find()->where(['not',['date_event'=>null]]);

//        var_dump($items->count());die;
        $pages = new Pagination(['totalCount' => $items->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $models = $items
            ->where(['not',['date_event'=>null]])
            ->orderBy('date_event desc')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('events', [
            'items' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionTops() {
        $items = ItemWrapper::find();
        die('1');
//        var_dump($items->count());die;
        $pages = new Pagination(['totalCount' => $items->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $models = $items
            ->orderBy('visited_count desc')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('top_items', [
            'items' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Finds the ItemWrapper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemWrapper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ItemWrapper::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionAddComment() {
        $commentModel = new CommentWrapper();
        $user = Yii::$app->user->identity;
        $post = Yii::$app->request->post();


        if (isset($post['CommentWrapper']['item_id'])) {
            $itemModel = ItemWrapper::find()->where(['id' => $post['CommentWrapper']['item_id']])->one();
            if (isset($itemModel)) {
                $commentModel->load($post);
                $commentModel->items_rel = array ($itemModel->id);
                if ($commentModel->save()) {
                    $commentsModel = $itemModel->comments;
                    $show_form = false;
                    return $this->renderAjax('//comment/index', ['commentsModel' => $commentsModel, 'show_form' => $show_form]);
                }
            }
        }
    }
}
