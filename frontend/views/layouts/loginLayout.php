<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\LoginAsset;
use common\widgets\Alert;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
        <!--<link rel="shortcut icon" href="favicon.ico" /> -->
    </head>


    <body class=" login">
        <div class="logo">
            <?php
//            echo yii\helpers\Html::a(\yii\helpers\Html::img(Yii::getAlias('@web').'/source/layouts/layout/img/logo-login.png',['alt'=>'logo','class'=>'logo-default']),['//site/index'])
            ?>
<!--
            <a href="index.html">
                <img src="../assets/pages/img/logo-big.png" alt=""> </a>-->
        </div>
        <?php $this->beginBody() ?>
        
        <div class="content">
            <?=$content?>
        </div>
        
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>