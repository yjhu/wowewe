<?php

/*
yii import/supervior <filename>
*/

namespace app\commands;

use yii;
use yii\console\Controller;

use app\models\MOffice;
use app\models\MStaff;
use app\models\MMarketingRegion;
use app\models\MMarketingServiceCenter;
use app\models\MOfficeCampaignPicCategory;

class ImportController extends Controller
{
    /**
     * This command import office supervision data.
     * @param string $filename the file to be imported to DB.
     */
    public function actionSupervisor($filename = 'supervisor.csv')
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'imported_data'.DIRECTORY_SEPARATOR.$filename;
        $fh = fopen($file, "r");
        $i=0;
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            $i++;
            if (empty($line))
                continue;
//            $line = iconv('GBK','UTF-8//IGNORE', $line);
            $fields = explode(",", $line);    
            $office_name = trim($fields[0]);
            $office_name_utf8 = iconv('GBK','UTF-8//IGNORE', $office_name);
            $msc_name = trim(trim($fields[1]), "0..9");
            $msc_name_utf8 = iconv('GBK','UTF-8//IGNORE', $msc_name);
            $region_name = trim(trim($fields[2]), "0..9");
            $region_name_utf8 = iconv('GBK','UTF-8//IGNORE', $region_name);
            $supervisor_name = trim($fields[3]);
            $supervisor_name_utf8 = iconv('GBK','UTF-8//IGNORE', $supervisor_name);
            $supervisor_mobile = trim($fields[4]);
            
            $region = MMarketingRegion::findOne(['name' => $region_name_utf8]);
            if (empty($region)) {
                $region = new MMarketingRegion;
                $region->name = $region_name_utf8;
                $region->save();
            }
            
            $msc = MMarketingServiceCenter::findOne(['name' => $msc_name_utf8]);
            if (empty($msc)) {
                $msc = new MMarketingServiceCenter;
                $msc->name = $msc_name_utf8;
                $msc->region_id = $region -> id;
                $msc->save();
            }
            
            $office = MOffice::findOne(['title' => $office_name_utf8]);
            if (empty($office)) {                
//                echo ($i + 1) . $line;
                echo $i . "can't find office name: ".$office_name .PHP_EOL;
                continue;
            }
            if (empty($office->msc)) {
                yii::$app->db->createCommand()->insert('wx_rel_office_msc', [
                    'office_id' => $office->office_id,
                    'msc_id' => $msc->id,
                ]);
            }
            
            $staff = MStaff::findOne(['name' => $supervisor_name_utf8]);
            if (empty($staff)) {                
                echo ($i + 1) . $line;
                echo "can't find staff name: ".$supervisor_name;
                continue;
            }
            if (empty($staff->supervisedOffices) || empty($office->supervior)) {
                yii::$app->db->createCommand()->insert('wx_rel_supervision_staff_office', [
                    'office_id' => $office->office_id,
                    'staff_id' => $staff->staff_id,
                ]);
            }
        
        }
        fclose($fh);    
    }
}
