<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\MainAsset;
use common\widgets\Alert;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--        <meta name="yandex-verification" content="7d897699f887f0c3"/>-->
        <meta name="google-site-verification" content="BAcImCfQCHI8M72uqkq7BlAo5AkHxjH3BvvQezWXb2o"/>
        <?php
        if (isset($this->title) && strlen(trim($this->title)) < 25) {
            $this->title = $this->title . ' | ' . Yii::t('app', 'site_name');
        }
        ?>
        <title><?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

        <?php
        $favicon = Yii::getAlias('@web') . '/source/img/favicon_tt.ico';
        ?>

        <link rel="shortcut icon" type="image/ico" href="<?= $favicon ?>"/>
        <!--        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,700i&amp;subset=cyrillic-ext"-->
        <!--              rel="stylesheet">-->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JCTRFYWGGE"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-JCTRFYWGGE');
        </script>
    </head>


    <body>



    <div class="container">
        <?= $content ?>
    </div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>