<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii night
*/

namespace app\commands;

use Yii;
use yii\db\ActiveRecord;
use yii\console\Controller;

use app\models\U;
use app\models\MGh;
use app\models\MUser;
use app\models\MOrder;
use app\models\MMobnum;

class NightController extends Controller
{
	public function actionIndex()
	{
		set_time_limit(0);
		if (!ini_set('memory_limit', '-1'))
			U::W("ini_set(memory_limit) error");    
		$time=microtime(true);	

		U::W("###########".__CLASS__." BEGIN");		
		
		self::closeExpiredOrders();

		if (date('N') == 1)
		{
			U::W("Begin Weekly ...");	
			U::W("End Weekly ...");						
		}		

		if (date('j') == 1)
		{
			U::W("Begin Monthly ...");	

			$tableName = MOrder::tableName();
			Yii::$app->db->createCommand("OPTIMIZE TABLE $tableName")->execute();		
			U::W("OPTIMIZE TABLE $tableName");

			$tableName = MMobnum::tableName();
			Yii::$app->db->createCommand("OPTIMIZE TABLE $tableName")->execute();		
			U::W("OPTIMIZE TABLE $tableName");

			U::W("End Monthly ...");						
		}		

		U::W("###########".__CLASS__." END, (time: ".sprintf('%.3f', microtime(true)-$time)."s)");			
	}

	public static function closeExpiredOrders() 
	{

		$tableName = MOrder::tableName();
		$n = Yii::$app->db->createCommand()->update($tableName, ['status' => MOrder::STATUS_CLOSED_AUTO], 'status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 2 day)', [':status'=>MOrder::STATUS_AUTION])->execute();
		U::W("UPDATE $tableName, $n");		
		//move the unsuccessful orders exceed 90 days to bak table
		$n = Yii::$app->db->createCommand("INSERT INTO {$tableName}_arc SELECT * FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
		U::W("INSERT $tableName, $n");		
		$n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
		U::W("DELETE $tableName, $n");		

		//release mobile number
		$tableName = MMobnum::tableName();
		$n = Yii::$app->db->createCommand()->update($tableName, ['status' => MMobnum::STATUS_UNUSED], 'status=:status AND locktime < :locktime', [':status'=>MMobnum::STATUS_LOCKED, ':locktime'=>time()-2*24*3600])->execute();
		U::W("UPDATE $tableName, $n");	
		$n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status=:status", [':status'=>MMobnum::STATUS_USED])->execute();
		U::W("DELETE $tableName, $n");
	}
	
}

/*
		//$mobnums = Yii::$app->db->createCommand('SELECT select_mobnum FROM $tableName', [])->queryColumn();
		$query = new \yii\db\Query;
		$mobnums = $query->select('select_mobnum')->from($tableName)->where("select_mobnum != '' AND status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 2 day)", [':status'=>MOrder::STATUS_AUTION])->column();
		U::W($mobnums);

		if (!empty($mobnums))
		{
			// release mobile number
			
			$tableName = MMobnum::tableName();
			$mobnums_str = implode(",", $mobnums);
			$n = Yii::$app->db->createCommand()->update($tableName, ['status' => MMobnum::STATUS_UNUSED], 'num IN ( $mobnums_str ) AND status!=:status', [':status'=>MMobnum::STATUS_USED])->execute();
			U::W("UPDATE $tableName, $n");	

			$n = Yii::$app->db->createCommand()->update($tableName, ['status' => MMobnum::STATUS_UNUSED], 'status=:status AND locktime < :locktime)', [':status'=>MOrder::STATUS_LOCKED, ':locktime'=>time()-2*24*3600])->execute();
			U::W("UPDATE $tableName, $n");		
			$n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status=:status", [':status'=>MOrder::STATUS_OK])->execute();
			U::W("DELETE $tableName, $n");		

			//DELETE used mobile			
		}

		$n = Yii::$app->db->createCommand()->delete($tableName, 'status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)', [':status'=>MOrder::STATUS_OK])->execute();
		

		//move the used mobile number to bak table
		$n = Yii::$app->db->createCommand("INSERT INTO {$tableName}_arc SELECT * FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MMobnum::STATUS_USED])->execute();
		U::W("INSERT $tableName, $n");		
		$n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
		U::W("DELETE $tableName, $n");		

		$n = Yii::$app->db->createCommand()->delete($tableName, 'status=:status AND locktime < :locktime)', [':status'=>MOrder::STATUS_LOCKED, ':locktime'=>time()-2*24*3600])->execute();
		U::W("UPDATE $tableName, $n");		

		
*/		
