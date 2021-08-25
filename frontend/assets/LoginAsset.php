<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class LoginAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all',
        'https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900',

        'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',

        'source/css/register.css',

//        'source/global/plugins/morris/morris.css',
//        'source/global/plugins/fullcalendar/fullcalendar.min.css',

    ];

    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js',

//        'source/global/plugins/morris/morris.min.js',
//        'source/global/plugins/morris/raphael-min.js',


//        'source/global/scripts/app.js',
        'source/js/register.js',


//        'source/layouts/layout/scripts/layout.min.js',
//        'source/layouts/layout/scripts/demo.min.js',
//        'source/layouts/global/scripts/quick-sidebar.min.js',
    ];


    public $jsOptions = [
        'position' => View::POS_END
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
