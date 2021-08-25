<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Freelancer */

$this->title =  yii::t('app', 'Create Freelancer');
$this->params['breadcrumbs'][] = ['label' => 'Freelancers', 'url' => ['index']];
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
                        <div class="freelancer-create">

                            <h1><?= yii::t('app', 'Create Freelancer') ?></h1>

                            <?= $this->render('_form', [
                                'model' => $model,
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
