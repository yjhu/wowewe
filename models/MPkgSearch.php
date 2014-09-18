<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPkg;

class MPkgSearch extends Model
{
	public $cid;
	public $pkg3g4g;

	public function rules()
	{
		return [
			[['cid'], 'integer'],            
			[['pkg3g4g'], 'safe'],
		];
	}

	public function search($params)
	{
		$query = MPkg::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}
		$this->addCondition($query, 'cid');        
		$this->addCondition($query, 'pkg3g4g', true);
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
