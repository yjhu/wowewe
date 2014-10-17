<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOffice;

class MOfficeSearch extends Model
{
	public $gh_id;

	public $office_id;
	
	public $title;

	public $address;

	public $manager;

	public $mobile;

	public $visable;	

	public function rules()
	{
		return [
			[['gh_id', 'title','address', 'office_id', 'mobile', 'manager', 'visable'], 'safe'],
		];
	}

	public function search($params)
	{
		$query = MOffice::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'office_id' => SORT_ASC,
				]
			],

			'pagination' => [
				'pageSize' => 20,
			],            
		]);
		
		if (Yii::$app->user->identity->gh_id == 'root')
                 throw new NotFoundHttpException("Please selected one gh_id for the root first!");		
		else if (Yii::$app->user->identity->openid == 'admin')
		{
			$this->gh_id = Yii::$app->user->identity->gh_id;
			$this->addCondition($query, 'gh_id');		
		}
		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'office_id');					
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'mobile', true);
		$this->addCondition($query, 'address', true);
		$this->addCondition($query, 'manager', true);
		$this->addCondition($query, 'visable');		
		
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
