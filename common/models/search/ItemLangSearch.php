<?php

namespace common\models\search;

use common\models\ItemLang;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\wrappers\ItemWrapper;
use yii\helpers\Url;

/**
 * ItemSearch represents the model behind the search form about `common\models\wrappers\ItemWrapper`.
 */
class ItemLangSearch extends ItemLang
{
    public $query;
    public $status;



    public function search($params)
    {
        $query = ItemLang::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere([
            'language' => Yii::$app->language,
        ]);

//        $query->joinWith('item it')->andWhere(['it.status' => $this->status]);

        if (isset($this->query) && strlen(trim($this->query))) {
            $query->andWhere(['or',
                ['like', 'title', $this->query],
                ['like', 'description', $this->query],
                ['like', 'content', $this->query]
            ]);
//            var_dump($query);die;
        }
        return $dataProvider;
    }
}
