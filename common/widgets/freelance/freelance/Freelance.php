<?php

namespace common\widgets\freelance\freelance;

use common\models\wrappers\FreelancerWrapper;
use common\models\wrappers\ItemWrapper;

class Freelance extends \yii\base\Widget
{
    public $items = [];
    public $limit = 5;
    public $category = 19;
    public $child_category = null;

    public function init()
    {
        if ($this->category == 0){
            $this->category =19;
        }
        if ($this->category) {
            $this->items = FreelancerWrapper::find()
                ->joinWith('category cat')
                ->joinWith('category.parent parent')
                ->joinWith('translations tr')
                ->distinct()
//                ->where(['status' => 1])
//                ->andWhere(['not', ['tr.name' => null]])
                ->andWhere(['or', 'category_id =' . $this->category])
                ->orWhere(['or', 'parent_category_id =' . $this->category])
                //                ->orderBy('visited_count asc')
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
        return $this->render('freelance');
    }
}