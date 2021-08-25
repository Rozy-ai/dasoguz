<?php

namespace common\widgets\leaflet;

class LeafletWidget extends \yii\base\Widget
{
    public $cssId = "map";
    public $height = 400;
    public $type = "box";
    public $lat = 0;
    public $lng = 0;
    public $latId = "latId";
    public $lngId = "lngId";
    public $zoom = 12;

    public function init()
    {
        LeafletWidgetAsset::register($this->getView());
        parent::init();
    }

    public function run()
    {
        if ($this->lat == 0)
            $this->lat = 37.94;

        if ($this->lng == 0)
            $this->lng = 58.38;

        return $this->render($this->type);
    }
}