<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OpenidBindMobile;

/**
 * OpenidBindMobileSearch represents the model behind the search form about `app\models\OpenidBindMobile`.
 */
class OpenidBindMobileSearch extends OpenidBindMobile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid_bind_mobile_id'], 'integer'],
            [['gh_id', 'openid', 'mobile'], 'safe'],
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
        $query = OpenidBindMobile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([
            'gh_id' => $this->gh_id,
            'openid' => $this->openid,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
