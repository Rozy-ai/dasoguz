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
?>


 <!-- contacts-5-grid -->
    <div class="w3l-contact-10 py-5" id="contact">
        <div class="form-41-mian pt-lg-4 pt-md-3 pb-4">
            <div class="container">
                <div class="heading text-center mx-auto">
                    <span class="text text-center mb-2"><?= Yii::t('app','Contact Us') ?></span>
                    <h3 class="title-big-portfolio mb-2">Habar ugratmak </h3>
                    <!-- <p class="mb-5">If you have a question regarding our services, feel free to contact us using the form below.</p> -->
                </div>
                <div class="form-inner-cont">
                            <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'options' => [
                'class' => 'signin-form',
            ],
            'enableClientValidation' => false,
            'enableAjaxValidation' => false]); ?>
                        <div class="form-grids">
                            <div class="form-input">
                          <!--       <input type="text" name="w3lName" id="w3lName" placeholder="Ady *" required="" /> -->
                                <?= $form->field($model, 'name')->textInput(['required' => 'required', 'placeholder' => yii::t('app', 'Name')])->label(false) ?>
                            </div>
                            <div class="form-input">
                        <!--         <input type="email" name="w3lSender" id="w3lSender" placeholder="Email *" required /> -->
                            <?= $form->field($model, 'email')->input('email',['required' => 'required', 'placeholder' => yii::t('app', 'Email')])->label(false) ?>

                            </div>

                            <!-- <div class="form-input">
                                <input type="text" name="w3lPhone" id="w3lPhone" placeholder="Enter your Phone Number *" required />
                            </div> -->
                        </div>

                        <div class="form-input mt-2">
                            <!-- <input type="text" name="w3lSubject" id="w3lSubject" placeholder="Mazmuny " required /> -->
                            <?= $form->field($model, 'subject')->textInput(['required' => 'required', 'placeholder' => yii::t('app', 'Subject')])->label(false) ?>
                        </div>

                        <div class="form-input">
     <!--                        <textarea name="w3lMessage" id="w3lMessage" placeholder="Siziň habaryňyz" required=""></textarea> -->
     <?= $form->field($model, 'message')->textarea(['required' => 'required','id' => 'w3lMessage','placeholder' => yii::t('app', 'Message')])->label(false) ?>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-style btn-effect"><?=yii::t('app','Send')?></button>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="contacts-5-grid-main section-gap">
            <div class="contacts-5-grid">
                <div class="map-content-5">
                    <section class="tab-content">
                        <div class="container">
                            <div class="d-grid grid-col-2">
                                <div class="contact-type">
                                    <div class="address-grid">
                                        <h6><?= yii::t('app', 'Address') ?></h6>
                                        <p><?= $ownInfo->my_address ?> </p><span class="pos-icon">
                                        <span class="fa fa-map"></span>
                                        </span>
                                    </div>
                                    <div class="address-grid">
                                        <h6><?= yii::t('app', 'Email') ?></h6>
                                        <span class="fa fa-envelope"></span>
                                        <a href="mailto:dzawtoulag@mail.com" class="link1"><?= $ownInfo->my_email ?></a>
                                        <!-- <a href="mailto:mailtwo@example.com" class="link1">mailtwo@example.com</a><span class="pos-icon"> -->
                                        </span>
                                    </div>
                                    <div class="address-grid">
                                        <h6><?= yii::t('app', 'Phone') ?></h6>
                                        <span class="fa fa-headphones"></span>
                                        <a href="tel:+(993)-322-6-07-04" class="link1"><?= $ownInfo->my_phone ?></a>
                                        <!-- <a href="tel:+44 224-058-545" class="link1">+44 224-058-545</a><span class="pos-icon"> -->
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- //contacts-5-grid -->
    </div>


