<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\ItemWrapper */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Wrappers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-wrapper-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'content:ntext',
            'alias',
            'category_id',
            'parent_category_id',
            'visited_count',
            'sort_order',
            'type',
            'status',
            'is_main',
            'author',
            'edited_username',
            'create_username',
            'date_created',
            'date_modified',
        ],
    ]) ?>

</div>
