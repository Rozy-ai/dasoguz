<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\wrappers\RouteWrapper;

/**
 * RouteSearch represents the model behind the search form about `common\models\wrappers\RouteWrapper`.
 */
class RouteSearch extends RouteWrapper {
    public $point_from;
    public $point_to;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'route_no', 'cycle_min', 'planned_period_min', 'region', 'type'], 'integer'],
            [['id', 'route_no','points', 'cycle_min', 'planned_period_min', 'region', 'type'], 'safe'],
            [['length'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = RouteWrapper::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'region' => $this->region,
            'type' => $this->type,
            'route_no' => $this->route_no,
            'points' => $this->points,
            'length' => $this->length,
            'cycle_min' => $this->cycle_min,
            'planned_period_min' => $this->planned_period_min,
            
        ]);

        if (!isset($_GET['sort'])) {
            $query->orderBy('route_no');
        }

        return $dataProvider;
    }
}
