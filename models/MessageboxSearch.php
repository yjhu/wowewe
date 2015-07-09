<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Messagebox;

/**
 * MessageboxSearch represents the model behind the search form about `app\models\Messagebox`.
 */
class MessageboxSearch extends Messagebox
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg_id', 'receiver_type', 'receiver'], 'integer'],
            [['title', 'content', 'author'], 'safe'],
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
        $query = Messagebox::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'msg_id' => $this->msg_id,
            'receiver_type' => $this->receiver_type,
            'receiver' => $this->receiver,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
