<?php
namespace common\widgets\seatSelector;

use yii\grid\GridView;
use yii\web\AssetBundle;

class SeatSelectorAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/seatSelector/assets';
    public $css = [
//        'jquery.seat-charts.css'
        'pinchzoomer.min.css',
        'svg_map.css'
    ];
    public $js = [
//        'jquery.seat-charts.js',
        'prettify.min.js',
        'tooltipster.bundle.min.js',
        'hammer.min.js',
        'TweenMax.min.js',
        'jquery.pinchzoomer.min.js',
        'preview.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = [
        'forceCopy' => true,
    ];
}