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
use app\models\MSceneDay;
use app\models\MStaff;
use app\models\MAccessLog;
use app\models\MUserAccount;
use app\models\sm\ESms;
use app\models\sm\ESmsGuodu;

class NightController extends Controller {

    public function actionIndex() {
        set_time_limit(0);
        if (!ini_set('memory_limit', '-1'))
            U::W("ini_set(memory_limit) error");
        $time = microtime(true);
        $yesterday = date("Y-m-d", strtotime("-1 day"));
        //$yesterday = '2014-11-02';    

        $theFirstDayOfLastMonth = U::getFirstDayOfLastMonth();
        $theLastDayOfLastMonth = U::getLastDayOfLastMonth();

        U::W("###########" . __CLASS__ . " BEGIN");

        /*
          self::addRecommendFanAmount($theFirstDayOfLastMonth, $theLastDayOfLastMonth);
          return;
         */
        /*
          self::statSceneDay($yesterday);
          return;
         */

        /*
          $time = time();
          for($i=180;$i>0;$i--) {
          $yesterday = date("Y-m-d",strtotime("-{$i} day", $time));
          self::statSceneDay($yesterday);
          }
          return;
         */

        self::confirmSceneDetail();

        self::closeExpiredOrders();

        self::statSceneDay($yesterday);

        //MDisk::updateAll(['cnt' => 3]);
        $tableName = MDisk::tableName();
        $n = MDisk::deleteAll();
        U::W("DELETE $tableName, $n");

        if (date('N') == 1) {
            U::W("Begin Weekly ...");
            U::W("End Weekly ...");
        }

        if (date('j') == 1) {
            U::W("Begin Monthly ...");

            $tableName = MOrder::tableName();
            Yii::$app->db->createCommand("OPTIMIZE TABLE $tableName")->execute();
            U::W("OPTIMIZE TABLE $tableName");

            $tableName = MMobnum::tableName();
            Yii::$app->db->createCommand("OPTIMIZE TABLE $tableName")->execute();
            U::W("OPTIMIZE TABLE $tableName");

            U::W("End Monthly ...");
        }

//        if (date('j') == 1) {
        {
//            U::W("on 1st every month, add recommending fans fee of last month for user ...");
            $start_date = '2015-04-01';
            $end_date = date("Y-m-d", strtotime("-1 month"));
            U::W("NightController::addRecommendFanAmount runs [".$start_date.", ".$end_date.']');
            self::addRecommendFanAmount($theFirstDayOfLastMonth, $theLastDayOfLastMonth);
        }

        self::checkSmBalance();

        U::W("###########" . __CLASS__ . " END, (time: " . sprintf('%.3f', microtime(true) - $time) . "s)");
    }

    public static function closeExpiredOrders() {
        $tableName = MOrder::tableName();
        
        $n = Yii::$app->db->createCommand()->delete($tableName, 'status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 2 day)', [':status' => MOrder::STATUS_DRAFT])->execute();
        U::W("UPDATE $tableName, $n --- 系统删除2天前的僵死订单。");
        
        // auto close the orders exceed 2 days
        $n = Yii::$app->db->createCommand()->update($tableName, ['status' => MOrder::STATUS_SYSTEM_CLOSED], 'status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 2 day)', [':status' => MOrder::STATUS_SUBMITTED])->execute();
        U::W("UPDATE $tableName, $n --- 系统自动关闭超时2天的提交订单。");
        
        $n = Yii::$app->db->createCommand()->update($tableName, ['status' => MOrder::STATUS_SYSTEM_SUCCEEDED], 'status=:status AND create_time < DATE_SUB(NOW(), INTERVAL 2 day)', [':status' => MOrder::STATUS_FULFILLED])->execute();
        U::W("UPDATE $tableName, $n --- 系统自动确认超时2天的已办理订单。");

        /* 		
          //move the unsuccessful orders exceed 90 days to bak table
          $n = Yii::$app->db->createCommand("INSERT INTO {$tableName}_arc SELECT * FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
          U::W("INSERT $tableName, $n");

          $n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status!=:status AND create_time < DATE_SUB(NOW(), INTERVAL 90 day)", [':status'=>MOrder::STATUS_OK])->execute();
          U::W("DELETE $tableName, $n");
         */
        //release mobile number
        $tableName = MMobnum::tableName();
        $n = Yii::$app->db->createCommand()->update($tableName, ['status' => MMobnum::STATUS_UNUSED, 'locktime' => 0], 'status=:status AND locktime < :locktime', [':status' => MMobnum::STATUS_LOCKED, ':locktime' => time() - 2 * 24 * 3600])->execute();
        U::W("UPDATE $tableName, $n");

        $n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE status=:status", [':status' => MMobnum::STATUS_USED])->execute();
        U::W("DELETE $tableName, $n");
    }

