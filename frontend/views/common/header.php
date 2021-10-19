<?php

use common\models\wrappers\OwnerContactWrapper;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$ownInfo = OwnerContactWrapper::find()->one();
$menuItems[0] = ['label' => Yii::t('app', 'Home'), 'url' => ['/']];
// $menuItems[0] = ['label' => Yii::t('app', 'News'), 'url' => ['/item/about']];
// $menuItems[] = ['label' => Yii::t('app', 'About Us'), 'url' => ['/site/about']];
$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];


?>
<style>
    header div.lang_img img{
  width: 30px;
  height: 20px;
  margin-top: 2px;
/*  margin-bottom: 10px;*/
  margin-right: 10px;
  cursor: pointer;
}
.language_box li.language-switcher {
    list-style: none;
}
ul.lang_ul {
    list-style: none;
 /*   margin: 38px 0 10px 0;*/
}
ul.lang_ul li {
    display: inline-block;
}
.language_box {
    margin-top: -30px;
}
</style>
<div class="header-wrapper">
    <header class="w3l-header">
        <!--/nav-->
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div style="display: inline-block;"><img src="<?= '/source/images/logo.png' ?>" alt="Logo"></div>
                    <div style="display: inline-block;"></span> Daşoguzawtoulag <span class="logo">Önümliçil birleşigi</span></div>
                    </a>
                <!-- if logo is image enable this
                            <a class="navbar-brand" href="#index.html">
                                <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                            </a> -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse top_head_right" id="navbarSupportedContent">
<!--                     <ul class="navbar-nav ml-auto">
                        <li class="{{ (request()->is('/')) ? 'nav-item active' : 'nav-item' }}">
                            <a class="nav-link" href="/">Esasy sahypa</a>
                        </li>
                        <li class="{{ (request()->is('about')) ? 'nav-item active' : 'nav-item' }}">
                            <a class="nav-link" href="#">Biz barada</a>
                        </li>
                        <li class="{{ (request()->is('contact')) ? 'nav-item active' : 'nav-item' }}">
                            <a class="nav-link" href="contact.html">Habarlaşmak</a>
                        </li>
                        </ul> -->

                        <div class="inf_block cont_block">
                                        <ul class="inf_list">
                                            <li class="inf_list_item"><a href="tel:<?= $ownInfo->my_phone ?>"><i class="fa fa-phone"></i> <?= $ownInfo->my_phone ?> </a></li>
                            



                                        </ul>
                                    </div>
        <div class="lang_img ml-lg-3">
                              
                        <?php
                        echo \common\widgets\language\LanguageSwitcherDropdownWidget::widget([
                           // 'showFlags' => true
                        ]);0
                        
                        ?>
                 
        </div>
                    

<!--                     <div class="ml-lg-3">
                        <a href="#url" class="btn btn-style btn-effect">Şu taýdan başla</a>
                    </div> -->
                </div>
            </div>
        </nav>
        <!--//nav-->
    </header>
</div>
<div class="top-bar-wrapper visible-md visible-lg">
        <div class="inner">
            <div class="container">
                <div class="top-bar relative">
                    <div class="top-menu">
                        <nav>
                                            <?php
                    echo Menu::widget([
                        'items' => $menuItems,
                        'options' => [
                            'class' => '',
                        ],
                    'linkTemplate' => "<a href=\"{url}\" class=''>{label}</a>",
                    'itemOptions' => ['class' => ''],
                    ]);
                    ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
.top_head_right{
            width: 27em;
    display: flex;
    position: absolute;
    top: 25%;
    right: 0px;
        }
.top-bar-wrapper {
    width: 100%;
}
.top-bar-wrapper .inner {
    background: #225e7c;
}
.top-bar {
    height: 54px;
}
.relative {
    position: relative;
}
.top-menu > nav > ul {
    padding: 16px 0;
        list-style: none;
}
.top-menu > nav > ul > li {
    display: inline-block;
    margin-right: 40px;
    position: relative;
}
.top-menu > nav > ul > li.active > a, .top-menu > nav > ul > li:hover > a, a.uMenuItemA {
    color: #17a2b8;
}
.top-menu > nav > ul > li > a.active {
    color: #17a2b8;
    border-bottom-color: #17a2b8;
}

element.style {
}
.top-menu > nav > ul > li.active > a, .top-menu > nav > ul > li:hover > a, a.uMenuItemA {
    color: #17a2b8;
}
.top-menu > nav > ul > li.active > a {
    color: #17a2b8;
    border-bottom-color: #17a2b8;
}
/*li.inf_list_item a{
    color: #17a2b8;
}*/
.top-menu > nav > ul > li > a {
    text-decoration: none;
    display: inline-block;
    font-weight: 700;
    color: #FFF;
    text-transform: uppercase;
    line-height: 1;
    padding-bottom: 4px;
    border-bottom: 2px solid transparent;
    transition: all 200ms ease-out;
}
.top-menu > nav > ul > li:after {
    content: "";
    display: block;
    position: absolute;
    width: 1px;
    height: 20px;
    top: 0;
    right: -22px;
    background: rgba(255,255,255,0.1);
}
    </style>

<?php

$lang = Yii::$app->language;
$show_script = <<< JS



JS;
$script = <<< JS
//  jQuery(document).ready(function ($) {
//       date_time('date_time',"$lang");

//   });



JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
$this->registerJs($show_script, yii\web\View::POS_END);

?>
