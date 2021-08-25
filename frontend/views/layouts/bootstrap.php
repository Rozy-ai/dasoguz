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
    <html lang="<?php
        if (yii::$app->language == 'ru')
            echo yii::$app->language;
        else
            echo 'tm';
?>" id="header">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        if (isset($this->title) && strlen(trim($this->title)) < 25) {
            $this->title = $this->title . ' | ' . Yii::t('app', '');
        }
        ?>
        <title><?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

        <?php
        $favicon = Yii::getAlias('@web') . '/source/img/logo.png';
        ?>
        <link rel="shortcut icon" type="image/ico" href="<?= $favicon ?>"/>

    </head>


    <body onscroll="scroll()">
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
                $tempItem['template'] = '<a href="{url}" class=\'dropdown-toggle dropdownhover\' role="button" aria-haspopup="true" aria-expanded="false">{label}<span class="caret" style="color: #fff;margin-left: 3px;"></span></a>';
                $tempItem['items'] = $subItems;
            }
            //submenu end

            $catNavItems[] = $tempItem;
        }
    }
   $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/']];
    $itemWrappers = \common\models\wrappers\ItemWrapper::find()->where(['is_menu' => 1, 'status' => 1])->all();
    if (isset($itemWrappers) && count($itemWrappers) > 0) {
        foreach ($itemWrappers as $item) {
            if (isset($item->title) && strlen(trim($item->title)) > 0)
                $menuItems[] = array('label' => $item->title, 'url' => $item->getUrl());
        }
    }
    // $menuItems[] = ['label' => Yii::t('app', 'TYPE_IN_CITY'), 'url' => ['/route/index', 'type' => 0]];
    //  $menuItems[] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['/gallery/index']];
    $menuItems = yii\helpers\ArrayHelper::merge(
        $menuItems,
        $catNavItems
    );
    // $menuItems[] = ['label' => Yii::t('app', 'Orders'), 'url' => ['/site/order']];
    ?>

    <?php $this->beginBody() ?>
    <div class="header-wrapper">

        <?= $this->render('//common/header', ['menuItems' => $menuItems]) ?>
    </div>

    <?= common\widgets\Alert::widget() ?>

        <div class="main_content">
            <?= $content ?>
        </div>

    <?= $this->render('//common/footer', ['menuItems' => $menuItems]) ?>

    <?php $this->endBody() ?>
        <script>
        $(document).ready(function() {
            $('.owl-three').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 3,
                        nav: false
                    },
                    480: {
                        items: 3,
                        nav: false
                    },
                    667: {
                        items: 4,
                        nav: false
                    },
                    800: {
                        items: 5,
                        nav: false
                    },
                    1280: {
                        items: 6,
                        nav: false
                    }
                }
            })
        })
    </script>
    <!-- //script for customers -->

    <!-- for tesimonials carousel slider -->
    <script>
        $(document).ready(function() {
            $("#owl-demo1").owlCarousel({
                loop: true,
                margin: 20,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    736: {
                        items: 2,
                        nav: false
                    },
                    1000: {
                        items: 2,
                        nav: true,
                        loop: false
                    }
                }
            })
        })
    </script>
    <!-- //script -->

    <!-- script for teams -->
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 0,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    415: {
                        items: 2,
                        nav: true,
                        margin: 20
                    },
                    667: {
                        items: 3,
                        nav: true,
                        margin: 20
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: true,
                        margin: 25
                    }
                }
            })
        })
    </script>
    <!-- //script for teams-->
    <script>
        $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

            $('.popup-with-move-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-slide-bottom'
            });
        });
    </script>
    <!-- magnific popup -->



    <script>
        $('.counter').countUp();
    </script>
    <!-- //stats number counter -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll which navbar is in active -->
    </body>
    </html>
<?php $this->endPage() ?>