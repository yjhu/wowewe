<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\MGh;
use app\models\MUser;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public $gh_id = MGh::GH_XIANGYANGUNICOM;
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) 
        {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } 
        else 
        {
            return false;
        }
    }

	public function getUser()
	{
		if ($this->_user === false) 
		{
			//$this->_user = MUser::findByUsername($this->username);
			if ($this->username == 'root')
				$this->_user = MUser::findOne(['gh_id'=>$this->username, 'openid' => $this->username]);			
			else if ($this->username == 'admin')
				$this->_user = MUser::findOne(['gh_id'=>$this->gh_id, 'openid' => $this->username]);						
			else
				$this->_user = MUser::findOne(['gh_id'=>$this->gh_id, 'nickname' => $this->username]);
		}
		return $this->_user;
	}
     
    
}

/*     
    public function getUser()
    {
        if ($this->_user === false) 
        {
            $this->_user = MUser::findByUsername($this->username);
        }
        return $this->_user;
    }
*/

