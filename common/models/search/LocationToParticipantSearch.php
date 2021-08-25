<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\wrappers\LocationToParticipantWrapper;

/**
 * LocationToParticipantSearch represents the model behind the search form of `common\models\wrappers\LocationToParticipantWrapper`.
 */
class LocationToParticipantSearch extends LocationToParticipantWrapper
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'location_id', 'participant_id', 'status'], 'integer'],
            [['date_joined', 'date_leaved'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = LocationToParticipantWrapper::find();

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
            'location_id' => $this->location_id,
            'participant_id' => $this->participant_id,
            'status' => $this->status,
            'date_joined' => $this->date_joined,
            'date_leaved' => $this->date_leaved,
        ]);

        return $dataProvider;
    }
}
