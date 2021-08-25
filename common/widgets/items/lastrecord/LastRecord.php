<?php

namespace common\widgets\items\lastrecord;

use common\models\wrappers\ItemWrapper;

class LastRecord extends \yii\base\Widget
{
    public $items = [];
    public $category = null;
    public $limit = 1;
    public $offset = 1;
    public $img_width  = 800;
    public $img_height  = 520;

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
                ->andWhere(['not', ['category_id' => null]])
                ->orderBy('id desc')
                ->limit($this->limit)
                ->offset($this->offset)
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
            return $this->render('last_record',[
            'img_width' => $this->img_width,
                'img_height' => $this->img_height,
            ]);
    }
}