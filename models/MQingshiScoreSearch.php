<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MQingshiScore;

/**
 * MQingshiScoreSearch represents the model behind the search form about `app\models\MQingshiScore`.
 */
class MQingshiScoreSearch extends MQingshiScore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['score_id', 'author_openid', 'score', 'status'], 'integer'],
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
        $query = MQingshiScore::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'score_id' => $this->score_id,
            'author_openid' => $this->author_openid,
            'score' => $this->score,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
