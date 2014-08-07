<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOrder;

class MOrderSearch extends Model
{
	public $gh_id;

	public $office_id;
	
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
			[['office_id', 'status', 'cid'], 'integer'],            
			[['gh_id', 'oid','create_time', 'title', 'detail', 'feesum'], 'safe'],
		];
	}

	public function search($params)
	{
		$query = MOrder::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					//'name' => SORT_ASC,
					'oid' => SORT_DESC
				]
			],
			'pagination' => [
				'pageSize' => 20,
			],            
		]);

		if (Yii::$app->user->identity->gh_id == 'root')
			U::W('root see order');
		else if (Yii::$app->user->identity->openid == 'admin')
		{
			$this->gh_id = Yii::$app->user->identity->gh_id;
			$this->addCondition($query, 'gh_id');		
		}
		else if (is_numeric(Yii::$app->user->identity->openid))
		{
			$this->gh_id = Yii::$app->user->identity->gh_id;
			$this->office_id = Yii::$app->user->identity->openid;
			$this->addCondition($query, 'gh_id');		
			$this->addCondition($query, 'office_id');					
		}
		
		if (!($this->load($params) && $this->validate())) {
			//$this->addCondition($query, 'oid', true);		
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
