<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 */
?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?= yii\bootstrap\Alert::widget([
    'options' => [
        'class' => 'alert-info alert-dismissible',
    ],
    'body' => Yii::t('user', 'You can assign multiple locations to user by using the form below'),
]) ?>


<?php $form = ActiveForm::begin(); ?>

<?php
$locations = \common\models\wrappers\LocationWrapper::find()->multilingual()->all();
$data = [];
foreach ($locations as $location) {
    if ($location->getChildrenCount() == 0) {
        $data[$location->id] = $location->fullTitle;
    }
}

echo $form->field($user, 'locs')->widget(\kartik\select2\Select2::classname(), [
    'data' => $data,
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true
    ],
    'options' => ['placeholder' => 'Select a locations ...'],
]);
?>

<div class="form-group">
    <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Assign'), ['class' => 'btn btn-success btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>


<?php $this->endContent() ?>
