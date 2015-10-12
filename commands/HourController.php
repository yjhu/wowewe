<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii hour
/usr/bin/php /mnt/wwwroot/wx/yii hour
0 * * * * /usr/bin/php /mnt/wwwroot/wx/yii hour
*/

namespace app\commands;

use Yii;
use yii\db\ActiveRecord;
use yii\console\Controller;

use app\models\U;
use app\models\MGh;
use app\models\MUser;

class HourController extends Controller
{
	public function actionIndex()
	{
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		if (!ini_set('memory_limit', '-1'))
			U::W("ini_set(memory_limit) error");    
		$time=microtime(true);	

		U::W("###########".__CLASS__." BEGIN");		
		
		self::refreshAccessToken();
                if (
                        date('H') == 10 ||
                        date('H') == 11 ||
                        date('H') == 16 ||
                        date('H') == 17 ||
                        date('H') == 20 
                ) {
                    if(date('H') == 11) {
                        self::smsMarketing(2);
                    } else {
                        self::smsMarketing(1);
                    }
                }

		U::W("###########".__CLASS__." END, (time: ".sprintf('%.3f', microtime(true)-$time)."s)");			
	}
        
        public static function smsMarketing($times = 1) {
            for ($i = 0; $i < $times; $i++)
                \app\models\SmsMarketingConfig::run();
        }

	public static function refreshAccessToken() 
	{
		$tableName = MGh::tableName();
		$gh_ids = Yii::$app->db->createCommand("SELECT gh_id FROM $tableName")->queryColumn();
		foreach($gh_ids as $gh_id)
		{
			Yii::$app->wx->clearGh();
			Yii::$app->wx->setGhId($gh_id);
			//U::W(['old', $gh_id, Yii::$app->wx->getAccessToken()]);			
			Yii::$app->wx->getAccessToken(true);
			//U::W(['new', $gh_id, Yii::$app->wx->getAccessToken()]);						
		}
	}
	
}

/*
		
*/		

