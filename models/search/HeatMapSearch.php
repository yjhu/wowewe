<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HeatMap;

/**
 * HeatMapSearch represents the model behind the search form about `app\models\HeatMap`.
 */
class HeatMapSearch extends HeatMap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['heat_map_id', 'speed_up', 'speed_down', 'speed_delay', 'status'], 'integer'],
            [['gh_id', 'openid','pic_url'], 'safe'],
            [['lon', 'lat'], 'number'],
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
        $query = HeatMap::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'heat_map_id' => $this->heat_map_id,
            'lon' => $this->lon,
            'lat' => $this->lat,
            'speed_up' => $this->speed_up,
            'speed_down' => $this->speed_down,
            'speed_delay' => $this->speed_delay,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'pic_url', $this->pic_url]);

        return $dataProvider;
    }
}
