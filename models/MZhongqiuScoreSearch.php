<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MZhongqiuScore;

/**
 * MZhongqiuScoreSearch represents the model behind the search form about `app\models\MZhongqiuScore`.
 */
class MZhongqiuScoreSearch extends MZhongqiuScore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['score_id', 'score', 'status'], 'integer'],
            [['author_openid', 'create_time'], 'safe'],
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
        $query = MZhongqiuScore::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'score_id' => $this->score_id,
            'score' => $this->score,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'author_openid', $this->author_openid]);

        return $dataProvider;
    }
}
