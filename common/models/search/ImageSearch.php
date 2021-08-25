<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\wrappers\ImageWrapper;

/**
 * ImageSearch represents the model behind the search form about `common\models\wrappers\ImageWrapper`.
 */
class ImageSearch extends ImageWrapper
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['title', 'date_created', 'date_modified','type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ImageWrapper::find();

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
            'type' => $this->type,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
        ]);


        $query->joinWith('translations', false);
        $query->distinct();
        $query->andFilterWhere(['like', 'tbl_image_lang.title', $this->title]);
        $query->andFilterWhere(['like', 'tbl_image_lang.description', $this->description]);


        return $dataProvider;
    }
}
