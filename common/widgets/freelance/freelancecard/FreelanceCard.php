<?php

namespace common\widgets\freelance\freelancecard;

use common\models\wrappers\FreelancerWrapper;
use common\models\wrappers\ItemWrapper;

class FreelanceCard extends \yii\base\Widget
{
    public $items = [];
    public $limit = 5;
    public $category = 19;
    public $child_category = null;
    public $view = 'freelancecard';
    public $orderby  = 'id desc';

    public function init()
    {
        if($this->category) {
                $this->items = FreelancerWrapper::find()
//                ->joinWith('category cat')
//                ->joinWith('category.parent parent')
//                ->joinWith('translations tr')
//                ->distinct()
//                ->andWhere(['not', ['tr.name' => null]])

//                ->orderBy('visited_count asc')
//                    ->orWhere(['or', 'category_id =' . $this->category])
//                    ->orWhere(['or', 'parent_category_id =' . $this->category])
                    ->where('status = 1')
                    ->orderBy('rand()')

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
        if (isset($this->items)){
            return $this->render($this->view);
        }
    }
}