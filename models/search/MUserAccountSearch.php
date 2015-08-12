<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MUserAccount;

/**
 * MUserAccountSearch represents the model behind the search form about `app\models\MUserAccount`.
 */
class MUserAccountSearch extends MUserAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'status', 'cat', 'scene_id'], 'integer'],
            [['gh_id', 'openid', 'create_time', 'memo', 'oid', 'charge_mobile'], 'safe'],
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
        $query = MUserAccount::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'create_time' => $this->create_time,
            'amount' => $this->amount,
            'status' => $this->status,
            'cat' => $this->cat,
            'scene_id' => $this->scene_id,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'oid', $this->oid])
            ->andFilterWhere(['like', 'charge_mobile', $this->charge_mobile]);

        return $dataProvider;
    }
}
