<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        'source/css/style-starter.css',
        'source/css/splide.min.css',
    ];



    public $js = [
//        Scripts
        'source/js/jquery-3.3.1.min.js',
        'source/js/owl.carousel.js',
        'source/js/jquery.magnific-popup.min.js',
        'source/js/jquery.waypoints.min.js',
        'source/js/jquery.countup.js',
        'source/js/bootstrap.min.js',
        'source/js/splide.min.js',

    ];


    public $jsOptions = [
        'position'=>View::POS_END
    ];
    
    public $depends = [
        // 'yii\web\JqueryAsset',
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',
    ];
}
