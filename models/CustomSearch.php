<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Custom;

/**
 * CustomSearch represents the model behind the search form about `app\models\Custom`.
 */
class CustomSearch extends Custom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_id', 'is_vip', 'office_id', 'vip_level_id'], 'integer'],
            [['mobile', 'name', 'vip_join_time', 'vip_start_time', 'vip_end_time'], 'safe'],
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
        $query = Custom::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!Yii::$app->user->getIsAdmin()) {
            $this->office_id = Yii::$app->user->identity->office_id;
            $query->andFilterWhere([
                'office_id' => $this->office_id,
            ]);            
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'custom_id' => $this->custom_id,
            'is_vip' => $this->is_vip,
            'office_id' => $this->office_id,
            'vip_level_id' => $this->vip_level_id,
//            'vip_join_time' => $this->vip_join_time,
//            'vip_start_time' => $this->vip_start_time,
//            'vip_end_time' => $this->vip_end_time,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

/*
    public function search1($params)
    {
        $query = Custom::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['openidBindMobile']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'custom_id' => $this->custom_id,
            'is_vip' => $this->is_vip,
            'office_id' => $this->office_id,
            'vip_level_id' => $this->vip_level_id,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'name', $this->name]);


        return $dataProvider;
    }
*/    
}
