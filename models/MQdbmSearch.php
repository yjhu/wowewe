<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MQdbm;

/**
 * MQdbmSearch represents the model behind the search form about `app\models\MQdbm`.
 */
class MQdbmSearch extends MQdbm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qdbm_id'], 'integer'],
            [['gsyf', 'qdmc', 'qdbm', 'blank'], 'safe'],
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
        $query = MQdbm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'qdbm_id' => $this->qdbm_id,
        ]);

        $query->andFilterWhere(['like', 'gsyf', $this->gsyf])
            ->andFilterWhere(['like', 'qdmc', $this->qdmc])
            ->andFilterWhere(['like', 'qdbm', $this->qdbm])
            ->andFilterWhere(['like', 'blank', $this->blank]);

        return $dataProvider;
    }
}
