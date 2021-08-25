<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\SettingWrapper */

$this->title = Yii::t('app', 'Create Setting Wrapper');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting Wrappers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-wrapper-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
