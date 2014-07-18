<?php

namespace app\models;

use Yii;

class WebUser extends \yii\web\User
{
    public function getIsAdmin($checkSession = true)
    {
		if ($this->isGuest)
			return false;
		return $this->identity->role >= \app\models\MUser::ROLE_ADMIN ? true : false;
    }

    public function getIsRoot($checkSession = true)
    {
		if ($this->isGuest)
			return false;
		return $this->identity->role >= \app\models\MUser::ROLE_ROOT ? true : false;
    }

}
