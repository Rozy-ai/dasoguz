<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FreelancerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Freelancers';
$this->params['breadcrumbs'][] = $this->title;
?>



<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= yii::t('app', 'My announcements') ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="freelancer-index">

                            <h1> <?= yii::t('app', 'My announcements') ?></h1>

                            <p>
                                <?= Html::a(yii::t('app', 'Add announcement'), ['fcreate'], ['class' => 'btn btn-success']) ?>
                            </p>

                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

//            'id',
                                    [
                                        'label' => Yii::t('app', 'Name of announcement'),
                                        'value' => function($model){
                                              return yii::$app->controller->truncate($model->username,10,40);

                                        }
                                    ],
                                    [
                                        'label' => yii::t('app', 'Status'),
                                        'format' => 'html',
                                        'value' => function($model){
                                            if ($model->status == 0){
                                                return '<span style="">'.yii::t('app', 'Waiting').'</span>';
                                            } else {
                                                return '<span style="">'.yii::t('app', 'Received').'</span>';
                                            }
                                        }
                                    ],

                                    //'amount_work',
                                    //'star',
                                    [
                                        'label' => Yii::t('app', 'Category'),
                                        'value' => function($model){
                                            $category = \common\models\wrappers\CategoryWrapper::findOne($model->category_id);
                                            return $category->name;
                                        }
                                    ],

                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{view} {update} {delete} {works}',  // the default buttons + your custom button
                                        'buttons' => [
                                            'works' => function($url, $model, $key) {     // render your custom button
                                                // return Html::a('','fworks?id='.$key,['class' => 'glyphicon glyphicon-file']);
                                                return HTML::a(yii::t('app', 'Add project'), 'fworks?id='.$key,['class' => 'mybtn btn-success'])."</div>";
                                            },
                                            'update' => function($url, $model, $key) {     // render your custom button
                                                return Html::a('','fupdate?id='.$key,['class' => 'glyphicon glyphicon-pencil']);
                                            },
                                            'view' => function($url, $model, $key) {     // render your custom button
                                                return "<div class = 'gridButtons_block'>".Html::a('','fview?id='.$key,['class' => 'glyphicon glyphicon-eye-open']);
                                            },
                                            'delete' => function($url, $model, $key) {     // render your custom button
                                                return Html::a('','fdelete?id='.$key,['class' => 'glyphicon glyphicon-trash', 'onclick' => "return confirm('Are you sure you want to Remove?');"]);
                                            },
                                        ],
                                    ],

                                ],
                            ]); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
