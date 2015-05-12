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

class ImportController extends Controller {

    /**
     * This command import office supervision data.
     * @param string $filename the file to be imported to DB.
     */
    public function actionSupervisor($filename = 'supervisor.csv') {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($file, "r");
        $i = 0;
        while (!feof($fh)) {
            $line = fgets($fh);
            $i++;
            if (empty($line))
                continue;
            $fields = explode(",", $line);
            $office_name = trim($fields[0]);
            $office_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $office_name);
            $msc_name = trim(trim($fields[1]), "0..9");
            $msc_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $msc_name);
            $region_name = trim(trim($fields[2]), "0..9");
            $region_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $region_name);
            $supervisor_name = trim($fields[3]);
            $supervisor_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $supervisor_name);
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
                $msc->region_id = $region->id;
                $msc->save(false);
            }

            $office = MOffice::findOne(['title' => $office_name_utf8]);
            if (empty($office)) {
                $office = new MOffice;
                $office->gh_id = \app\models\MGh::GH_XIANGYANGUNICOM; // 襄阳联通公共ID
                $office->title = $office_name_utf8;
                $office->is_jingxiaoshang = 1;
                $office->save(false);
            }
            if (empty($office->msc)) {
                yii::$app->db->createCommand()->insert('wx_rel_office_msc', [
                    'office_id' => $office->office_id,
                    'msc_id' => $msc->id,
                ])->execute();
                $msc->updateCounters(['office_total_count' => 1]);
                $region->updateCounters(['office_total_count' => 1]);
            }

            $staff = MStaff::findOne(['name' => $supervisor_name_utf8, 'gh_id' => \app\models\MGh::GH_XIANGYANGUNICOM]);
            if (empty($staff)) {
                $staff = new MStaff;
                $staff->office_id = 25;
                $staff->name = $supervisor_name_utf8;
                $staff->gh_id = \app\models\MGh::GH_XIANGYANGUNICOM; // 襄阳联通公共ID
                $staff->mobile = $supervisor_mobile;
                $staff->cat = 0;
                $staff->save(false);
            } else if ($staff->mobile != $supervisor_mobile) {
                $staff->updateAttributes(['mobile' => $supervisor_mobile]); // 修改员工电话
            }
            
            if (empty($staff->supervisedOffices) || empty($office->supervisor)) {
                yii::$app->db->createCommand()->insert('wx_rel_supervision_staff_office', [
                    'office_id' => $office->office_id,
                    'staff_id' => $staff->staff_id,
                ])->execute();
            } else if ($office->supervisor->staff_id != $staff->staff_id) {
                // 如果旧有的督导关系需要修改，先要删除原督导关系，再重新建立新的督导关系
                yii::$app->db->createCommand()->delete('wx_rel_supervision_staff_office', [
                    'office_id' => $office->office_id,
                    'staff_id' => $office->supervisor->staff_id,
                ])->execute();
                yii::$app->db->createCommand()->insert('wx_rel_supervision_staff_office', [
                    'office_id' => $office->office_id,
                    'staff_id' => $staff->staff_id,
                ])->execute();
            }
        }
        fclose($fh);
    }

    /**
     * This command import office supervision data.
     * @param string $filename the file to be imported to DB.
     */
    public function actionScorer($filename = 'scorer.csv') {
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($file, "r");
        $i = 0;
        while (!feof($fh)) {
            $line = fgets($fh);
            $i++;
            if (empty($line))
                continue;
            $fields = explode(",", $line);
            $scorer_name = trim($fields[0]);
            $scorer_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $scorer_name);
            $scorer_department = trim(trim($fields[1]), "0..9");
            $scorer_department_utf8 = iconv('GBK', 'UTF-8//IGNORE', $scorer_department);
            $scorer_position = trim(trim($fields[2]), "0..9");
            $scorer_position_utf8 = iconv('GBK', 'UTF-8//IGNORE', $scorer_position);
            $scorer_mobile = trim($fields[3]);

            $scorer = \app\models\MOfficeCampaignScorer::findOne(['name' => $scorer_name_utf8, 'mobile' => $scorer_mobile]);
            if (empty($scorer)) {
                $scorer = new \app\models\MOfficeCampaignScorer;
                $scorer->name = $scorer_name_utf8;
                $scorer->department = $scorer_department_utf8;
                $scorer->position = $scorer_position_utf8;
                $scorer->mobile = $scorer_mobile;
                $scorer->save(false);
            }
        }
        fclose($fh);
    }

    /**
     * This command import self-operated office data.
     * @param string $filename the file to be imported to DB.
     */
    public function actionSelfOperatedOffice($filename = 'self_operated_offices.csv') {
        
        Yii::$app->db->createCommand('UPDATE wx_office SET is_selfOperated=0')->execute();
        
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($file, "r");
        $i = 0;
        while (!feof($fh)) {
            $line = fgets($fh);
            $i++;
            if (empty($line))
                continue;
            $fields = explode(",", $line);
            $mr_name = trim($fields[0]);
            $mr_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $mr_name);
            $msc_name = trim($fields[1]);
            $msc_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $msc_name);
            $office_name = trim($fields[2]);
            $office_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $office_name);
            $director_name = trim($fields[3]);
            $director_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $director_name);
            $director_mobile = trim($fields[4]);

            $office = \app\models\MOffice::findOne(['title' => $office_name_utf8]);
            if (!empty($office)) {
                $in_msc = (new \yii\db\Query())->select('*')
                        ->from('wx_rel_office_msc')
                        ->where(['office_id' => $office->office_id])
                        ->count();
                if (!$in_msc) {
                    echo "{$office_name} does not belong to any msc." . PHP_EOL;
                    $msc = \app\models\MMarketingServiceCenter::findOne(['name' => $msc_name_utf8]);
                    if (!empty($msc)) {
                        yii::$app->db->createCommand()->insert('wx_rel_office_msc', [
                            'office_id' => $office->office_id,
                            'msc_id' => $msc->id,
                        ])->execute();
                    } else {
                        echo "can't find msc by name ({$msc_name})" . PHP_EOL;
                    }
                }
                $office->manager = $director_name_utf8;
                $office->mobile = $director_mobile;
                $office->is_selfOperated = 1;
                $office->save(false);
            } else {
                echo "can't find office by name ({$office_name})" . PHP_EOL;
            }
        }
        fclose($fh);
    }

}
