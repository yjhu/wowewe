<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOfficeScoreEvent;

/**
 * MOfficeScoreEventSearch represents the model behind the search form about `app\models\MOfficeScoreEvent`.
 */
class MOfficeScoreEventSearch extends MOfficeScoreEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'office_id', 'cat', 'score', 'status'], 'integer'],
            [['gh_id', 'openid', 'create_time', 'memo', 'code'], 'safe'],
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
        $query = MOfficeScoreEvent::find()->where(['>', "cat" , 100]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'office_id' => $this->office_id,
            'cat' => $this->cat,
            'create_time' => $this->create_time,
            'score' => $this->score,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

    public function searchOffice($params, $office_id)
    {
        $query = MOfficeScoreEvent::find()
                ->where(["office_id" => $office_id])
                ->where(['>', "cat" , 100]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'office_id' => $this->office_id,
            'cat' => $this->cat,
            'create_time' => $this->create_time,
            'score' => $this->score,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

}
