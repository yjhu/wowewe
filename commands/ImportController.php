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
            if (empty($line) || trim($line) == '')
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
            $comment = trim($fields[5]);
            $comment_utf8 = iconv('GBK', 'UTF-8//IGNORE', $comment);
//            echo "comment = ".$comment.", comment_utf8 = ".$comment_utf8.PHP_EOL;
            $need2delete = false;
            if (mb_strpos($comment_utf8, '删除') === false);
            else $need2delete = true;
            
            if ($need2delete) {
//                echo "deleting ......".PHP_EOL;
                if (!empty($office_name_utf8) && $office_name_utf8 != '') {
                   $office = MOffice::findOne(['title' => $office_name_utf8, 'gh_id' => \app\models\MGh::GH_XIANGYANGUNICOM]);
                   if (!empty($office)) {
                        // 删除督导关系
//                       echo "deleting supervision relation ...".$office->title.PHP_EOL;
                        yii::$app->db->createCommand()->delete('wx_rel_supervision_staff_office', [
                            'office_id' => $office->office_id,
                        ])->execute();
                        // 删除营服所属关系
                        if (!empty($office->msc)) {
//                            echo "deleting MSC/MR relation ...".$office->title.PHP_EOL;
                            $office->msc->updateCounters(['office_total_count' => -1]);
                            $office->msc->marketingRegion->updateCounters(['office_total_count' => -1]);
                            if ($office->msc->marketingRegion->office_total_count == 0)
                                $office->msc->marketingRegion->delete();
                            if ($office->msc->office_total_count == 0)
                                $office->msc->delete();
                            yii::$app->db->createCommand()->delete('wx_rel_office_msc', [
                                'office_id' => $office->office_id,
                            ])->execute();
                        }
                   }
               }
               continue;
            }
            
            if (empty($region_name_utf8) || $region_name_utf8 == '') continue;
            $region = MMarketingRegion::findOne(['name' => $region_name_utf8]);
            if (empty($region)) {
                $region = new MMarketingRegion;
                $region->name = $region_name_utf8;
                $region->save(false);
            }

            if (empty($msc_name_utf8) || $msc_name_utf8 == '') continue;
            $msc = MMarketingServiceCenter::findOne(['name' => $msc_name_utf8]);
            if (empty($msc)) {
                $msc = new MMarketingServiceCenter;
                $msc->name = $msc_name_utf8;
                $msc->region_id = $region->id;
                $msc->save(false);
            }

            if (empty($office_name_utf8) || $office_name_utf8 == '') continue;
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

            if (empty($supervisor_name_utf8) || $supervisor_name_utf8 == '') continue;
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

    public function actionTjylCharge($filename = 'tjyl-charge.csv') {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, "r");
        while (!feof($fh)) {
            $line = trim(fgets($fh));
            if (empty($line) || strlen($line) == 0) continue;
            $fields = explode(",", $line);
            $charge_mobile = trim($fields[0]);
            $charge_ammount = trim($fields[1]);
            if (empty($charge_ammount) || strlen($charge_ammount)==0 || $charge_ammount == 0) continue;
            if (empty($charge_mobile) || strlen($charge_mobile)==0 || strlen($charge_mobile) != 11) continue;
            $wx_user = \app\models\MUser::findOne(['user_account_charge_mobile' => $charge_mobile]);
            if (!empty($wx_user)) {
                echo $wx_user->nickname ." mobile ".$charge_mobile." charged ".$charge_ammount.PHP_EOL;
                $user_account = new \app\models\MUserAccount;
                $user_account->gh_id = $wx_user->gh_id;
                $user_account->openid = $wx_user->openid;
                $user_account->scene_id = $wx_user->staff->scene_id;
                $user_account->cat = \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE;
                $user_account->amount = - $charge_ammount * 100;
                $user_account->memo = "推荐有礼";
                $user_account->charge_mobile = $charge_mobile;
                $user_account->save(false);
//                Yii::$app->db->createCommand()->insert('wx_user_account', [
//                            'gh_id' => $wx_user->gh_id,
//                            'openid' => $wx_user->openid,
//                            'scene_id' => $wx_user->staff->scene_id,
//                            'cat' => \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE,
//                            'amount' => - $charge_ammount * 100,
//                            'memo' => "推荐有礼",
//                            'charge_mobile' => $charge_mobile,
//                        ])->execute();
            } else {
                echo "can't find charge mobile ".$charge_mobile . "({$charge_ammount})".PHP_EOL;
            }
        }
        fclose($fh);
    }
    
    public function actionCs4gCharge($filename = 'cs4g-charge.csv') {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, "r");
        while (!feof($fh)) {
            $line = trim(fgets($fh));
            if (empty($line) || strlen($line) == 0) continue;
            $fields = explode(",", $line);
        }
        fclose($fh);
    }
}
