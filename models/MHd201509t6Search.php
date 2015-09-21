<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MHd201509t6;

/**
 * MHd201509t6Search represents the model behind the search form about `app\models\MHd201509t6`.
 */
class MHd201509t6Search extends MHd201509t6
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hd201509t6_id', 'tcnx', 'hbme', 'status'], 'integer'],
            [['gh_id', 'openid', 'mobile', 'yfzx', 'fsc', 'create_time', 'qdbm'], 'safe'],
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
        $query = MHd201509t6::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'hd201509t6_id' => $this->hd201509t6_id,
            'tcnx' => $this->tcnx,
            'hbme' => $this->hbme,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'yfzx', $this->yfzx])
            ->andFilterWhere(['like', 'fsc', $this->fsc])
            ->andFilterWhere(['like', 'qdbm', $this->qdbm]);

        return $dataProvider;
    }
}
