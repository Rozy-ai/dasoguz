<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
$lat = isset($ownInfo->my_latitude) ? $ownInfo->my_latitude : "0";
$lng = isset($ownInfo->my_longitude) ? $ownInfo->my_longitude : "0";
//$this->registerJsFile('http://maps.google.com/maps/api/js?key=AIzaSyBDJ1dE9OjJtp33gBzRMad6iasRnAW_4xQ&libraries=places', ['depends' => [\yii\web\JqueryAsset::className(), \yii\bootstrap\BootstrapAsset::className()]]);
//$this->registerJsFile('https://api-maps.yandex.ru/2.1/?apikey=aa8b1537-d8d3-4049-bd5e-68df6b1e5a67&lang=ru_RU',['position' => \yii\web\View::POS_HEAD,'depends' => [\yii\web\JqueryAsset::className(), \yii\bootstrap\BootstrapAsset::className()]]);
$contacts = \common\models\wrappers\ItemWrapper::find()->with(['translations','documents'])->where(['id' => '948'])->one();
?>


<div class="main_content">
    <div class="content" style="padding: 50px 0;">
        <div class="container">
            <div class="news-details_title">
                <?= $contacts->title; ?>
            </div>
            <div class="news-details">
                <div class="news-details-text">
                    <div class="news-contenta">
                        <?= $contacts->content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$this->registerCssFile("@web/source/css/style.css");
 ?>


