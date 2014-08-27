<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MUser;

/**
 * MUserSearch represents the model behind the search form about `\app\models\MUser`.
 */
class MUserSearch extends Model
{
	public $id;

	public $nickname;

	public $role;

	public $status;

	public $create_time;

	public $update_time;

	public $scene_id;
	
	public $scene_pid;
	
	public function rules()
	{
		return [
			[['id', 'role', 'status'], 'integer'],
			[['nickname', 'create_time', 'update_time', 'scene_id', 'scene_pid'], 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'nickname' => '昵称',
			'email' => 'Email',
			'auth_key' => 'Auth Key',
			'role' => 'Role',
			'status' => '状态',
			'create_time' => '关注时间',
			'update_time' => '更新时间',
		];
	}

	public function search($params)
	{
		$query = MUser::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}
		$this->addCondition($query, 'id');
		$this->addCondition($query, 'nickname', true);
		$this->addCondition($query, 'role');
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'create_time');
		$this->addCondition($query, 'update_time');
		$this->addCondition($query, 'scene_pid');        
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
