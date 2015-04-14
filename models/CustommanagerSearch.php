<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Custommanager;

/**
 * CustommanagerSearch represents the model behind the search form about `app\models\Custommanager`.
 */
class CustommanagerSearch extends Custommanager
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_manager_id', 'custom_id', 'manager_id'], 'integer'],
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
        $query = Custommanager::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'custom_manager_id' => $this->custom_manager_id,
            'custom_id' => $this->custom_id,
            'manager_id' => $this->manager_id,
        ]);

        return $dataProvider;
    }
}
