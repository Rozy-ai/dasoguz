<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\wrappers\ShowWrapper;

/**
 * ShowSearch represents the model behind the search form of `common\models\wrappers\ShowWrapper`.
 */
class ShowSearch extends ShowWrapper
{

    public $from_start_time;
    public $to_start_time;
    public $location_ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'content_item_id', 'location_id', 'duration_min'], 'integer'],
            [['title', 'from_start_time', 'to_start_time'], 'safe']
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
    public function search($params, $formName = null)
    {
        $query = ShowWrapper::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (isset($this->afterStartDatetime)) {
//            $query->andWhere(['and', "latest_event_date  >= '" . \Yii::$app->formatter->asDate($this->afterStartDatetime, 'yyyy-MM-dd HH:mm:ss') . "'", "latest_event_date is not null"]);
            $query->joinWith('events ev', false);
            $query->distinct();
            $query->andFilterWhere(['and',
                "ev.start_time>='" . \Yii::$app->formatter->asDate($this->afterStartDatetime, 'yyyy-MM-dd HH:mm:ss') . "'",
                'ev.start_time is not null',
                'ev.status=1'
            ]);

            $dataProvider->setSort([
                'attributes' => array_merge(
                    $dataProvider->getSort()->attributes,
                    [
                        'latest_event_date' => [
                            'asc' => ['ev.start_time' => SORT_ASC],
                            'desc' => ['ev.start_time' => SORT_DESC],
                            'label' => 'latest_event_date',
                            'default' => SORT_DESC,
                        ],
                    ]
                ),
            ]);

            $query->select(["tbl_show.id", "tbl_show.content_item_id", "tbl_show.location_id", "tbl_show.duration_min", "ev.start_time AS latest_event_date"]);
//            $query->addSelect(["tbl_show.id,tbl_show.content_item_id,tbl_show.location_id,tbl_show.duration_min", "ev.start_time AS latest_event_date"]);
        }

//        SELECT DISTINCT `tbl_show`.* FROM `tbl_show` LEFT JOIN `tbl_event` `ev` ON `tbl_show`.`id` = `ev`.`show_id` WHERE (ev.start_time>='2020-01-29 00:30:21') AND (ev.start_time is not null) ORDER BY `ev`.`start_time1` LIMIT 20",

//        if (isset($this->afterStartDatetime)) {
//            $query->andWhere(['and', "latest_event_date  >= '" . \Yii::$app->formatter->asDate($this->afterStartDatetime, 'yyyy-MM-dd HH:mm:ss') . "'", "latest_event_date is not null"]);
//        }


//        SELECT COUNT(*) FROM (SELECT DISTINCT `tbl_show`.* FROM `tbl_show` LEFT JOIN `tbl_event` `ev` ON `tbl_show`.`id` = `ev`.`show_id` WHERE (ev.start_time>=2020-01-20 14:32:27) AND (ev.start_time is not null))

        if (isset($this->from_start_time) && strlen(trim($this->from_start_time)) > 0) {
            $query->joinWith('events ev', false);
            $startDate = new \DateTime($this->from_start_time);
            $query->andFilterWhere(['>=', 'ev.start_time', $startDate->format('Y-m-d') . ' 00:00']);
//            $query->andFilterWhere(['>=', 'latest_event_date', $startDate->format('Y-m-d') . ' 00:00']);
        }
        if (isset($this->to_start_time) && strlen(trim($this->to_start_time)) > 0) {
            $query->joinWith('events ev', false);
            $endDate = new \DateTime($this->to_start_time);
            $query->andFilterWhere(['<=', 'ev.start_time', $endDate->format('Y-m-d') . ' 23:59']);
//            $query->andFilterWhere(['<=', 'latest_event_date', $endDate->format('Y-m-d') . ' 23:59']);
        }


        if (isset($this->title) && strlen(trim($this->title)) > 0) {
            $query
                ->joinWith('content', false)
                ->joinWith('content.translations tr');

            $query->distinct();
            $query->andFilterWhere(['like', 'tr.title', $this->title]);
//        $query->andFilterWhere(['like', 'tbl_item_lang.description', $this->description]);
//        $query->andFilterWhere(['like', 'tbl_item_lang.content', $this->content]);
        }


        if (isset($this->location_id) && strlen(trim($this->location_id)) > 0 && $this->location_id > 0) {
            $query->joinWith('location loc', false)
                ->andFilterWhere(['or', 'loc.id=' . $this->location_id, 'loc.parent_id=' . $this->location_id]);
        }


        if (isset($this->location_ids)) {
            $query->andWhere(['in', 'location_id', $this->location_ids]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tbl_show.id' => $this->id,
            'content_item_id' => $this->content_item_id,
//            'location_id' => $this->location_id,
            'duration_min' => $this->duration_min,
        ]);

        return $dataProvider;
    }
}
