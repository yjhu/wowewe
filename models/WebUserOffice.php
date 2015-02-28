<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

class WebUserOffice extends \yii\web\User
{
    public function getIsOffice($checkSession = true)
    {
		if ($this->isGuest)
			return false;
		return $this->identity->role >= \app\models\MOffice::ROLE_OFFICE ? true : false;
    }

    public function getIsAdmin($checkSession = true)
    {
		if ($this->isGuest)
			return false;
		return $this->identity->role >= \app\models\MOffice::ROLE_ADMIN ? true : false;
    }

    public function getIsRoot($checkSession = true)
    {
		if ($this->isGuest)
			return false;
		return $this->identity->role >= \app\models\MOffice::ROLE_ROOT ? true : false;
    }

    public function getGhid()
    {
		return Yii::$app->user->identity->gh_id;
    }

}
