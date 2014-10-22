<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MSceneDetail;

class MSceneDetailSearch extends Model
{
    public $gh_id;
    
    public $scene_id;
    
    public $create_time;

    public $create_time_2;    

    public $amount;
    
    public $memo;
    
    public function rules()
    {
        return [
            [['gh_id', 'scene_id','create_time', 'create_time_2', 'amount', 'memo'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MSceneDetail::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],            
        ]);
        
        $this->addCondition($query, 'gh_id');
        $this->addCondition($query, 'scene_id');

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'amount');
        $this->addCondition($query, 'memo', true);
        
        if (trim($this->create_time) !== '') 
        {
            $query->andWhere('date(create_time)>=:create_time', [':create_time' => $this->create_time]);
        }

        if (trim($this->create_time_2) !== '') 
        {
            $query->andWhere('date(create_time)<=:create_time_2', [':create_time_2' => $this->create_time_2]);
        }
        
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
    
}