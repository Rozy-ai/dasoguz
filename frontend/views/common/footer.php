<?php
use \kartik\widgets\DatePicker;
use common\models\wrappers\ItemWrapper;
use yii\helpers\Html;
use yii\widgets\Menu;
use common\models\Route;
use yii\helpers\Url;

// $ownInfo = \common\models\OwnerContact::find()->one();
// $serviceItems = ItemWrapper::find()->joinWith('category cat')->where(['cat.code' => 'service', 'tbl_item.status' => 1])->limit(5)->all();
// $services = [ 'Hyzmat 1', 'Hyzmat 2', 'Hyzmat 3' ];
// $routes = Route::find()->limit(4)->all();
// $routepage[] = $menuItems[2];
$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];
?>

<style>
    section.w3l-footer-29-main .footer-title-29{
        color: #fff;
    }
    .w3l-footer-29-main .footer-list-29 ul li a{
        color: #fff;
    }
    .w3l-footer-29-main p.copy-footer-29 {
        color: #fff;
    }
</style>
    <!-- footer -->
    <section class="w3l-footer-29-main" style="padding-bottom: 0;background-color: #333">
        <div class="footer-29">
            <div class="container py-lg-4">
                <div class="row footer-top-29">
                    <div class="col-lg-4 col-md-6 col-sm-7 col-6 footer-list-29 footer-2 mt-sm-0 mt-5">

                        <ul>
                            <h6 class="footer-title-29"><?= yii::t('app', 'Pages') ?></h6>
                            <?php
                    echo Menu::widget([
                        'items' => $menuItems,
                        'options' => [
                            'class' => '',
                        ],
                    'linkTemplate' => "<li><a href=\"{url}\" class=''>{label}</a></li>",
                    'itemOptions' => ['class' => ''],
                    ]);
                    ?>
                                       <?php
                                // $item = ItemWrapper::findOne(1007);
                                // echo "<li style:'margin-top:10px'>";
                                // echo html::a($item->title, '/privacy-policy', ['']);
                                // echo "</li>";
                                ?>

                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-5 footer-list-29 footer-1">
                         <h6 class="footer-title-29"><?= yii::t('app', 'Contacts') ?></h6>
                                                  <div style="font-size: 18px;line-height: 28px;color: #fff;">
                           <?= yii::t('app', 'phone_footer') ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
<!--                         <div class="footer-logo mb-4">
                            <a class="navbar-brand" href="<?php //echo "/" ?>">
                                <div style="display: inline-block;"><img src="<?php //echo '/source/images/logo.png' ?>" alt="Logo"></div>
                    <div style="display: inline-block;color: #fff"></span> <?php //echo yii::t('app','site_name') ?> <span class="logo" style="color: #fff;font-weight: normal;"><?php// echo yii::t('app','site_name2') ?></span></div>
                            </a>
                        </div> -->
                        <h6 class="footer-title-29"><?= yii::t('app', 'Our address') ?></h6>
                        <div style="font-size: 18px;line-height: 28px;color: #fff;">
                           <?= yii::t('app', 'address') ?>
                        </div>


                    </div>

<!--                     <div class="col-lg-3 col-md-6 col-sm-5 col-6 offset-lg-1 footer-list-29 footer-3 mt-lg-0 mt-5">
                        <h6 class="footer-title-29"><?= yii::t('app', 'Service') ?></h6>
                        <ul>
                            <li><a href="#"><?= yii::t('app', 'Shipping')?></a></li>
                            <li><a href="#"> <?= yii::t('app', 'Passenger Transportation')?></a></li>
                            <li><a href="#offer"><?= yii::t('app', 'Vehicle ordering')?></a></li>
                        </ul>

                    </div> -->

                </div>
            </div>
        </div>
    </section>
    <!-- //footer -->

    <!-- copyright -->
    <section class="w3l-footer-29-main w3l-copyright" style="padding-bottom: 0;background-color: #333">
        <div class="container">
            <div class="row bottom-copies">
           <!--      <p class="col-lg-8 copy-footer-29">?? 2020 Da??oguzAwtoulag. ??hli hukuklar goralan.</p> -->
                <p class="col-lg-8 copy-footer-29">&copy; <?= date('Y') ?>. <?= Yii::t('app','All rights reserved.') ?>  </p>



            </div>
        </div>

        <!-- move top -->
        <button onclick="topFunction()" id="movetop" title="Go to top">
        <i style="color: #FFB200;" class="fa fa-2x fa-angle-up"></i>
    </button>
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("movetop").style.display = "block";
                } else {
                    document.getElementById("movetop").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
        <!-- /move top -->
    </section>