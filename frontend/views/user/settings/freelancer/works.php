<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Item Wrappers');
$this->params['breadcrumbs'][] = $this->title;
$idc =$id;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<?php Pjax::begin(); ?>
<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= yii::t('app', 'My works') ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">

                            <h1><?= yii::t('app', 'My works') ?></h1>
                            <?php
                            $categories = \common\models\wrappers\CategoryWrapper::find()->all();
                            $filter = [];
                            foreach ($categories as $cat) {
                                $filter[$cat->id] = $cat->name;
                            }
                            // echo $this->render('_search', ['model' => $searchModel]);
                            ?>

                            <p>
                                <?= Html::a(yii::t('app', 'Add project') , ['faddwork', 'id' => $id], ['class' => 'btn btn-success']) ?>
                            </p>
                                <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
//                                    'id',
//            [
//                'options' => ['max-width' => '120px'],
//                'attribute' => 'category_id',
//                'filter' => $filter,
////                'filter' => \yii\helpers\ArrayHelper::map(\common\models\wrappers\CategoryWrapper::find()->asArray()->all(), 'id', 'name'),
//                'value' => function ($model) {
//                    $category = $model->category;
//                    if (isset($category))
//                        return $category->name;
//                },
//                'format' => 'html',
//            ],
                                    [
                                        'attribute' => 'title',
                                        'value' => function ($model) {
                                            return Yii::$app->controller->truncate($model->title, 10, 80);
                                        },
                                        'format' => 'html',
                                        'options' => ['max-width' => '80px']
                                    ], [
                                        'attribute' => 'description',
                                        'value' => function ($model) {

                                            return Yii::$app->controller->truncate(strip_tags($model->description), 10, 100);
                                        },
                                        'format' => 'html',
                                        'options' => ['max-width' => '230px']
                                    ],

//            [
//                'attribute'=>'text',
//                'value' => function ($data) {
//                   return mb_substr($data->text,0,250).' ...';
//                },
//                'format' => 'html',
//                'options' => ['width' => '280px']
//            ],
//            'text:ntext',
//            'alias',

                                    // 'parent_category_id',
                                    // 'visited_count',
                                    // 'sort_order',
//            'status',
//            'is_main',
//            'user_id',
                                    // 'edited_username',
                                    // 'create_username',
                                    // 'date_created',
                                    // 'date_modified',

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update-work} {delete-work} {crop}',
                                        'headerOptions' => ['width' => '100px', 'class' => 'activity-view-link',],
                                        'contentOptions' => ['style' => 'text-align:right'],
                                        'buttons' => array(
//                                            'crop' => function ($url, $model, $key) {
//                                                $sizes = $model->getSizeByType($model->type);
//                                                $returnUrl = \yii\helpers\Url::toRoute(['fworks?id='.$key, 'type' => $model->type]);
//                                                if (isset($sizes) && is_array($sizes)) {
//                                                    $sizes = serialize($sizes);
//                                                }
//
//                                                $documents = $model->documents;
//                                                if (isset($documents) && count($documents) > 0) {
//                                                    return Html::a('<span class="fa fa-crop"></span>', \yii\helpers\Url::toRoute(['/document/crop', 'id' => $documents[0]->id, 'ratios' => $sizes, 'returnUrl' => $returnUrl]), [
//                                                        'title' => Yii::t('yii', 'Crop'),
//                                                    ]);
//                                                } else {
//                                                    return false;
//                                                }
//                                            },
                                            'delete-work' => function($url, $model, $key) {     // render your custom button

                                                return Html::a('','fdeletework?id='.$key.'&idc='.$model->user_id,['class' => 'glyphicon glyphicon-remove']);
                                            },
                                            'update-work' => function($url, $model, $key) {     // render your custom button

                                                return Html::a('','fupdatework?id='.$key.'&idc='.$model->user_id,['class' => 'glyphicon glyphicon-pencil']);
                                            },
                                        ),
                                        'options' => ['width' => '120'],
                                    ],

//            ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>