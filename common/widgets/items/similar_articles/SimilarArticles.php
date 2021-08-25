<?php

namespace common\widgets\items\similar_articles;

use common\models\wrappers\ItemWrapper;

class SimilarArticles extends \yii\base\Widget
{
    public $items = [];
    public $limit = 5;
    public $category = null;

    public function init()
    {
        if ($this->category == 'calendar'){
            $sort = 'id DESC';
        } else {
            $sort ='RAND()';
        }
        if ($this->category) {
            $this->items = ItemWrapper::find()
                ->joinWith('category cat')
                ->joinWith('category.parent parent')
                ->joinWith('translations tr')
                ->distinct()
                ->where('((tbl_item.status = 1) OR (tbl_item.is_main = 1))')
                ->andWhere(['not', ['tr.title' => null]])
                ->andWhere(['tr.language' => \Yii::$app->language])
                ->andWhere(['or', 'cat.code="' . $this->category . '"', 'parent.code="' . $this->category . '"'])
                ->orderBy($sort)
                ->all();
//            var_dump($this->items);
//            echo "<pre>";
//            var_dump($this->items);die;
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
        return $this->render('similar_articles');
    }
}