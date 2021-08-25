<?php
/**
 * Created by PhpStorm.
 * User: Fujitsu
 * Date: 1.4.2017
 * Time: 9:00 AM
 */

namespace common\widgets\currency;

use common\models\CbtCurrency;

class ListWidget extends \yii\base\Widget
{
    public $list = [];
    public $view;
    public $limit;

    public function init()
    {
        $query = CbtCurrency::find()
            ->where(['status' => 1])
            ->orderBy('id desc')
            ->limit($this->limit);
        $this->list = $query->all();

        parent::init();
    }


    public function run()
    {

        if (is_array($this->list) && count($this->list) && $this->view) {
            return $this->render($this->view);
        }
    }
}