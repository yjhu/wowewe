<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii night
/usr/bin/php /mnt/wwwroot/wx/yii night
0 1 * * * /usr/bin/php /mnt/wwwroot/wx/yii night
*/

namespace app\commands;

use Yii;
use yii\db\ActiveRecord;
use yii\console\Controller;
use yii\db\Query;

use app\models\U;
use app\models\MGh;
use app\models\MUser;
use app\models\MOrder;
use app\models\MMobnum;
use app\models\MDisk;
use app\models\MSceneDetail;

class NightController extends Controller
{
	public function actionIndex()
	{
		set_time_limit(0);
		if (!ini_set('memory_limit', '-1'))
			U::W("ini_set(memory_limit) error");    
		$time=microtime(true);	

		U::W("###########".__CLASS__." BEGIN");		

		self::confirmSceneDetail();

		self::closeExpiredOrders();

		//MDisk::updateAll(['cnt' => 3]);
		$tableName = MDisk::tableName();
		$n = MDisk::deleteAll();
		U::W("DELETE $tableName, $n");	

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
		// auto close the orders exceed 2 days
		$n = Yii::$app->db->createCommand()->update($tableName, ['status' => MOrder::STATUS_CLOSED_AUTO], 'status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 2 day)', [':status'=>MOrder::STATUS_AUTION])->execute();
		U::W("UPDATE $tableName, $n");		

/*		
		//move the unsuccessful orders exceed 90 days to bak table
		$n = Yii::$app->db->createCommand("INSERT INTO {$tableName}_arc SELECT * FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
		U::W("INSERT $tableName, $n");		
		
		$n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
		U::W("DELETE $tableName, $n");		
*/
		//release mobile number
		$tableName = MMobnum::tableName();
		$n = Yii::$app->db->createCommand()->update($tableName, ['status' => MMobnum::STATUS_UNUSED, 'locktime' => 0], 'status=:status AND locktime < :locktime', [':status'=>MMobnum::STATUS_LOCKED, ':locktime'=>time()-2*24*3600])->execute();
		U::W("UPDATE $tableName, $n");	
		
		$n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status=:status", [':status'=>MMobnum::STATUS_USED])->execute();
		U::W("DELETE $tableName, $n");
	}

	public static function confirmSceneDetail() 
	{
            $tableName = MSceneDetail::tableName();	
            $query = (new Query()) ->from($tableName)->where("cat=:cat AND status=:status AND openid_fan != '' AND scene_amt>0", [':cat'=>MSceneDetail::CAT_FAN, ':status'=>MSceneDetail::STATUS_INIT]);
            $amt = 0;
            foreach ($query->each() as $row)
            {                
                $fan = MUser::findOne(['gh_id'=>$row['gh_id'], 'openid'=>$row['openid_fan']]);
                if ($fan === null)
                    continue;
                
                if ($fan->isActivedFan())
                {
                    U::W('ACTIVE id='.$row['id']);
                    $model = MSceneDetail::findOne($row['id']);
                    $model->status = MSceneDetail::STATUS_CONFIRMED;
                    if ($model->save(false))
                    {
                        $user = MUser::findOne(['gh_id'=>$row['gh_id'], 'openid'=>$row['openid']]);
                        U::W("SAVE BALANCE1 ".$user->scene_balance);
                        
                        $user->scene_balance += $model->scene_amt;
                        U::W("SAVE BALANCE2 ".$user->scene_balance);                        
                        $user->scene_balance_time = date("Y-m-d H:i:s");
                        $user->save(false);
                    }
                }
                else
                {
                    U::W('NO ACTIVE id='.$row['id']);                
                }
            }	


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

		
            $models = MSceneDetail::findAll("cat=:cat AND status=:status AND openid_fan != '' AND scene_amt>0", [':cat'=>MSceneDetail::CAT_FAN, ':status'=>MSceneDetail::STATUS_INIT]);
            foreach ($models as $model)
            {
                $user = MUser::findOne(['gh_id'=>$row['gh_id'], 'openid'=>$row['openid_fan']]);
                if ($user === null)
                    continue;
                if ($user->isActivedFan())
                {
                    
                }
                
            }	
*/            

