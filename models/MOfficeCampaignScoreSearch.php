<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOfficeCampaignScore;

/**
 * MOfficeCampaignScoreSearch represents the model behind the search form about `app\models\MOfficeCampaignScore`.
 */
class MOfficeCampaignScoreSearch extends MOfficeCampaignScore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'office_campaign_id', 'staff_id', 'score'], 'integer'],
            [['created_time'], 'safe'],
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
        $query = MOfficeCampaignScore::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'office_campaign_id' => $this->office_campaign_id,
            'staff_id' => $this->staff_id,
            'score' => $this->score,
            'created_time' => $this->created_time,
        ]);

        return $dataProvider;
    }
}
