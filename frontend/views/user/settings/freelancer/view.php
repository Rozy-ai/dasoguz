<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Freelancer */
$title = \common\models\User::findOne(yii::$app->user->identity->getId());
$this->title = $title->username;

$this->params['breadcrumbs'][] = ['label' => 'Freelancers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                        <div class="freelancer-view">

                            <h1><?= Html::encode($this->title) ?></h1>

                            <p>
                                <?= Html::a(yii::t('app','Update'), ['fupdate?id='.$model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(yii::t('app','Add work'), ['faddwork?id='.$model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(yii::t('app','Delete work'), ['fworks?id='.$model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(yii::t('app','Delete'), ['fdelete?id='.$model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </p>

                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
//                                    'id',
                                    [
                                        'attribute' => 'username',
                                        'label' => yii::t('app', 'Name of announcement'),
                                    ],
                                    [
                                        'attribute' => 'email',
                                        'label' => yii::t('app', 'Email'),
                                    ],
                                    [
                                        'attribute' => 'phone_number',
                                        'label' => yii::t('app', 'Phone number'),
                                    ],
                                    [
                                        'attribute' => 'service_charge',
                                        'label' => yii::t('app', 'Service charge'),
                                    ],
                                    [
                                        'attribute' => 'amount_work',
                                        'label' => yii::t('app', 'Amount work'),
                                        'format' => 'html',
                                        'value' => function($model){
                                           return $model->amount_work ? $model->amount_work : '<span>'.yii::t('app','Not set').'</span>';
                                        }
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Category'),
                                        'value' => function($model){
                                            $category = \common\models\wrappers\CategoryWrapper::findOne($model->category_id);
                                            return $category->name;
                                        }
                                    ],
                                    [
                                        'attribute' => 'visited_count',
                                        'label' => yii::t('app', 'Visited count'),
                                    ],
                                    [
                                        'label' => yii::t('app', 'Status'),
                                        'format' => 'html',
                                        'value' => function($model){
                                            if ($model->status == 0){
                                                return "<div ><i class='fa fa-spin fa-spinner' style='color: #1b424a;'></i></div>";
                                            } else {
                                                return "<div ><i class='fa fa-check' style='color: green'></i></div>";
                                            }
                                        }
                                    ],
//                                    'email',
//                                    'phone_number',
//                                    'service_charge',
//                                    'amount_work',
//                                    'star',
//                                    'category_id',
//                                    'visited_count',
//                                    'sort_order',
//                                    'status',
//                                    'date_edited',
//                                    'date_modified',
                                ],
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>