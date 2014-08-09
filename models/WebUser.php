<?php

namespace app\models;

use Yii;

class WebUser extends \yii\web\User
{
    public function getIsOffice($checkSession = true)
    {
		if ($this->isGuest)
			return false;
		return $this->identity->role >= \app\models\MUser::ROLE_OFFICE ? true : false;
    }

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

    public function getGhid()
    {
		if (Yii::$app->user->identity->gh_id == 'root')
		{
			U::W('root has no gh_id!');
			throw new NotFoundHttpException('root has no gh_id');			
		}
		else
			return Yii::$app->user->identity->gh_id;
    }

}
