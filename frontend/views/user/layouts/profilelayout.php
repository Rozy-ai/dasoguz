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
    <html lang="en" id="header">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--        <meta name="yandex-verification" content="7d897699f887f0c3"/>-->
        <meta name="google-site-verification" content="BAcImCfQCHI8M72uqkq7BlAo5AkHxjH3BvvQezWXb2o"/>
        <?php
        if (isset($this->title) && strlen(trim($this->title)) < 25) {
            $this->title = $this->title . ' | ' . Yii::t('app', 'Ozisim.com');
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


    <body onscroll="scroll()">
    <div class="scrollto openblock" >
        <a href="#header"><span><i class="fa  fa-angle-double-up"></i></span></a>
    </div>
    <?php

    $catNavItems = [];
    //item menu
    $pageMenuList = \common\models\wrappers\ItemWrapper::find()->joinWith('category cat')->where(['tbl_item.status' => 1, 'tbl_item.is_menu' => 1])->andWhere(['cat.code' => "infopage"])->orderBy('id desc')->all();
    foreach ($pageMenuList as $menu) {
        if (isset($menu->title) && strlen(trim($menu->title)) > 0) {
            $tempItem = array('label' => $menu->title, 'url' => $menu->getUrl());
            $catNavItems[] = $tempItem;
        }
    }

    //categories menu start
    $menuCategories = \common\models\wrappers\CategoryWrapper::find()->where(['top' => 1, 'status' => 1])->andWhere(['OR', 'parent_id is null', 'parent_id=0'])->orderBy('sort_order')->all();
    foreach ($menuCategories as $categoryModel) {
        if (isset($categoryModel->name) && strlen(trim($categoryModel->name)) > 0) {
            $tempItem = array('label' => $categoryModel->name, 'url' => $categoryModel->getUrl());

            //submenu start
            $subItems = [];
            $categoryItems = \common\models\wrappers\CategoryWrapper::find()->where(['parent_id' => $categoryModel->id, 'top' => 1])->all();
            if (isset($categoryItems) && count($categoryItems) > 0) {
                foreach ($categoryItems as $item) {
                    if (isset($item->name) && strlen(trim($item->name)) > 0)
                        $subItems[] = array('label' => $item->name, 'url' => $item->getUrl());
                }
            }

            $itemWrappers = \common\models\wrappers\ItemWrapper::find()->where(['category_id' => $categoryModel->id, 'is_menu' => 1, 'status' => 1])->all();
            if (isset($itemWrappers) && count($itemWrappers) > 0) {
                foreach ($itemWrappers as $item) {
                    if (isset($item->name) && strlen(trim($item->name)) > 0)
                        $subItems[] = array('label' => $item->title, 'url' => $item->getUrl());
                }
            }

            if (count($subItems) > 0) {
                $tempItem['items'] = $subItems;
            }
            //submenu end

            $catNavItems[] = $tempItem;
        }
    }

    $menuItems = [
//        ['label' => Yii::t('app', 'Home'), 'url' => \yii\helpers\Url::base(true)],
//        ['label' => Yii::t('app', 'Events'), 'url' => \yii\helpers\Url::to(['event/index'])],
//        ['label' => Yii::t('app', 'Show'), 'url' => \yii\helpers\Url::to(['show/index'])],
    ];
    $menuItems = yii\helpers\ArrayHelper::merge(
        $menuItems,
        $catNavItems
    );
    //    $menuItems[] = ['label' => Yii::t('app', 'Contact us'), 'url' => ['/site/contact']];
    ?>

    <?php $this->beginBody() ?>
    <div class="header-wrapper">
        <?= $this->render('//common/header', ['menuItems' => $menuItems]) ?>
    </div>

    <?php if (isset($this->params['breadcrumbs']) && count($this->params['breadcrumbs']) > 1) { ?>
<!--        <div class="breadcrumbs-wrapper" style="background: #f8f8f8;">-->
<!--            <div class="container">-->
<!--                --><?php //
//                echo \yii\widgets\Breadcrumbs::widget([
//                    'homeLink' => [
//                        'label' => Yii::t('app', 'Home'),
//                        'url' => \yii\helpers\Url::base(true),
//                    ],
//                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//                    'options' => [
//                        'style' => 'background:none;margin:0;',
//                        'class' => 'breadcrumb'
//                        ,]
//                ])
                ?>
<!--            </div>-->
<!--        </div>-->
    <?php } ?>

    <div class="container">
        <?= $content ?>
    </div>

    <?= $this->render('//common/footer', ['menuItems' => $menuItems]) ?>

    <?php $this->endBody() ?>
    <!--    <script>-->
    <!--        // slider options-->
    <!--        $(".regular").slick({-->
    <!--            dots: false,-->
    <!--            infinite: true,-->
    <!--            slidesToShow: 2,-->
    <!--            slidesToScroll: 1-->
    <!--        });-->
    <!---->
    <!--        // slider options-->
    <!--    </script>-->


    </body>
    </html>
<?php $this->endPage() ?>