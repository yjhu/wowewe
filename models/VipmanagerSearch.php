<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vipmanager;

/**
 * VipmanagerSearch represents the model behind the search form about `app\models\Vipmanager`.
 */
class VipmanagerSearch extends Vipmanager
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vipmamnager_id', 'vip_id', 'manager_id'], 'integer'],
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
        $query = Vipmanager::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vipmamnager_id' => $this->vipmamnager_id,
            'vip_id' => $this->vip_id,
            'manager_id' => $this->manager_id,
        ]);

        return $dataProvider;
    }
}
