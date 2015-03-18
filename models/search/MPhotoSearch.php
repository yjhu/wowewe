<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPhoto;

/**
 * MPhotoSearch represents the model behind the search form about `app\models\MPhoto`.
 */
class MPhotoSearch extends MPhoto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_id', 'sort_order'], 'integer'],
            [['title', 'pic_url', 'create_time'], 'safe'],
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
        $query = MPhoto::find()->where(['gh_id'=>Yii::$app->user->getGhid()])->orderBy('photo_id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'photo_id' => $this->photo_id,
            'sort_order' => $this->sort_order,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'pic_url', $this->pic_url]);

        return $dataProvider;
    }
}
