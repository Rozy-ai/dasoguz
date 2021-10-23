<?php 
use yii\helpers\Html;

$sliders = \common\models\wrappers\ItemWrapper::find()->with(['translations','documents'])->where(['status' => '1','is_main'=>'1'])->orderBy('id DESC')->limit(3)->all();
 ?>
    <section id="home" class="w3l-banner">
        <div class="container">
            <div class="text-center">
                <div class="">
<!--                     <h1 class="mb-4 title">"Türkmenawtoulaglary" agentligi.</h1>
                    <p class="mx-lg-5">"Daşoguzawtoulag" önümçilik birleşigi 1944-nji ýylda döredilen bolup 1997-nji ýylda Daşoguzyň önümçilik awtotransport birleşigi ady bilen hasaba alynan.</p>
                </div> -->
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <?php foreach ($sliders as $slider): ?>

          <?php $slider_docs =  $slider->documents; ?>
          <?php foreach ($slider_docs as $slider_doc): ?>
            <li class="splide__slide">
        <img src="<?= '/uploads/',$slider_doc->path ?>" alt="" class="img-fluid w-100">
     
     </li>

             <?php endforeach; ?>
                                
                                      
                                   
                                    <?php endforeach ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-lg-6 about-right-faq align-self">
<!--                         <span class="text mb-2">Amatly we ýokary hilli awtobus hyzmatlary.</span> -->
                        <h3 class="title-big"><?= $about_desc->title ?></h3>
                        <p class="mt-4 mb-4" style="color: #000"><?= $about_desc->description ?></p>
                        <a href="<?= $href ?>" class="btn btn-style btn-effect mt-lg-0 mt-4"><?= yii::t('app', 'Read more') ?></a>
                    </div>
                    <div class="col-lg-6 left-wthree-img text-lg-right mt-lg-0 mt-2">
                        <div class="position-relative">
                            <img src="<?=$path?>" alt="" class="radius-image img-fluid" style="max-width: 80%;">
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
<section class="section pd-75">
    <div class="container">
        <div class="functions">
            <div class="title_section">
                <h1 style="flex: 1;text-align: center" class="move zoomIn"><?= $services->title ?></h1>
            </div>
            <div class="row text-center">
                <div class="col-md-6 col-lg-4 cards">
          
                        <div class="func_cards">
                            <div class="func_card_title ">
                                <i class="service-one__icon  fa fa-cubes"></i>
                            </div>
                            <h3><?= yii::t('app', 'Shipping')?> </h3>

                        </div>
              
                </div>
                <div class="col-md-6 col-lg-4 cards">
             
                        <div class="func_cards">
                            <div class="func_card_title">
                                <i class="service-one__icon  fa fa-group"></i>
                            </div>
                            <h3><?= yii::t('app', 'Passenger Transportation')?></h3>
                        </div>
              
                </div>
                <div class="col-md-6 col-lg-4 cards">
             
                        <div class="func_cards box-koire move">
                            <div class="func_card_title">
                                <i class="service-one__icon  fa fa-life-ring"></i>
                            </div>
                            <h3><?= yii::t('app', 'Vehicle ordering')?></h3>
                        </div>
           
                </div>

            </div>
            <div class="col-lg-12 text-center">
            <a href="<?= $href ?>" class="btn btn-style btn-effect mt-lg-0 mt-4"><?= yii::t('app', 'Read more') ?></a>
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

    <section class="news" style="background: var(--bg-light);">
        <div class="container">
            <div class="title_section">
                <h1 style="flex: 1;text-align: center;margin: 5% 0 3%;" class=""><?= yii::t('app', 'News') ?></h1>
            </div>
            <div class="row">
            <?php foreach ($news as $single): ?>
                <?php $date = Yii::$app->controller->renderDateToWord($single->date_created); ?>

            <div class="col-lg-4 col-xs-12 mb-50">
                <a class="institution-link" href="<?= '/item/'.$single->id ?>">
                    <article class="grid-blog-post">
                        <div class="post-thumbnail">
                            <?=html::img($single->getThumbPath(), ['class' => 'img100 w-100 zoom'])?>
                        </div>
                        <div class="post-content">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <h2><?=$single->title?></h2>
                            <p style="position: absolute;top: 10px;color: #0099e5;font-size: 14px"><?=$date ?></p>
                        </div>
                    </article>
                </a>
            </div>


            <?php endforeach ;?>
        </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.splide', {
                type: 'loop',
                autoplay: true,
                interval: 4000,
            }).mount();
        });
    </script>

    