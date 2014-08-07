<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MStaff;

class MStaffSearch extends Model
{
	public $name;

	public $mobile;

	public $office_id;

	public function rules()
	{
		return [
			[['name','mobile', 'office_id'], 'safe'],
		];
	}

	public function search($params)
	{
		$query = MStaff::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'staff_id' => SORT_ASC,
				]
			],

			'pagination' => [
				'pageSize' => 20,
			],            
		]);
/*
		$gh_id = Yii::$app->user->identity->gh_id;
		if (Yii::$app->user->identity->gh_id == 'root')
		if (is_numeric(Yii::$app->user->identity->openid))
*/			
		
		if (!($this->load($params) && $this->validate())) {
			//$this->addCondition($query, 'oid', true);		
			return $dataProvider;
		}

		$this->addCondition($query, 'office_id');
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'mobile', true);
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
