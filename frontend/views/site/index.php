<?php 
use yii\helpers\Html;
 ?>
    <section id="home" class="w3l-banner">
        <div class="container-fluid" style="padding: 0">
        
            
<!--                     <h1 class="mb-4 title">"Türkmenawtoulaglary" agentligi.</h1>
                    <p class="mx-lg-5">"Daşoguzawtoulag" önümçilik birleşigi 1944-nji ýylda döredilen bolup 1997-nji ýylda Daşoguzyň önümçilik awtotransport birleşigi ady bilen hasaba alynan.</p>
                </div> -->

                        <div class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
<?php foreach ($sliders as $key => $slider): ?>
<?php $documents = $slider->documents; 
foreach($documents as $document): ?>
<?php $slds[] = $document->getThumb() ?>
<?php endforeach ?>
    <?php 
    $language = yii::$app->language;
    if ($language == 'ru') {
      $imagePath = $slds[1];
    } elseif ($language == 'en') {
      $imagePath = $slds[2];
    } else {
      $imagePath = $slds[0];
    }
    unset($slds);
    ?>
            <li class="splide__slide">


            <div class="slider_text_block">
        <img src="<?= $imagePath ?>" alt="" class="img-fluid w-100">
     
     </li>
                                    <?php endforeach ?>
                                    
                                </ul>
                            </div>
                        </div>
        </div>


    </section>
    <!-- //banner section -->




          <?php 
          // $images_parallax = \common\models\wrappers\ImageWrapper::find()->with('translations','documents')->where(['type' => 2])->limit(1)->all();

          ?>

<!--     <div class="w3l-about-us py-5 mt-5" style="background-image: url(<?php// echo '/uploads/',$images_parallax[0]->document->path ?>); background-size: cover; background-attachment: fixed;background-position: 0 -15rem;">
        <div class="container pt-lg-5 pt-sm-4">
            <div class="maghny-gd-1">
                <div class="row about-text">
                    <div class="col-lg-4">
                        <h3 class="title-big" style="color: white; text-shadow: 2px 2px 5px black;">Ýolagçylar üçin niýetlenen hyzmatlarymyz</h3>
                    </div>
                    <div class="col-lg-4 mt-lg-0 mt-4">
                        <p class=""></p>
                    </div>

                    <div class="col-lg-4 mt-lg-0 mt-2">

                    </div>
                </div>


            </div>
        </div>
    </div> -->
    <!-- About -->
        <?php 
$category = \common\models\wrappers\CategoryWrapper::find()->where(['code' => 'about'])->one();
$catId = $category->id;
$about_desc = \common\models\wrappers\ItemWrapper::find()->with(['translations','documents'])->where(['category_id' => $catId, 'status' => '1','is_main'=>'0','is_menu'=>'1'])->one(); 
$href = $about_desc->url;
$path = $about_desc->getThumbPath();
?>

    <section class="w3l-index3" id="about">
        <div class="midd-w3 py-5">
            <div class="container py-lg-4 py-md-3">
                <div class="row">
                        <div class="col-lg-6 left-wthree-img text-lg-right mt-lg-0 mt-2">
                            <div class="row align-items-end">
                                <div class="col-6">
                                    <img src="<?= '/source/img/Rectangle16.png' ?>" alt="about us">
                                </div>
                                <div class="col-6">
                                    <img src="<?= '/source/img/Rectangle17.png' ?>" class="img-fluid" alt="about us">
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-5 about-right-faq align-self" style="margin-left: 20px;">

                        <h4 style="font-weight: normal;color: #1090CB;"><?= $about_desc->title ?></h4>
                        <p class="mt-4 mb-4" style="color: #868686;font-size: 18px"><?= $about_desc->description ?></p>
                        <a href="<?= $href ?>" class="btn btn-style btn-effect mt-lg-0 mt-4"><?= yii::t('app', 'Read more') ?></a>
                    </div>

                </div>
                <div class="row" style="margin-top: 50px">
                   <div class="col-lg-5 offset-lg-1 text-lg-right">
                        <div class="position-relative">
                            <img src="<?=$path?>" alt="" class="radius-image img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-5 text-lg-left" style="margin-left: 20px;">
                        <div class="position-relative">
                            <img src="<?=$path?>" alt="" class="radius-image img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- End about -->
