<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii refreshtoken
*/

namespace app\commands;

use yii\console\Controller;
use yii\db\Query;

use app\models\U;
use app\models\WX;
use app\models\MGh;

class RefreshTokenController extends Controller
{
	public function actionIndex()
	{	
/*	
		$db = \Yii::$app->db;
		$query = new Query();
		$tableName = MGh::tableName();
		$query->from($tableName);
		foreach ($query->each() as $owner)
		{
			$gh_id = $owner['gh_id'];
			$token = WX::getAccessToken($owner['appid'], $owner['appsecret']);			
			if (!isset($token['access_token']))
			{
				U::W([__FUNCTION__, $owner, $token]);
				continue;
			}
			$n = $db->createCommand()->update($tableName, ['access_token' => $token['access_token']], 'gh_id = :gh_id', [':gh_id'=>$gh_id])->execute();
		}
*/		
	}
}
