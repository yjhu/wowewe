<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MGh;

class MGhSearch extends Model
{
    public $gh_id;
    
    public function rules()
    {
        return [
//          [['id', 'gh_id', 'title','mobile', 'cat', 'status', 'level'], 'safe'],
            [['gh_id',], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MGh::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ],
            ],

            'pagination' => [
                'pageSize' => 20,
            ],            
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'gh_id', true);

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
