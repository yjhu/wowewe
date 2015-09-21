<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MZhongqiuVote;

/**
 * MZhongqiuVoteSearch represents the model behind the search form about `app\models\MZhongqiuVote`.
 */
class MZhongqiuVoteSearch extends MZhongqiuVote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qingshi_vote_id', 'vote_score'], 'integer'],
            [['author_openid', 'vote_openid', 'vote_time'], 'safe'],
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
        $query = MZhongqiuVote::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'qingshi_vote_id' => $this->qingshi_vote_id,
            'vote_score' => $this->vote_score,
            'vote_time' => $this->vote_time,
        ]);

        $query->andFilterWhere(['like', 'author_openid', $this->author_openid])
            ->andFilterWhere(['like', 'vote_openid', $this->vote_openid]);

        return $dataProvider;
    }
}