<!-- Advantages -->
<?php 
  
$category = \common\models\wrappers\CategoryWrapper::find()->where(['code' => 'service'])->one();
$catId = $category->id;
$services = \common\models\wrappers\ItemWrapper::find()->with(['translations','documents'])->where(['category_id' => $catId, 'status' => '1','is_main'=>'0','is_menu'=>'1'])->one(); 
$href = $services->url;

 ?>

 <section class="advantages">
     <div class="container">
         <div class="row">
             <div class="col-md-5">
                  <h2 style="font-size: 30px;line-height: 48px;color: #000;font-weight: 600" class="move zoomIn"><?= yii::t('app', 'Services of our company') ?></h2>
                  <br>
                  <p style="color: #585858;font-size: 20px;line-height: 200%"><?= $services->description ?></p>
             </div>
             <div class="col-md-5 offset-md-1">
                 <div class="adv_field">
                     <img src="/source/images/Icon1as.png" alt="Icon" style="margin-top:-30px">
                     <div class="adv_text" style="display: inline-block;margin-top: 20px;max-width:70%;">
                          <h4 style="color: #2F2C4A;font-weight: 600"><?= yii::t('app', 'Intercity routes')?></h4>
                     <p style="font-size: 16px;color: #656464"><?= yii::t('app', 'Transportation of passengers by intercity routes.')?></p>
                     </div>
                    
                 </div>
                  <div class="adv_field">
                     <img src="/source/images/Icon2as.png" alt="Icon" style="margin-top:-30px">
                     <div class="adv_text" style="display: inline-block;margin-top: 20px;max-width:70%;">
                          <h4 style="color: #2F2C4A;font-weight: 600"><?= yii::t('app', 'Trucks')?></h4>
                     <p style="font-size: 16px;color: #656464"><?= yii::t('app', 'Intercity transportation of various cargoes in trucks.')?></p>
                     </div>
                    
                 </div>
                                  <div class="adv_field">
                     <img src="/source/images/Icon3as.png" alt="Icon" style="margin-top:-30px">
                     <div class="adv_text" style="display: inline-block;margin-top: 20px;max-width:70%;">
                          <h4 style="color: #2F2C4A;font-weight: 600"><?= yii::t('app', 'Taxi cars')?></h4>
                     <p style="font-size: 16px;color: #656464"><?= yii::t('app', 'Transportation of passengers in taxis.')?></p>
                     </div>
                    
                 </div>
                                  <div class="adv_field">
                     <img src="/source/images/Icon4as.png" alt="Icon" style="margin-top:-30px">
                     <div class="adv_text" style="display: inline-block;margin-top: 20px;max-width:70%;">
                          <h4 style="color: #2F2C4A;font-weight: 600"><?= yii::t('app', 'Car Repair')?></h4>
                     <p style="font-size: 16px;color: #656464"><?= yii::t('app', 'Car repairs and maintenance.')?></p>
                     </div>
                    
                 </div>
             </div>
         </div>
     </div>
 </section>

<!-- End advantages -->
    <!-- //bottom-grids-->
<!--     <section class="w3l-index3" id="about">
        <div class="midd-w3 py-5">
            <div class="container py-lg-5 py-md-3">
                <div class="row">
                    <div class="col-lg-6 left-wthree-img text-lg-right">
                        <div class="position-relative">
                            <img src="/source/images/facade.jpg" alt="" class="radius-image img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6 about-right-faq align-self">
                        <span class="text mb-2">Biziň maksadymyz</span>
                        <h3 class="title-big">Halkyň aladysyny edýän sürüjülerimiz
                        </h3>
                        <p class="mt-4"> Hormatly Prezidentimiziň karary bilen Aşgabat şäherinde ýolagçylara hyzmat etmek üçin ähli şertler döredilen döwrebap halkara ýolagçy awtomenzili</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <!-- stats -->
