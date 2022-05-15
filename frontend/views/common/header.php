<?php

use common\models\wrappers\OwnerContactWrapper;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\bootstrap\ActiveForm;

$ownInfo = OwnerContactWrapper::find()->one();
$menuItems[0] = ['label' => Yii::t('app', 'Home'), 'url' => ['/']];
// $menuItems[0] = ['label' => Yii::t('app', 'News'), 'url' => ['/item/about']];
// $menuItems[] = ['label' => Yii::t('app', 'About Us'), 'url' => ['/site/about']];
$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];


?>
<style>
    .header_top div.lang_img img{
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
.inf_block{
    background: #116B30;
    padding: 8px 10px;
    border-radius: 5px;
}
</style>
<div class="header_top" style="background: #EEF6FF;">
    <div class="container">
        <div class="row justify-content-end align-items-center">
            
                <i style="color: #333" class="fa fa-envelope-o"></i> <a style="color: #333;font-family: 'Montserrat', sans-serif;" href="mailto:<?= $ownInfo->my_email ?> ?>"><?= $ownInfo->my_email ?></a>
    
            <div class="lang_img" style="margin: 5px 0 7px 20px;">
                <?php
                echo \common\widgets\language\LanguageSwitcherDropdownWidget::widget([
                   // 'showFlags' => true
                ]);0                        
                ?>
            </div>
        </div>
    </div>
</div>
<div class="header-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                    <header class="w3l-header">
        <!--/nav-->
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
              
                <a class="navbar-brand active d-flex align-items-center" href="/">
                    <div style="display: inline-block;margin-right: 15px"><img src="<?= '/source/images/logo.png' ?>" alt="Logo"></div>
                    <div style="display: inline-block;font-size: 20px;color: #333;font-family: Montserrat;line-height: 28px;font-weight: 700;text-transform: uppercase;">  <?= yii::t('app','site_name') ?> <br> <?= yii::t('app','site_name2') ?></div>
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


            </div>
        </nav>

        <!--//nav-->
    </header>
            </div>
            <div class="col-md-8 d-flex align-items-center">
                            <!-- BEGIN TOP SEARCH -->
<?php
 // $form = ActiveForm::begin([
 //  'options' => ['class' => 'd-flex search_form'],
 //  'action'=>['site/search'],
 //  'method'=>'get']);
   ?>

<!--         <input style="padding: 4px 10px;" class="form-control me-2" type="search" placeholder="<?php //echo Yii::t('app','Search...')?>" aria-label="Search" class="search"  name="query">
                  <div class="search_icon">
                    <div class="input-group">             
  <button type="submit" class="call_btn">
      <span class="fa fa-search" style="color: #EE3897"></span>
    </button>

      
      </div>

          </div>    -->     
     <?php //ActiveForm::end(); ?>
            <!-- END TOP SEARCH -->
                <div class="d-flex justify-content-end collapse navbar-collapse" id="navbarSupportedContent">
<!--                     <div class="inf_block cont_block">
                        <ul class="inf_list">
                            <li class="inf_list_item"><a style="color: #fff" href="tel:<?php //echo $ownInfo->my_phone ?>"><i class="fa fa-phone"></i> <?php //echo $ownInfo->my_phone ?> </a></li>
                        </ul>
                    </div> -->
                    <a class="navbar-brand active d-flex align-items-center" href="/">
                    <div style="display: inline-block;font-size: 20px;color: #333;font-family: Montserrat;line-height: 28px;font-weight: 700;text-transform: uppercase;">  Halkyň arkadagly <br> zamanasy</div>
                    <div style="display: inline-block;margin-right: 15px">
                        <img style="width: 100px;height: 80px;margin-left: 15px" src="<?= '/source/images/logo2022.png' ?>" alt="Logo">
                    </div>
                    </a>
                </div>
                </div>

</div>
</div>
</div>
<div class="top-bar-wrapper visible-md visible-lg">
        <div class="inner">
            <div class="container">
                <div class="top-bar relative d-flex align-items-center">
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
    background: #116B30;
}
.top-bar {
    height: 54px;
}
.relative {
    position: relative;
}
.top-menu > nav > ul {
        list-style: none;
}
.top-menu > nav > ul > li {
    display: inline-block;
    position: relative;
}
.top-menu > nav > ul > li.active > a, .top-menu > nav > ul > li:hover > a, a.uMenuItemA {
   /* color: #17a2b8;*/
   background: #EFEA03;
    color: #116B30;
    border-radius: 5px;
}
.top-menu > nav > ul > li > a.active {
    background: #EFEA03;
    color: #116B30;
    padding: 8px 15px;
    border-radius: 5px;
}

.top-menu > nav > ul > li.active > a {
	padding: 8px 15px;
    color: #17a2b8;
    border-bottom-color: #17a2b8;
}
/*li.inf_list_item a{
    color: #17a2b8;
}*/
.top-menu > nav > ul > li > a {
    text-decoration: none;
    padding: 8px 15px;
    display: inline-block;
    font-weight: 700;
    color: #FFF;
    font-size: 15px;
    font-family: 'Montserrat';
    text-transform: uppercase;
    line-height: 1;
    border-bottom: 2px solid transparent;
    transition: all 200ms ease-out;
}
.top-menu > nav > ul > li:after {
    content: "";
    display: block;
    position: absolute;
    width: 1px;
    height: 20px;
    top: 6px;
    right: -5px;
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
