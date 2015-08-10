<?php

/*
  yii export/heatmap <filename>
 */

namespace app\commands;

use Yii;

class ExportController extends \yii\console\Controller {

    /**
     * This command export heatmap result data.
     * @param string $filename the file to be imported to DB.
     */
    public function actionHeatmap($filename = 'heatmap.csv') {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;

        $heatmap_records = \app\models\HeatMap::find()
                ->where(['status' => \app\models\HeatMap::HEATMAP_VALID])
                ->all();

        $all_mobiles = array();
        $fh = fopen($file, "w");
        fprintf($fh, "用户微信昵称,用户手机号,是否员工,提交时间\n");
        foreach ($heatmap_records as $heatmap) {
            $user = $heatmap->user;
            $staff = $user->staff;
            if (!empty($staff) && $staff->cat == \app\models\MStaff::SCENE_CAT_IN);
            else $staff = $user->mobileStaff;

            $mobiles = array();
            $bind_mobiles = $user->openidBindMobiles;
            if (!empty($bind_mobiles)) {
                foreach ($bind_mobiles as $bind_mobile) {
                    $mobiles[] = $bind_mobile->mobile;
                }
            }
            if (!empty(array_diff($mobiles, $all_mobiles))) {
                $all_mobiles = array_merge($all_mobiles, $mobiles);
                fprintf($fh, "%s,%s,%s,%s\n", 
                        $user->nickname, 
                        "[" . $user->getBindMobileNumbersStr() . "]", 
                        (!empty($staff)) ? "员工：{$staff->name}" : "否", 
                        $heatmap->create_time
                );
            }
        }
        fclose($fh);
//        var_dump($all_mobiles);
    }

    /**
     * This command export user account data.
     * @param string $filename the file to be exported to.
     */
    public function actionUserAccount($filename = 'user-account.csv') {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;

        $useraccount_records = \app\models\MUserAccount::find()
                ->where(['cat' => \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE])
                ->andWhere(['status' => \app\models\MUserAccount::STATUS_CHARGE_REQUEST])
                ->all();

        $fh = fopen($file, "w");
        fprintf($fh, "充值手机号码,充值金额,申请时间\n");
        foreach ($useraccount_records as $useraccount_record) {            
            fprintf($fh, "%s,%s,%s\n", 
                    $useraccount_record->charge_mobile,
                    intval($useraccount_record->amount/100),
                    $useraccount_record->create_time
                    );
            $useraccount_record->updateAttributes([
                'status'    => \app\models\MUserAccount::STATUS_CHARGE_PROCESSING,
            ]);
        }
        fclose($fh);
        echo "总共".count($useraccount_records)."条充值申请！".PHP_EOL;
    }
    
    /**
     * This command export user account data.
     * @param string $filename the file to be exported to.
     */
    public function actionSupervisor($filename = 'supervisor.csv') {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;

        $staffs = \app\models\MStaff::find()
                ->all();

        $fh = fopen($file, "w");
        fprintf($fh, "督导员姓名,督导员手机号,管理门店名,门店所属营服中心,门店所属区县\n");
        foreach ($staffs as $staff) {
            $supervised_offices = $staff->supervisedOffices;
            if (!$supervised_offices) continue;
            foreach($supervised_offices as $supervised_office) {
                if ($supervised_office->is_selfOperated) continue;
                fprintf($fh, "%s,%s,%s,%s,%s\n",
                        $staff->name, $staff->mobile, $supervised_office->title, 
                        $supervised_office->msc->name,
                        $supervised_office->msc->marketingRegion->name
                        );
            }            
        }
        fclose($fh);
    }