    public static function confirmSceneDetail() {
        $tableName = MSceneDetail::tableName();
        $query = (new Query())->from($tableName)->where("status=:status AND scene_amt>0", [':status' => MSceneDetail::STATUS_INIT]);
        $amt = 0;
        foreach ($query->each() as $row) {
            if ($row['cat'] == MSceneDetail::CAT_FAN) {
                if (empty($row['openid_fan']))
                    continue;

                $fan = MUser::findOne(['gh_id' => $row['gh_id'], 'openid' => $row['openid_fan']]);
                if ($fan === null)
                    continue;

                if ($fan->isActivedFan()) {
                    U::W('ACTIVE id=' . $row['id']);
                    $model = MSceneDetail::findOne($row['id']);
                    $model->status = MSceneDetail::STATUS_CONFIRMED;
                    if ($model->save(false)) {
                        $user = MUser::findOne(['gh_id' => $row['gh_id'], 'openid' => $row['openid']]);
                        U::W("SAVE BALANCE1 " . $user->scene_balance);

                        $user->scene_balance += $model->scene_amt;
                        U::W("SAVE BALANCE2 " . $user->scene_balance);
                        $user->scene_balance_time = date("Y-m-d H:i:s");
                        $user->save(false);
                    }
                } else {
                    U::W('NO ACTIVE id=' . $row['id']);
                }
            } else if ($row['cat'] == MSceneDetail::CAT_SIGN) {
                U::W('ACTIVE id=' . $row['id']);
                $model = MSceneDetail::findOne($row['id']);
                $model->status = MSceneDetail::STATUS_CONFIRMED;
                if ($model->save(false)) {
                    $user = MUser::findOne(['gh_id' => $row['gh_id'], 'openid' => $row['openid']]);
                    U::W("SAVE CAT_SIGN BALANCE1 " . $user->scene_balance);

                    $user->scene_balance += $model->scene_amt;
                    U::W("SAVE CAT_SIGN BALANCE2 " . $user->scene_balance);
                    $user->scene_balance_time = date("Y-m-d H:i:s");
                    $user->save(false);
                }
            }
        }
    }

