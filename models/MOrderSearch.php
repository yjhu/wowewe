<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOrder;

class MOrderSearch extends Model
{
	public $oid;

	public $status;

	public $create_time;

	public $title;

	public $cid;

	public $detail;	

	public $feesum;		

	public function rules()
	{
		return [
			[['status', 'cid'], 'integer'],            
			[['oid','create_time', 'title', 'detail', 'feesum'], 'safe'],
		];
	}

    public function search($params)
    {
        $query = MOrder::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'oid', true);
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'detail', true);
        $this->addCondition($query, 'feesum');
        $this->addCondition($query, 'cid');        
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