    /**
     * This command export fans and customers data about all self-operated offices.
     * @param string $filename the file to be exported to.
     */
    public function actionSelfOperatedOffices($filename = 'self-operated-offices.csv') {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;

        $offices = \app\models\MOffice::findAll(['is_selfOperated' => 1]);
        
        $lastmonth_start = \app\models\U::getFirstDayOfLastMonth();
        $lastmonth_end = \app\models\U::getLastDayOfLastMonth();
        $weekday = date('w');
        $lastweek_start = date('Y-m-d', strtotime('-'.($weekday + 7).' days'))." 00:00:00";
        $lastweek_end = date('Y-m-d', strtotime('-'.($weekday + 1).' days'))." 23:59:59";
        
        $fh = fopen($file, "w");
        fprintf($fh, "自营厅名称,粉丝总数量,绑定手机粉丝总数量,上月（%s）发展粉丝数量,上月（%s）发展绑定手机粉丝数量,上周（%s）发展粉丝数量,上周（%s）发展绑定手机粉丝数量,归属客户总数量,已微信关联客户数量,上月（%s）关联客户数量,上周（%s）关联客户数量\n",
                date('Y-m', strtotime($lastmonth_start)),
                date('Y-m', strtotime($lastmonth_start)),
                date('Y-m-d', strtotime($lastweek_start))."至".date('Y-m-d', strtotime($lastweek_end)),
                date('Y-m-d', strtotime($lastweek_start))."至".date('Y-m-d', strtotime($lastweek_end)),
                date('Y-m', strtotime($lastmonth_start)),
                date('Y-m-d', strtotime($lastweek_start))."至".date('Y-m-d', strtotime($lastweek_end))
                );
        foreach ($offices as $office) {
//            $wx_count = \app\models\MUser::find()->where(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])->count();
//            $wx_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
//                    ->where(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
//                    ->count();
            $wx_count = \app\models\MUser::find()->where(['belongto' => $office->office_id, 'subscribe' => 1])->count();
            $wx_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->where(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_bound_count = $wx_count - $wx_bound_count;
            
//            $wx_lastmonth_count = \app\models\MUser::find()->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'create_time', $lastmonth_start])
//                    ->andWhere(['<=', 'create_time', $lastmonth_end])
//                    ->count();
//            $wx_lastmonth_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
//                    ->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
//                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
//                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
//                    ->count();
            $wx_lastmonth_count = \app\models\MUser::find()->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'create_time', $lastmonth_start])
                    ->andWhere(['<=', 'create_time', $lastmonth_end])
                    ->count();
            $wx_lastmonth_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_lastmonth_bound_count = $wx_lastmonth_count - $wx_lastmonth_bound_count;
            
//            $wx_lastweek_count = \app\models\MUser::find()->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
//                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
//                    ->count();
//            $wx_lastweek_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
//                    ->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
//                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
//                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
//                    ->count();
            $wx_lastweek_count = \app\models\MUser::find()->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
                    ->count();
            $wx_lastweek_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_lastweek_bound_count = $wx_lastweek_count - $wx_lastweek_bound_count;
            $customer_count = \app\models\Custom::find()->where(['office_id' => $office->office_id])->count();
            $customer_bound_count = \app\models\Custom::find()->joinWith('openidBindMobile')
                    ->where(['office_id' => $office->office_id])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $customer_bound_count = $customer_count - $customer_bound_count;
            $customer_lastmonth_bound_count = \app\models\Custom::find()->joinWith('openidBindMobile.user')
                    ->where(['office_id' => $office->office_id])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
                    ->count();
            $customer_lastweek_bound_count = \app\models\Custom::find()->joinWith('openidBindMobile.user')
                    ->where(['office_id' => $office->office_id])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
                    ->count();
            fprintf($fh, "%s", $office->title . 
                    ", ".$wx_count . ", " . $wx_bound_count . 
                    ", ".$wx_lastmonth_count . ", " . $wx_lastmonth_bound_count . 
                    ", ".$wx_lastweek_count . ", " . $wx_lastweek_bound_count . 
                    ", ".$customer_count . ", " . $customer_bound_count . ", " . $customer_lastmonth_bound_count . ", " . $customer_lastweek_bound_count . 
                    PHP_EOL);     
        }
        fclose($fh);
    }
    
    public function actionOfficeCampaignRanking( $date = null, $is_selfOpearted = 1, $filename = 'office-campaign-results.csv' ) {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;
        if ($date == null) {
            $date = date('Y-m-d');
        }
        $results = \app\models\MOfficeCampaignScore::getScoreRanking($is_selfOpearted, $date);
        $fh = fopen($file, "w");
        foreach ($results as $result) {
            $office = \app\models\MOffice::findOne(['office_id' => $result['office_id']]);
            fprintf($fh, "%s, %.2f".PHP_EOL, $office->title, $result['score']);
        }
        fclose($fh);
    }
    
    public function actionSelfOwnedOutlets( $date = null, $is_selfOperated = 1, $filename = 'self-owned-outlets.csv' ) {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;

        $offices = \app\models\MOffice::findAll(['is_selfOperated' => $is_selfOperated]);
        
        if ($date == null) {
            $date = date('Y-m-d');
        }
        
        $lastmonth_start    = date('Y-m-01', strtotime('-1 month', strtotime($date)))." 00:00:00";
        $lastmonth_end      = date('Y-m-d', strtotime('-1 month', strtotime($date)))." 23:59:59";
        $thismonth_start    = date('Y-m-01', strtotime($date))." 00:00:00";
        $thismonth_end      = date('Y-m-d', strtotime($date))." 23:59:59";;        
        
//        $lastmonth_start = \app\models\U::getFirstDayOfLastMonth();
//        $lastmonth_end = date('Y-m-d', strtotime('-1 month', strtotime('yesterday')))." 23:59:59";;
//        $thismonth_start = \app\models\U::getFirstDate(date('Y'), date('m'));
//        $thismonth_end = date('Y-m-d', strtotime('yesterday'))." 23:59:59";
        
        $fh = fopen($file, "w");
        //fprintf($fh, "自营厅名称,粉丝总数量,绑定手机粉丝总数量,上月（%s）同期发展粉丝数量,上月（%s）同期发展绑定手机粉丝数量,本月（%s）发展粉丝数量,本月（%s）发展绑定手机粉丝数量,归属客户总数量,已微信关联客户数量,上月（%s）同期关联客户数量,本月（%s）关联客户数量\n",
        //绑定手机粉丝总数量 == 会员总数量
        fprintf($fh, "自营厅名称,累计粉丝量（从发展到现在）,会员总数量, 本月新增会员, 上月（%s）同期发展粉丝数量,(%s)新用户发展同比,%s月新增粉丝量,(%s)新用户发展量,归属客户总数量,已微信关联客户数量,(%s)维系用户同比,%s维系用户发展量, 发展业务量\n",
                date('Y-m', strtotime($lastmonth_start)),
                date('Y-m', strtotime($lastmonth_start)),
                date('Y-m-d', strtotime($thismonth_start))."至".date('Y-m-d', strtotime($thismonth_end)),
                date('Y-m-d', strtotime($thismonth_start))."至".date('Y-m-d', strtotime($thismonth_end)),
                date('Y-m', strtotime($lastmonth_start)),
                date('Y-m-d', strtotime($thismonth_start))."至".date('Y-m-d', strtotime($thismonth_end))
                );
        foreach ($offices as $office) {
//            $wx_count = \app\models\MUser::find()->where(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])->count();
//            $wx_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
//                    ->where(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
//                    ->count();
            $wx_count = \app\models\MUser::find()->where(['belongto' => $office->office_id, 'subscribe' => 1])->count();

            $order_count = \app\models\MOrder::find()->where(['office_id' => $office->office_id])
                    ->andWhere(['>=', 'create_time', $thismonth_start])
                    ->andWhere(['<=', 'create_time', $thismonth_end])
                    ->count();

            $wx_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->where(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_bound_count = $wx_count - $wx_bound_count;
            
            $wx_bound_thismonth_count = \app\models\MUser::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['belongto' => $office->office_id, 'subscribe' => 1])                    
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>', 'subscribe_time', strtotime($thismonth_start)])
                    ->andWhere(['<', 'subscribe_time', strtotime($thismonth_end)])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();

//            $wx_lastmonth_count = \app\models\MUser::find()->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'create_time', $lastmonth_start])
//                    ->andWhere(['<=', 'create_time', $lastmonth_end])
//                    ->count();
//            $wx_lastmonth_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
//                    ->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
//                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
//                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
//                    ->count();
            $wx_lastmonth_count = \app\models\MUser::find()->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'create_time', $lastmonth_start])
                    ->andWhere(['<=', 'create_time', $lastmonth_end])
                    ->count();
            $wx_lastmonth_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_lastmonth_bound_count = $wx_lastmonth_count - $wx_lastmonth_bound_count;
            