    public static function statSceneDay($date) {
        U::W(__METHOD__ . " BEGIN");
        $tableName = MSceneDay::tableName();
        $ghs = MGh::find()->all();
        foreach ($ghs as $gh) {
            foreach ($gh->staffs as $staff) {
                if ($staff->scene_id != 0) {
                    $score = MAccessLog::getScoreByRange($gh->gh_id, $staff->scene_id, $date, $date);
                    if ($score != 0) {
                        Yii::$app->db->createCommand("INSERT INTO $tableName (gh_id,create_date,scene_id,score) VALUES (:gh_id,:create_date,:scene_id,:score)", [':gh_id' => $gh->gh_id, ':create_date' => $date, ':scene_id' => $staff->scene_id, ':score' => $score])->execute();
                    }
                }
            }

            // for the fan without anyboby's recommend
            $staff = new MStaff();
            $staff->scene_id = 0;
            $score = MAccessLog::getScoreByRange($gh->gh_id, $staff->scene_id, $date, $date);
            if ($score != 0) {
                Yii::$app->db->createCommand("INSERT INTO $tableName (gh_id,create_date,scene_id,score) VALUES (:gh_id,:create_date,:scene_id,:score)", [':gh_id' => $gh->gh_id, ':create_date' => $date, ':scene_id' => $staff->scene_id, ':score' => $score])->execute();
            }
        }
        U::W(__METHOD__ . " END");
        return;

        /*
          $tableName = MAccessLog::tableName();
          $n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE create_time < DATE_SUB(NOW(), INTERVAL 90 day)")->execute();
          U::W("DELETE $tableName, $n");

          $tableName = MAccessLogAll::tableName();
          $n = Yii::$app->db->createCommand("DELETE FROM $tableName WHERE create_time < DATE_SUB(NOW(), INTERVAL 180 day)")->execute();
          U::W("DELETE $tableName, $n");
         */
    }

    public static function addRecommendFanAmount($date_start, $date_end) {
        U::W(__METHOD__ . " BEGIN from $date_start, $date_end");
//        $tableName = MSceneDay::tableName();
        $ghs = MGh::find()->all();
        foreach ($ghs as $gh) {
            if ($gh->gh_id !== MGh::GH_XIANGYANGUNICOM) {
                continue;
            }
            foreach ($gh->staffs as $staff) {
                if ($staff->scene_id != 0 && 
                        ($staff->cat == MStaff::SCENE_CAT_OUT || $staff->cat == MStaff::SCENE_CAT_FAN) && 
                        !empty($staff->openid)) {
                    $real_score = MAccessLog::getRealScoreByRange($gh->gh_id, $staff->scene_id, $date_start, $date_end);
                    if ($real_score > 0) {
                        //$amount = intval($real_score) * 100;                        
                        //$amount = intval($real_score/3) * 500;
                        $amount = intval($real_score) * 500;
                        if ($amount > 0) {
                            $model = new MUserAccount;
                            $model->gh_id = $staff->gh_id;
                            $model->openid = $staff->openid;
                            $model->scene_id = $staff->scene_id;
                            $model->cat = MUserAccount::CAT_DEBIT_FAN;
                            $model->amount = $amount;
                            $model->memo = '推荐粉丝';
                            $model->save(false);
//                            U::W("SAVE OK, scene_id={$staff->scene_id}, openid={$staff->openid}, amount={$model->amount}");
                        }
                    } else {
//                        U::W("scene_id={$staff->scene_id}, openid={$staff->openid}, realscore={$real_score}, ");
                    }
                } else {
//                    U::W("scene_id={$staff->scene_id}, openid={$staff->openid}");
                }
            }
        }
        U::W(__METHOD__ . " END");
        return;
    }

    public function actionUserAccount() {
        $theFirstDayOfLastMonth = U::getFirstDayOfLastMonth();
        $theLastDayOfLastMonth = U::getLastDayOfLastMonth();
        self::addRecommendFanAmount($theFirstDayOfLastMonth, $theLastDayOfLastMonth);
        return;
    }

    public static function checkSmBalance() 
    {
        $balance = ESmsGuodu::B(false);
        if ($balance < 1000) {
            $model = MUser::findOne(['gh_id' => MGh::GH_XIANGYANGUNICOM, 'openid' => MGh::GH_XIANGYANGUNICOM_OPENID_KZENG]);
            try {
                $model->sendSmAlert($balance);
            } catch (\Exception $e) {
                U::W($e->getCode().':'.$e->getMessage());
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

            //$query = (new Query()) ->from($tableName)->where("cat=:cat AND status=:status AND openid_fan != '' AND scene_amt>0", [':cat'=>MSceneDetail::CAT_FAN, ':status'=>MSceneDetail::STATUS_INIT]);

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
*/	

