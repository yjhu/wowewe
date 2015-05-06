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

}
