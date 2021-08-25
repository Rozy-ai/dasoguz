<?php

namespace common\models\search;

use common\models\wrappers\SeatWrapper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SeatSearch represents the model behind the search form of `common\models\wrappers\SeatWrapper`.
 */
class SeatSearch extends SeatWrapper {
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'seat_group_id'], 'integer'],
            [['name', 'label_x', 'label_y'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SeatWrapper::find();

        $query->orderBy('id desc');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'seat_group_id' => $this->seat_group_id,
            'location_id' => $this->location_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label_x', $this->label_x])
            ->andFilterWhere(['like', 'label_y', $this->label_y]);

        return $dataProvider;
    }
}
