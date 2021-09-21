<?php

namespace common\widgets\items\topnews;

use common\models\wrappers\ItemWrapper;

class TopPosts extends \yii\base\Widget
{
    public $items = [];
    public $limit = 5;
    public $category = null;
    public $message;

    public function init()
    {
            $max = ItemWrapper::find()->select('visited_count')->orderBy('visited_count desc')->one();
            $this->items = ItemWrapper::find()
                ->joinWith('category cat')
                ->joinWith('category.parent parent')
                ->joinWith('translations tr')
                ->distinct()
                ->where(['tbl_item.status' => 1])
                ->andWhere(['not', ['tr.title' => null]])
                ->andWhere(['not', ['cat.code' => 'calendar' ]])
                ->andWhere(['tr.language' => \Yii::$app->language])
               ->andWhere(['or', 'cat.code="' . $this->category . '"', 'parent.code="' . $this->category . '"'])
                ->andWhere('visited_count <'.rand(1,(1+(int)(($max->visited_count)/100)))*100)
                ->orderBy('visited_count desc')
                ->limit($this->limit)
                ->all();


//        if (isset($this->items) && count($this->items) >= 0) {
//            $this->mainItem = $this->items[0];
////              $this->items = array_splice($this->items, 1);
//        }
        parent::init();
    }


    public function run()
    {
        if (isset($this->items))
            return $this->render('top-items');
    }
}