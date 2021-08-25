<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!-- Footer -->
<footer id="colophon">
    <div class="container">
        <div class="row">
            <div class="widget col-sm-4 about-widget ">
                <h4 class="widget-title">Habarlasmak ucin</h4>
                <h5>Tel: +9936x xx xx</h5>
                <div class="widget-content">
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur  adipiscing eli esent massa libero, tristiq ue placerat sapien in, tincidmollis dui. Curabitur gravida felis turpis, non malesua est placerat eget. Cras vel fringilla mi. </p> -->
                    <ul class="social-networks bg clearfix">
                        <li><a class="fa fa-facebook" href="http://facebook.com"></a></li>
                        <li><a class="fa fa-facebook" href="http://plus.google.com"></a></li>
                        <li><a class="fa fa-facebook" href="http://twitter.com"></a></li>
                        <li><a class="fa fa-facebook" href="http://spotify.com"></a></li>
                        <li><a class="fa fa-facebook" href="http://soundcloud.com"></a></li>
                        <li><a class="fa fa-facebook" href="http://youtube.com"></a></li>
                    </ul>
                </div>
            </div>
            <div class="widget col-sm-4 twitter-widget">
                <h4 class="widget-title">Twitter</h4>
                <div id="twitter-feed"></div>
            </div>
            <div class="widget col-sm-4 instagram-widget">
                <h4 class="widget-title">Instagram</h4>
                <ul id="footer-insta" class="clearfix"></ul>
            </div>
        </div>
    </div>
    <div class="footer-bar">
        <div class="container relative-pos z-index">

        </div>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

