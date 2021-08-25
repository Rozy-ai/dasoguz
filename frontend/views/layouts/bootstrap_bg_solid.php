<?php
use yii\helpers\Html;
use frontend\assets\MainAsset;

MainAsset::register($this);
if (Yii::$app->language == 'fa') {
    $this->registerCssFile("@web/source/css/bootstrap-rtl.min.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()]
    ], 'botstrap-rtl');
}
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        if (isset($this->title) && strlen(trim($this->title)) < 25) {
            $this->title = $this->title . ' | ' . Yii::t('app', 'Automobile ministry of Turkmenistan');
        }
        ?>
        <title><?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

        <?php
        $favicon = Yii::getAlias('@web') . '/source/img/favicon2.ico';
        ?>

        <link rel="shortcut icon" type="image/ico" href="<?= $favicon ?>"/>
    </head>

    <body onscroll="scroll()">
    <div class="topbtn scrollto openblock" >
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
                $tempItem['template'] = '<a href="{url}" class=\'dropdown-toggle dropdownhover\' role="button" aria-haspopup="true" aria-expanded="false">{label}<span class="caret" style="color: #fff;margin-left: 3px;"></span></a>';
                $tempItem['items'] = $subItems;
            }
            //submenu end

            $catNavItems[] = $tempItem;
        }
    }
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => \yii\helpers\Url::base(true)],
    ];
    $itemWrappers = \common\models\wrappers\ItemWrapper::find()->where(['is_menu' => 1, 'status' => 1])->all();
    if (isset($itemWrappers) && count($itemWrappers) > 0) {
        foreach ($itemWrappers as $item) {
            if (isset($item->title) && strlen(trim($item->title)) > 0)
                $menuItems[] = array('label' => $item->title, 'url' => $item->getUrl());
        }
    }
    $menuItems[] = ['label' => Yii::t('app', 'TYPE_IN_CITY'), 'url' => ['/route/index', 'type' => 0]];
    $menuItems = yii\helpers\ArrayHelper::merge(
        $menuItems,
        $catNavItems
    );
    $menuItems[] = ['label' => Yii::t('app', 'Orders'), 'url' => ['/site/order']];
    //        $menuItems[] = ['label' => Yii::t('app', 'Contact us'), 'url' => ['/site/contact']];
    ?>

    <?php $this->beginBody() ?>
    <div class="header-wrapper">
        <?= $this->render('//common/header', ['menuItems' => $menuItems]) ?>
    </div>

    <div class="container-fluid bg-white">
        <?= $content ?>
    </div>

    <?= $this->render('//common/footer', ['menuItems' => $menuItems]) ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>