<?php
namespace common\widgets\leaflet;

use yii\web\AssetBundle;

class LeafletWidgetAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/leaflet/assets';
    public $css = ['leaflet.css'];
    public $js = ['leaflet.js'];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}