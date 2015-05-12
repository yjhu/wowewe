<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOfficeCampaignDetail;

/**
 * MOfficeCampaignDetailSearch represents the model behind the search form about `app\models\MOfficeCampaignDetail`.
 */
class MOfficeCampaignDetailSearch extends MOfficeCampaignDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'office_id', 'pic_category'], 'integer'],
            [['pic_url', 'created_time'], 'safe'],
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
        $query = MOfficeCampaignDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'office_id' => $this->office_id,
            'pic_category' => $this->pic_category,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'pic_url', $this->pic_url]);

        return $dataProvider;
    }
}
