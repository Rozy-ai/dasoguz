<?php
/**
 * Created by PhpStorm.
 * User: Fujitsu
 * Date: 1.4.2017
 * Time: 9:00 AM
 */

namespace common\widgets\items\recent;
use common\models\wrappers\ItemWrapper;

class RecentPosts  extends \yii\base\Widget{
    public $items = [];
    public $limit = 5;
    public $category = null;

    public function init() {
        if ($this->category) {
            $this->items = ItemWrapper::find()
                ->andWhere(['not', ['date_event' => null]])
                ->andWhere('date_event >= NOW()')
                ->andWhere('category_id = 55  or  parent_category_id=55')
                ->joinWith('translations')
                ->andWhere(['not', ['tbl_item_lang.title' => null]])
                ->andWhere(['tbl_item_lang.language' => \Yii::$app->language])
                ->orderBy('date_event ASC')
                ->limit($this->limit)
                ->all();
            $this->items+= ['limit' => $this->limit];
        }

//        if (isset($this->items) && count($this->items) >= 0) {
//            $this->mainItem = $this->items[0];
////              $this->items = array_splice($this->items, 1);
//        }
        parent::init();
    }


    public function run()
    {
        if(isset($this->items)){
            return $this->render('recent-items');
        }
    }
}