<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MQingshiAuthor;

/**
 * MQingshiAuthorSearch represents the model behind the search form about `app\models\MQingshiAuthor`.
 */
class MQingshiAuthorSearch extends MQingshiAuthor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['gh_id', 'author_openid', 'p1', 'p2', 'p3', 'create_time'], 'safe'],
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
        $query = MQingshiAuthor::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'author_openid', $this->author_openid])
            ->andFilterWhere(['like', 'p1', $this->p1])
            ->andFilterWhere(['like', 'p2', $this->p2])
            ->andFilterWhere(['like', 'p3', $this->p3]);

        return $dataProvider;
    }
}
