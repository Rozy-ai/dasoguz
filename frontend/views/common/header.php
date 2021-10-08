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

    <header class="w3l-header">
        <!--/nav-->
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <span class="fa fa-globe"></span> DaşoguzAwtoulag <span class="logo">Önümliçil birleşigi</span></a>
                <!-- if logo is image enable this
                            <a class="navbar-brand" href="#index.html">
                                <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                            </a> -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                                            <?php
                    echo Menu::widget([
                        'items' => $menuItems,
                        'options' => [
                            'class' => 'navbar-nav ml-auto',
                        ],
                    'linkTemplate' => "<a href=\"{url}\" class='nav-link'>{label}</a>",
                    'itemOptions' => ['class' => 'nav-item'],
                    ]);
                    ?>
                    
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
