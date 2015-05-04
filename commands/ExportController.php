<?php

/*
yii export/heatmap <filename>
*/

namespace app\commands;

use Yii;

class ExportController extends \yii\console\Controller
{
    /**
     * This command import office supervision data.
     * @param string $filename the file to be imported to DB.
     */
    public function actionHeatmap($filename = 'heatmap.csv')
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'exported_data'.DIRECTORY_SEPARATOR.$filename;
        
        $heatmap_records = \app\models\HeatMap::find()
                ->where(['status' => \app\models\HeatMap::HEATMAP_VALID])
                ->all();
        
        $all_mobiles = array();
        $fh = fopen($file, "w");
        fprintf($fh, "用户微信昵称,用户手机号,是否员工,提交时间\n");
        foreach($heatmap_records as $heatmap) {
//            $staff = (!empty($heatmap->user->staff)) ? $heatmap->user->staff : $heatmap->user->mobileStaff;
            $staff = $heatmap->user->mobileStaff;
//            var_dump($staff);
            
            $mobiles = array();
            $bind_mobiles = $heatmap->user->openidBindMobiles;
            if (!empty($bind_mobiles)) {
                foreach( $bind_mobiles as $bind_mobile){
                    $mobiles[] = $bind_mobile->mobile;
                }
            }
            if (!empty(array_diff($mobiles, $all_mobiles))) {
                $all_mobiles = array_merge($all_mobiles, $mobiles);
                fprintf($fh, "%s,%s,%s,%s\n", 
                        $heatmap->user->nickname, 
                        "[".$heatmap->user->getBindMobileNumbersStr()."]", 
                        (!empty($staff)) ? "员工：{$staff->name}" : "否",
                        $heatmap->create_time
                        );
            }
        }
        fclose($fh);   
//        var_dump($all_mobiles);
    }
}
