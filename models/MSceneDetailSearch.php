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

    public $scene_amt;
    
    public $memo;

    public $status;

    public $czhm;
    
    public $id;
    
    public function rules()
    {
        return [
            [['gh_id', 'scene_id','create_time', 'create_time_2', 'scene_amt', 'memo', 'status', 'czhm'], 'safe'],
        ];
    }

    public function search($params)
    {
        //$query = MSceneDetail::find()->where('scene_amt<0');
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

        $this->addCondition($query, 'scene_amt');
        $this->addCondition($query, 'memo', true);
        
        if (trim($this->create_time) !== '') 
        {
            $query->andWhere('date(create_time)>=:create_time', [':create_time' => $this->create_time]);
        }

        if (trim($this->create_time_2) !== '') 
        {
            $query->andWhere('date(create_time)<=:create_time_2', [':create_time_2' => $this->create_time_2]);
        }
        
        $this->addCondition($query, 'status');        

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
