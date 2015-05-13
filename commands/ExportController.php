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
                ->all();

        $fh = fopen($file, "w");
        fprintf($fh, "用户微信昵称,用户手机号,是否员工,类型,金额,充值手机号码,时间\n");
        foreach ($useraccount_records as $useraccount_record) {
            $user = $useraccount_record->user;
            $staff = $user->staff;
            if (!empty($staff) && $staff->cat == \app\models\MStaff::SCENE_CAT_IN);
            else $staff = $user->mobileStaff;
            
            fprintf($fh, "%s,%s,%s,%s,%s,%s,%s\n", 
                    $user->nickname, 
                    "[" . $user->getBindMobileNumbersStr() . "]", 
                    (!empty($staff)) ? "员工：{$staff->name}" : "否", 
                    \app\models\MUserAccount::getCatOptionName($useraccount_record->cat),
                    intval($useraccount_record->amount/100),
                    $user->user_account_charge_mobile,
                    $useraccount_record->create_time
                    );
        }
        fclose($fh);
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
            $wx_count = \app\models\MUser::find()->where(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])->count();
            $wx_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->where(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();
            $wx_bound_count = $wx_count - $wx_bound_count;
            
            $wx_lastmonth_count = \app\models\MUser::find()->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
                    ->andWhere(['>=', 'create_time', $lastmonth_start])
                    ->andWhere(['<=', 'create_time', $lastmonth_end])
                    ->count();
            $wx_lastmonth_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $lastmonth_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastmonth_end])
                    ->andWhere(['wx_openid_bind_mobile.mobile' => null])
                    ->count();     
            $wx_lastmonth_bound_count = $wx_lastmonth_count - $wx_lastmonth_bound_count;
            
            $wx_lastweek_count = \app\models\MUser::find()->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
                    ->andWhere(['>=', 'wx_user.create_time', $lastweek_start])
                    ->andWhere(['<=', 'wx_user.create_time', $lastweek_end])
                    ->count();
            $wx_lastweek_bound_count = \app\models\MUser::find()->joinWith('openidBindMobiles')
                    ->andWhere(['scene_pid' => $office->getSceneids(), 'subscribe' => 1])
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
}
