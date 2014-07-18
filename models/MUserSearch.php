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
    
	public $username;
    
	public $password_raw;
    
	public $password_hash;
    
	public $password_reset_token;
    
	public $email;
    
	public $auth_key;
    
	public $role;
    
	public $status;
    
	public $create_time;
    
	public $update_time;

    public function rules()
    {
        return [
            [['id', 'role', 'status'], 'integer'],
            
			[['username', 'password_raw', 'password_hash', 'password_reset_token', 'email', 'auth_key', 'create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_raw' => 'Password Raw',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'role' => 'Role',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
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
        $this->addCondition($query, 'username', true);
        $this->addCondition($query, 'password_raw', true);
        $this->addCondition($query, 'password_hash', true);
        $this->addCondition($query, 'password_reset_token', true);
        $this->addCondition($query, 'email', true);
        $this->addCondition($query, 'auth_key', true);
        $this->addCondition($query, 'role');
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'create_time');
        $this->addCondition($query, 'update_time');
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
