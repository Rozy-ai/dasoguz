<?php

namespace common\widgets\items\solutions;

use common\models\wrappers\ItemWrapper;

class Solutions extends \yii\base\Widget
{
    public $items = [];
    public $limit = 9;
    public $category = null;

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
                ->orderBy('id DESC')
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
        if (isset($this->items))
        return $this->render('solutions');
    }
}