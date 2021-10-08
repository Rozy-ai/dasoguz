<?php
use \kartik\widgets\DatePicker;
use common\models\wrappers\ItemWrapper;
use yii\helpers\Html;
use yii\widgets\Menu;
use common\models\Route;
use yii\helpers\Url;

$ownInfo = \common\models\OwnerContact::find()->one();
$serviceItems = ItemWrapper::find()->joinWith('category cat')->where(['cat.code' => 'service', 'tbl_item.status' => 1])->limit(5)->all();
$services = [ 'Hyzmat 1', 'Hyzmat 2', 'Hyzmat 3' ];
$routes = Route::find()->limit(4)->all();
// $routepage[] = $menuItems[2];
?>

    <!-- footer -->
    <section class="w3l-footer-29-main">
        <div class="footer-29 py-5">
            <div class="container py-lg-4">
                <div class="row footer-top-29">
                    <div class="col-lg-3 col-md-6 col-sm-5 footer-list-29 footer-1">
                        <div class="footer-logo mb-4">
                            <a class="navbar-brand" href="<?= "/" ?>">
                                <span class="fa fa-globe"></span> <?= yii::t('app', 'site_name') ?> <span class="logo"><?= yii::t('app', 'site_name2') ?></span></a>
                        </div>
                        <ul>
                            <li><a href="tel:<?= $ownInfo->my_phone ?>"><span class="fa fa-phone"></span> <?= $ownInfo->my_phone ?></a></li>
                            <li><a href="mailto:<?= $ownInfo->my_email ?>" class="mail"><span class="fa fa-envelope-open-o"></span>
                                <?= $ownInfo->my_email ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-7 offset-lg-1 col-6 footer-list-29 footer-2 mt-sm-0 mt-5">

                        <ul>
                            <h6 class="footer-title-29">Edara</h6>
                            <li><a href="<?='/item/939'?>"><?= Yii::t('app', 'About Us') ?></a></li>
                            <li><a href="<?= '/item/news'?>"> Täzelikler</a></li>
                            <!-- <li><a href="#pricing"> Etraplara gatnawlar</a></li> -->
                            <li><a href="<?='/site/a/contact' ?>"><?= Yii::t('app', 'Contact') ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-5 col-6 footer-list-29 footer-3 mt-lg-0 mt-5">
                        <h6 class="footer-title-29">Hyzmatlarymyz</h6>
                        <ul>
                            <li><a href="#about">Edýan işlerimiz</a></li>
                            <li><a href="#blog"> Biz nahili işleýäs</a></li>
                            <li><a href="#offer">Orun bronlamak</a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- //footer -->

    <!-- copyright -->
    <section class="w3l-footer-29-main w3l-copyright">
        <div class="container">
            <div class="row bottom-copies">
           <!--      <p class="col-lg-8 copy-footer-29">© 2020 DaşoguzAwtoulag. Ähli hukuklar goralan.</p> -->
                <p class="col-lg-8 copy-footer-29">&copy;<?= date('Y') ?><?=yii::t('app', 'site_name')?>. <?= Yii::t('app','All rights reserved.') ?>  </p>

                <div class="col-lg-4 main-social-footer-29">
                    <a href="#facebook" class="facebook"><span class="fa fa-facebook"></span></a>
                    <a href="#twitter" class="twitter"><span class="fa fa-twitter"></span></a>
                    <a href="#instagram" class="instagram"><span class="fa fa-instagram"></span></a>
                    <a href="#linkedin" class="linkedin"><span class="fa fa-linkedin"></span></a>
                </div>

            </div>
        </div>

        <!-- move top -->
        <button onclick="topFunction()" id="movetop" title="Go to top">
        &#10548;
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