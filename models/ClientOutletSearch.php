<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClientOutlet;

/**
 * ClientOutletSearch represents the model behind the search form about `\app\models\ClientOutlet`.
 */
class ClientOutletSearch extends ClientOutlet
{
    public $msc_id = 1;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['outlet_id', 'client_id', 'supervision_organization_id', 'category', 'original_office_id'], 'integer'],
            [['title', 'address', 'telephone', 'pics', 'msc_id'], 'safe'],
            [['longitude', 'latitude'], 'number'],
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
        $query = ClientOutlet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);
        
        \Yii::warning(__METHOD__ . \yii\helpers\Json::encode($params));
        
        \Yii::warning(__METHOD__ . \yii\helpers\Json::encode($this));

        $this->load($params);
        
        \Yii::warning(__METHOD__ . \yii\helpers\Json::encode($this));

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'outlet_id' => $this->outlet_id,
            'client_id' => $this->client_id,
            'supervision_organization_id' => $this->supervision_organization_id,
            'category' => $this->category,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'original_office_id' => $this->original_office_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'pics', $this->pics]);
        
        $query->andFilterWhere([
            'supervision_organization_id' => ClientOrganization::findOne(['organization_id' => $this->msc_id])->getMscIdArray(),
        ]);

        \Yii::warning(__METHOD__ . \yii\helpers\Json::encode($query));
        return $dataProvider;
    }
}
