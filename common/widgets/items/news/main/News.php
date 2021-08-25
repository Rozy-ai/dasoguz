<?php
/**
 * Created by PhpStorm.
 * User: Fujitsu
 * Date: 1.4.2017
 * Time: 9:00 AM
 */

namespace common\widgets\items\news\main;

use common\models\wrappers\ItemWrapper;

class News extends \yii\base\Widget
{
    public $items = [];
    public $mainItem;
    public $category;
    public $view = 'main_block';
    public $limit = 7;

    public function init()
    {
        if ($this->category) {
            $this->items = ItemWrapper::find()
                ->joinWith('category cat')
                ->joinWith('category.parent parent')
                ->joinWith('translations tr')
                ->distinct()
                ->where(['tbl_item.status' => 1])
                ->andWhere(['not', ['tr.title' => null]])
                ->andWhere(['tr.language' => \Yii::$app->language])
                ->andWhere(['or', 'cat.code="' . $this->category . '"', 'parent.code="' . $this->category . '"'])
                ->orderBy('is_main desc, id desc')
                ->limit($this->limit)
                ->all();
        }

//        if (isset($this->items) && count($this->items) >= 0) {
//            $this->mainItem = $this->items[0];
////              $this->items = array_splice($this->items, 1);
//        }
        parent::init();
    }


    public function run()
    {
        print_r($this->items);
        if (is_array($this->items) && count($this->items) && $this->view)
            return $this->render($this->view);
    }
}