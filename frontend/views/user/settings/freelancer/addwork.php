<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\wrappers\ItemWrapper */

$this->title = Yii::t('app', 'Create Item Wrapper');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Wrappers'), 'url' => ['index']];
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
                    <?= Html::encode($this->title) ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="item-wrapper-create">

                            <h1><?= Html::encode($this->title) ?></h1>

                            <?= $this->render('work_form', [
                                'model' => $model,
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>