//            $wx_lastweek_count = \app\models\MUser::find()->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
//                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
//                    ->count();
//            $wx_lastweek_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
//                    ->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
//                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
//                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
//                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
//                    ->count();
            $wx_lastweek_count = \app\models\MUser::find()->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $thismonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $thismonth_end])
                    ->count();
            $wx_lastweek_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->andWhere(['belongto' => $office->office_id, 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $thismonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $thismonth_end])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_lastweek_bound_count = $wx_lastweek_count - $wx_lastweek_bound_count;
            $customer_count = \app\models\Custom::find()->where(['office_id' => $office->office_id])->count();
            $customer_bound_count = \app\models\Custom::find()->joinWith('openidBindMobile')
                    ->where(['office_id' => $office->office_id])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $customer_bound_count = $customer_count - $customer_bound_count;
            $customer_lastmonth_bound_count = \app\models\Custom::find()->joinWith('openidBindMobile.user')
                    ->where(['office_id' => $office->office_id])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
                    ->count();
            $customer_lastweek_bound_count = \app\models\Custom::find()->joinWith('openidBindMobile.user')
                    ->where(['office_id' => $office->office_id])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>=', 'wx_user.create_time', $thismonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $thismonth_end])
                    ->count();
            fprintf($fh, "%s", $office->title . 
                    ", ".$wx_count . ", " . $wx_bound_count .  ", ".$wx_bound_thismonth_count .
                    ", ".$wx_lastmonth_count . ", " . $wx_lastmonth_bound_count . 
                    ", ".$wx_lastweek_count . ", " . $wx_lastweek_bound_count . 
                    ", ".$customer_count . ", " . $customer_bound_count . ", " . $customer_lastmonth_bound_count . ", " . $customer_lastweek_bound_count . ", " . $order_count .
                    PHP_EOL);     
        }
        fclose($fh);
    }
    
    public function actionOpenidBindMobiles( $filename = 'openid-bind-mobiles.csv', $date = null ) {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, 'w');
        if (null === $date) {
            $date = \app\models\U::getFirstDate(date('Y'), date('m'));
        }

        $total_count = \app\models\OpenidBindMobile::find()->where(['>', 'create_time', $date])->count();

        $step = 3000;
        $start = 0;

        while ($start < $total_count) {

            $openidBindMobiles = \app\models\OpenidBindMobile::find()->offset($start)->limit($step)->where([
                '>', 'create_time', $date
            ])->orderBy([
                'create_time' => SORT_ASC,
            ])->all();

            foreach($openidBindMobiles as $mobile) {
            	//微信昵称	绑定手机号	关注时间

                //fprintf($fh, "%s, %s, %s, %s, %s", $mobile->mobile, $mobile->create_time, $mobile->province, $mobile->city, $mobile->carrier);
                //fprintf($fh, ", %s", $mobile->user->nickname);

                $user = \app\models\MUser::findOne(['openid' => $mobile->openid]);
                if (empty($user)) {
                	printf(\yii\helpers\Json::encode($mobile));
                	continue;
                } else {
                	$office = \app\models\MOffice::findOne(['office_id' => $user->belongto]);
            	}

    			if ($user->bindMobileIsInside('wx_t1')) {
    				$customerFlag = '老';
    				//$flag1 = 1;
    			} elseif ($user->bindMobileIsInside('wx_t2')) {
    				$customerFlag = '老';
    			}elseif ($user->bindMobileIsInside('wx_t3')) {
    				$customerFlag = '老';
    			} else {
    				//$flag1 = 0;
    				$customerFlag = '新';
    			}

    			//微信昵称	绑定手机号	关注时间	姓名	营业厅名称	新/老用户	客户经理	
                fprintf($fh, "%s, %s, %s, %s, %s, %s, %s",
    				$mobile->user->nickname, 
    				$mobile->mobile, 
    				$mobile->create_time, 
    				'', 
    				$customerFlag,
    				empty($office) ? "主号" : $office->title,
    				''
                 );

                fprintf($fh, PHP_EOL);
            }

            $start += $step;
        }
        fclose($fh);
    }
    


	/*
	    ***请求接口，返回JSON数据
	    ***@url:接口地址
	    ***@params:传递的参数
	    ***@ispost:是否以POST提交，默认GET
	*/
	public function juhecurl($url,$params=false,$ispost=0){
	    $httpInfo = array();
		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_0 );
		curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
		curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
		if( $ispost )
		{
			curl_setopt( $ch , CURLOPT_POST , true );
			curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
			curl_setopt( $ch , CURLOPT_URL , $url );
		}
		else
		{
			if($params){
				curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
			}else{
				curl_setopt( $ch , CURLOPT_URL , $url);
			}
		}
		$response = curl_exec( $ch );
		if ($response === FALSE) {
			#echo "cURL Error: " . curl_error($ch);
			return false;
		}
		$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
		$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
		curl_close( $ch );
		return $response;
	}

    public function actionOpenidBindMobilesWithLocation( $filename = 'openid-bind-mobiles-with-location.csv', $date = null ) {
		
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, 'w');
        if (null === $date) {
            $date = \app\models\U::getFirstDate(date('Y'), date('m'));
        }

        $total_count = \app\models\OpenidBindMobile::find()->where(['>', 'create_time', $date])->count();

        $step = 3000;
        $start = 0;

        while ($start < $total_count) {
        	//$fans = \app\models\MUser::find()->offset($start)->limit($step)->all();
            
        	$openidBindMobiles = \app\models\OpenidBindMobile::find()->offset($start)->limit($step)->where([
				'>', 'create_time', $date
			])->orderBy([
				'create_time' => SORT_ASC,
			])->all();

	        foreach($openidBindMobiles as $mobile) {
	        	//微信昵称	绑定手机号	关注时间
	            $user = \app\models\MUser::findOne(['openid' => $mobile->openid]);
	            if (empty($user)) {
	            	printf(\yii\helpers\Json::encode($mobile));
	            	continue;
	            } else {
	            	$office = \app\models\MOffice::findOne(['office_id' => $user->belongto]);
	        	}

                fprintf($fh, "%s, %s, %s, %s, %s, %s, %s, %s, %s, %s", 
                $mobile->user->nickname, 
                $mobile->mobile, 
                $mobile->create_time, 
                empty($office) ? "主号" : $office->title,
                $mobile->province,
                $mobile->city,
                $mobile->areacode,
                $mobile->zip,
                $mobile->carrier,
                $mobile->cardtype);
                fprintf($fh, PHP_EOL);
	        }
        	$start += $step;
        }
        fclose($fh);
    }
    

    public function actionJfdh( $filename = 'jfdh.csv', $date = null ) {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, 'w');
        if (null === $date) {
            $date = \app\models\U::getFirstDate(date('Y'), date('m'));
        }
        $jfdhLogs = \app\models\MAccessLogAll::find()->where([
            '>', 'create_time', $date
        ])->andWhere([
            'MsgType' =>    'event',
            'Event'   =>    'VIEW',
            'EventKey'  =>  'http://jf.10010.com',
        ])->orderBy([
            'create_time' => SORT_ASC,
        ])->all();
        
        foreach ($jfdhLogs as $log) {
            $fan = \app\models\MUser::findOne([
                'gh_id'     => $log->ToUserName,
                'openid'    => $log->FromUserName,
            ]);
            fprintf($fh, "%s, %s, %s\n", $fan->nickname, implode(';', $fan->bindMobileNumbers), $log->create_time);
        }
        fclose($fh);
    }

    public function actionFans( $filename = 'fans.csv') {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, 'w');
       // if (null === $date) {
       //     $date = \app\models\U::getFirstDate(date('Y'), date('m'));
       // }
        $total_count = \app\models\MUser::find()->count();
        $step = 3000;
        $start = 0;

        while ($start < $total_count) {
        	$fans = \app\models\MUser::find()->offset($start)->limit($step)->all();
        
	        foreach ($fans as $fan) {

	            fprintf($fh, "%s, %s, %s, %s, %s, %s\n", $fan->nickname, $fan->country, $fan->province, $fan->city, implode(';', $fan->bindMobileNumbers), date('Y-m-d H:i:s', $fan->subscribe_time));
	        }

        	$start += $step;
        }
        
        fclose($fh);
    }


    //《关于公司员工及代理商关注微平台情况通报0514.xlsx》导出最新绑定情况
    public function actionEmployeebind($filename = 'employeebind.csv')
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'employeebind.txt';
        $fh = fopen($file, "r");

        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'exported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh1 = fopen($filepathname, 'w');

        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $arr = explode("\t", $line);     
            $custom_mobile = trim($arr[0]);
           
            $custom = \app\models\OpenidBindMobile::findOne(['mobile'=>$custom_mobile]);
            if (!empty($custom)) {
				fprintf($fh1, "%s, %s \n", $custom_mobile, '是');
            }
            else 
            {
                fprintf($fh1, "%s, %s \n", $custom_mobile, '否');
            }
        }
        fclose($fh1);
        fclose($fh);    
    }


    
}

