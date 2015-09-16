<?php

namespace app\models; 

use Yii; 
use yii\base\Model; 
use yii\data\ActiveDataProvider; 
use app\models\MGoods; 

/** 
 * MGoodsSearch represents the model behind the search form about `app\models\MGoods`. 
 */ 
class MGoodsSearch extends MGoods 
{ 
    /** 
     * @inheritdoc 
     */ 
    public function rules() 
    { 
        return [ 
            [['goods_id', 'price', 'price_old', 'quantity', 'goods_kind', 'office_ctrl', 'package_ctrl', 'detail_ctrl', 'pics_ctrl'], 'integer'],
            [['title', 'descript', 'price_hint', 'price_old_hint', 'detail', 'list_img_url', 'body_img_url', 'goods_kind'], 'safe'],
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
        $query = MGoods::find(); 

        $dataProvider = new ActiveDataProvider([ 
            'query' => $query, 
        ]); 

        if (!($this->load($params) && $this->validate())) { 
            return $dataProvider; 
        } 

        $query->andFilterWhere([
            'goods_id' => $this->goods_id,
            'price' => $this->price,
            'price_old' => $this->price_old,
            'quantity' => $this->quantity,
            'office_ctrl' => $this->office_ctrl,
            'package_ctrl' => $this->package_ctrl,
            'detail_ctrl' => $this->detail_ctrl,
            'pics_ctrl' => $this->pics_ctrl,
            'goods_kind' => $this->goods_kind,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'descript', $this->descript])
            ->andFilterWhere(['like', 'price_hint', $this->price_hint])
            ->andFilterWhere(['like', 'price_old_hint', $this->price_old_hint])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'list_img_url', $this->list_img_url])
            ->andFilterWhere(['like', 'body_img_url', $this->body_img_url]);

        return $dataProvider; 
    } 
} 