<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MHd201509t2;

/**
 * MHd201509t2Search represents the model behind the search form about `app\models\MHd201509t2`.
 */
class MHd201509t2Search extends MHd201509t2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hd201509t2_id', 'status'], 'integer'],
            [['gh_id', 'openid', 'mobile', 'create_time'], 'safe'],
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
        $query = MHd201509t2::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'hd201509t2_id' => $this->hd201509t2_id,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gh_id', $this->gh_id])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
