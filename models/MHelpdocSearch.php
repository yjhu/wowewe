<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MHelpdoc;

/**
 * MHelpdocSearch represents the model behind the search form about `app\models\MHelpdoc`.
 */
class MHelpdocSearch extends MHelpdoc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['helpdoc_id', 'sort', 'visual'], 'integer'],
            [['title', 'content', 'relate'], 'safe'],
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
        $query = MHelpdoc::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'helpdoc_id' => $this->helpdoc_id,
            'sort' => $this->sort,
            'visual' => $this->visual,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'relate', $this->relate]);

        return $dataProvider;
    }
}
