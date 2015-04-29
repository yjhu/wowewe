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
                $region->save(false);
            }
            
            $msc = MMarketingServiceCenter::findOne(['name' => $msc_name_utf8]);
            if (empty($msc)) {
                $msc = new MMarketingServiceCenter;
                $msc->name = $msc_name_utf8;
                $msc->region_id = $region -> id;
                $msc->save(false);
            }
            
            $office = MOffice::findOne(['title' => $office_name_utf8]);
            if (empty($office)) {                
                $office = new MOffice;
                $office->gh_id = 'gh_03a74ac96138'; // 襄阳联通公共ID
                $office->title = $office_name_utf8;
                $office->is_jingxiaoshang = 1;
                $office->save(false);
            }
            if (empty($office->msc)) {
                yii::$app->db->createCommand()->insert('wx_rel_office_msc', [
                    'office_id' => $office->office_id,
                    'msc_id' => $msc->id,
                ])->execute();
            }
            
            $staff = MStaff::findOne(['name' => $supervisor_name_utf8]);
            if (empty($staff)) {                
                $staff = new MStaff;
                $staff->office_id = 25;
                $staff->name = $supervisor_name_utf8;
                $staff->gh_id = 'gh_03a74ac96138'; // 襄阳联通公共ID
                $staff->mobile = $supervisor_mobile;
                $staff->cat = 0;
                $staff->save();
            }
            if (empty($staff->supervisedOffices) || empty($office->supervisor)) {
                yii::$app->db->createCommand()->insert('wx_rel_supervision_staff_office', [
                    'office_id' => $office->office_id,
                    'staff_id' => $staff->staff_id,
                ])->execute();
            }
        
        }
        fclose($fh);   
    }
}
