<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lookup;

/**
 * LookupSearch represents the model behind the search form about `app\models\Lookup`.
 */
class LookupSearch extends Lookup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lookup_id', 'cat', 'cat_val', 'sort_order'], 'integer'],
            [['name'], 'safe'],
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
        $query = Lookup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'lookup_id' => $this->lookup_id,
            'cat' => $this->cat,
            'cat_val' => $this->cat_val,
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