<!--     <section class="w3l-stats py-5" id="stats">
        <div class="gallery-inner container py-md-5 py-4">
            <div class="row stats-con">
                <div class="col-md-4 col-6 stats_info counter_grid">
                    <h3>2008-nji ýyldan bari</h3>
                    <p class="counter">2008</p>
                    <span>Döredilen</span>
                </div>
                <div class="col-md-4 col-6 stats_info counter_grid1">
                    <h3>Alkyş gazandyk</h3>
                    <p class="counter">120</p>
                    <span>Sany</span>
                </div>
                <div class="col-md-4 col-6 stats_info counter_grid mt-md-0 mt-5">
                    <h3>Ýolagçylaryň sany</h3>
                    <p class="counter">1500</p>
                    <span>Dündelik</span>
                </div>
            </div>
        </div>
    </section> -->
    <!-- //stats -->
    <!-- Quote -->
   <!--  <div class="quote py-5">
        <div class="container py-lg-4">
            <div class="quote-left">
                <div class="left">
                    <h3 class="title-big mb-3">Ugurlar barada maglumat</h3>
                    <p>Awtobuslaryň ähli ugurlary barada maglumat</p>
                </div>
                <a href="<?= '/site/a/contact' ?>" class="btn btn-style btn-effect mt-lg-0 mt-4">Biz bilen habarlaşyň</a>
            </div>
        </div>
    </div> -->
    <?php 
$category = \common\models\wrappers\CategoryWrapper::find()->where(['code' => 'news'])->one();
$catId = $category->id;

$news = \common\models\wrappers\ItemWrapper::find()->with(['translations','documents'])->where(['category_id' => $catId, 'status' => '1','is_main'=>'0','is_menu'=>'0'])->orderBy('date_created DESC')->limit(3)->all(); 
?>

    <section class="news">
        <div class="container">
            <div class="title_section">
                <h1 style="font-size: 30px;font-weight:600;line-height: 160%;color: #000;margin: 5% 0 3%;" class=""><?= yii::t('app', 'News') ?></h1>
            </div>
            <div class="row">
            <?php foreach ($news as $single): ?>
               

            <div class="col-lg-4 col-xs-12 mb-50">
                <a class="institution-link" href="<?= '/item/'.$single->id ?>">
                    <article class="grid-blog-post">
                        <div class="post-thumbnail" style="height: 225px">
                            <?=html::img($single->getThumbPath(), ['class' => 'img100 w-100 zoom','style' => 'height:100%;object-fit:cover'])?>
                        </div>
                        <div class="post-content">
                          <!--   <i class="fa fa-chevron-right" aria-hidden="true"></i> -->
                            <h2 style="margin: 15px 0"><?=$single->title?></h2>
                            <p style="color: #424242;font-size: 16px;font-weight: 400"> <?php
                         $desc = Yii::$app->controller->truncate($single->description, 20, 300);                            
                          echo $desc;                             ?></p>
                           
                        </div>
                    </article>
                </a>
            </div>


            <?php endforeach ;?>
        </div>
        <div class="col-xs-12 text-center" style="margin-top: 60px">
            <a href="<?= '/item/news' ?>">
                <button style="background: #116B30;border-radius: 3px;padding: 0.7rem 2rem;" type="button" class="btn btn-success"><?= yii::t('app', 'Hemmesi') ?> &nbsp; <i class="fa fa-arrow-right "></i></button></a>
        </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.splide', {
                type: 'loop',
                width: '100%',
                autoplay: false,
                interval: 4000,
            }).mount();
        });
    </script>