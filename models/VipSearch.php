<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vip;

/**
 * VipSearch represents the model behind the search form about `app\models\Vip`.
 */
class VipSearch extends Vip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'cat_val'], 'integer'],
            [['name', 'mobile', 'join_time', 'start_time', 'end_time'], 'safe'],
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
        $query = Vip::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vip_id' => $this->vip_id,
            'join_time' => $this->join_time,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'cat_val' => $this->cat_val,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
