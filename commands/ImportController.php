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
    public function init()
    {        
        Yii::$app->getUrlManager()->setBaseUrl('/wx/web/index.php');
        Yii::$app->getUrlManager()->setHostInfo('http://wosotech.com');
        Yii::$app->getUrlManager()->setScriptUrl('/wx/web/index.php');
        //Yii::$app->getUrlManager()->setHostInfo('http://wosotech.com');
        //Yii::$app->wx->setGhId(MGh::GH_HOYA);
        
        //Yii::$app->wx->setGhId(MGh::GH_WOSO);
        Yii::$app->wx->setGhId(\app\models\MGh::GH_XIANGYANGUNICOM);
    }

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
            $supervisor_mobile = trim(isset($fields[4]) ? $fields[4] : '');
            $comment = trim(isset($fields[5]) ? $fields[5] : '');
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
//                $region = new MMarketingRegion;
//                $region->name = $region_name_utf8;
//                $region->save(false);
                echo "{$region_name_utf8} 不存在。".PHP_EOL;
                continue;
            }

            if (empty($msc_name_utf8) || $msc_name_utf8 == '') continue;
            $msc = MMarketingServiceCenter::findOne(['name' => $msc_name_utf8]);
            if (empty($msc)) {
//                $msc = new MMarketingServiceCenter;
//                $msc->name = $msc_name_utf8;
//                $msc->region_id = $region->id;
//                $msc->save(false);
                echo "{$msc_name_utf8} 不存在。".PHP_EOL;
                continue;
            }

            if (empty($office_name_utf8) || $office_name_utf8 == '') continue;
            $office = MOffice::findOne(['title' => $office_name_utf8]);
            if (empty($office)) {
//                $office = new MOffice;
//                $office->gh_id = \app\models\MGh::GH_XIANGYANGUNICOM; // 襄阳联通公共ID
//                $office->title = $office_name_utf8;
//                $office->is_jingxiaoshang = 1;
//                $office->save(false);
                echo "{$office_name_utf8} 不存在。".PHP_EOL;
                continue;
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
//            if (empty($staff)) {
//                $staff = new MStaff;
//                $staff->office_id = 25;
//                $staff->name = $supervisor_name_utf8;
//                $staff->gh_id = \app\models\MGh::GH_XIANGYANGUNICOM; // 襄阳联通公共ID
//                $staff->mobile = $supervisor_mobile;
//                $staff->cat = 0;
//                $staff->save(false);
//            } else if ($staff->mobile != $supervisor_mobile) {
//                $staff->updateAttributes(['mobile' => $supervisor_mobile]); // 修改员工电话
//            }
            if (empty($staff) && empty($supervisor_mobile)) {
                echo "{$supervisor_name_utf8} 不在数据库中。".PHP_EOL;
                continue;
            } else if (empty($staff)) {
                $staff = new MStaff;
                $staff->office_id = 25;
                $staff->name = $supervisor_name_utf8;
                $staff->gh_id = \app\models\MGh::GH_XIANGYANGUNICOM; // 襄阳联通公共ID
                $staff->mobile = $supervisor_mobile;
                $staff->cat = 0;
                $staff->save(false);
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
        $xyunicom = \app\models\WosoClient::findOne(['title_abbrev' => '襄阳联通']);
        if (empty($xyunicom)) die('不能找到襄阳联通。');        
        
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
            $address = trim($fields[5]);
            $address_utf8 = iconv('GBK', 'UTF-8//IGNORE', $address);
            $telephone = trim($fields[6]);
            
            $organization = \app\models\ClientOrganization::find()->where([
                'client_id' => $xyunicom->client_id,
            ])->andWhere([
                'like', 'title', $msc_name_utf8
            ])->one();
            if (empty($organization)) {
                die("can't find organization: {$msc_name_utf8}");
            }

            $outlet = \app\models\ClientOutlet::findOne([
                'client_id' => $xyunicom->client_id,
                'title'     => $office_name_utf8,
            ]);
            if (empty($outlet)) {
                $outlet = new \app\models\ClientOutlet;
                $outlet->client_id  = $xyunicom->client_id;
                $outlet->title      = $office_name_utf8;
                $outlet->address    = $address_utf8;
                $outlet->telephone  = $telephone;
                $outlet->category   = \app\models\ClientOutlet::CATEGORY_SELFOWNED;
                $outlet->supervison_organization_id = $organization->organization_id;
                $outlet->save(false);
            }                       
        }
        fclose($fh);
    }

    public function actionBlendedOutlet($filename = 'blended-outlet.csv') {
        $xyunicom = \app\models\WosoClient::findOne(['title_abbrev' => '襄阳联通']);
        if (empty($xyunicom)) die('不能找到襄阳联通。');        
        
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
            $address = trim($fields[5]);
            $address_utf8 = iconv('GBK', 'UTF-8//IGNORE', $address);
            $telephone = trim($fields[6]);
            
            $organization = \app\models\ClientOrganization::find()->where([
                'client_id' => $xyunicom->client_id,
            ])->andWhere([
                'like', 'title', $msc_name_utf8
            ])->one();
            if (empty($organization)) {
                die("can't find organization: {$msc_name_utf8}");
            }

            $outlet = \app\models\ClientOutlet::findOne([
                'client_id' => $xyunicom->client_id,
                'title'     => $office_name_utf8,
            ]);
            if (empty($outlet)) {
                $outlet = new \app\models\ClientOutlet;
                $outlet->client_id  = $xyunicom->client_id;
                $outlet->title      = $office_name_utf8;
                $outlet->address    = $address_utf8;
                $outlet->telephone  = $telephone;
                $outlet->category   = \app\models\ClientOutlet::CATEGORY_BLENDED;
                $outlet->supervison_organization_id = $organization->organization_id;
                $outlet->save(false);
            } 
            
            $employee = \app\models\ClientEmployee::findOne([
                'client_id'     => $xyunicom->client_id,
                'name'          => $director_name_utf8,
            ]);
            if (empty($employee)) {
                $employee = new \app\models\ClientEmployee;
                $employee->client_id = $xyunicom->client_id;
                $employee->name      = $director_name_utf8;
                $employee->save(false);
            }
            
            if (!in_array($director_mobile, $employee->mobiles)) {
                \Yii::$app->db->createCommand()->insert('client_employee_mobile', [
                    'employee_id'   => $employee->employee_id,
                    'mobile'        => $director_mobile,
                ])->execute();
            }
            
            $row = (new \yii\db\Query())->select('*')->from('client_employee_outlet')->where([
                'employee_id'   => $employee->employee_id,
                'outlet_id'     => $outlet->outlet_id,
            ])->one();
            if (false === $row) {
                \Yii::$app->db->createCommand()->insert('client_employee_outlet', [
                    'employee_id'   => $employee->employee_id,
                    'outlet_id'     => $outlet->outlet_id,
                    'position'      => '班长',
                ])->execute();
            }
        }
        fclose($fh);
    }
    
    public function actionSelfOwnedOutlet($filename = 'self-owned-outlet.csv') {
        $xyunicom = \app\models\WosoClient::findOne(['title_abbrev' => '襄阳联通']);
        if (empty($xyunicom)) die('不能找到襄阳联通。');        
        
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($file, "r");
        $i = 0;
        while (!feof($fh)) {
            $line = fgets($fh);
            $i++;
            if (empty($line))
                continue;
            $fields = explode(",", $line);          
            $outlet_title = trim($fields[1]);
            $outlet_title_utf8 = iconv('GBK', 'UTF-8//IGNORE', $outlet_title);
            $employee_name = trim($fields[2]);
            $employee_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $employee_name);
            $position = trim($fields[3]);
            $position_utf8 = iconv('GBK', 'UTF-8//IGNORE', $position);
            $mobile = trim($fields[5]);                       

            $outlet = \app\models\ClientOutlet::findOne([
                'client_id' => $xyunicom->client_id,
                'title'     => $outlet_title_utf8,
            ]);
            if (empty($outlet)) {
                die("can't find outlet: {$outlet_title_utf8}");
            }
            
            $employee = \app\models\ClientEmployee::findOne([
                'client_id' => $xyunicom->client_id,
                'name'      => $employee_name_utf8,
            ]);
            if (empty($employee)) {
                echo "add employee: {$employee_name_utf8}.".PHP_EOL;
                $employee = new \app\models\ClientEmployee;
                $employee->client_id = $xyunicom->client_id;
                $employee->name      = $employee_name_utf8;
                $employee->save(false);
            }
            
            if (!in_array($mobile, $employee->mobiles)) {
                echo "add employee mobile: {$mobile}.".PHP_EOL;
                \Yii::$app->db->createCommand()->insert('client_employee_mobile', [
                    'employee_id'   => $employee->employee_id,
                    'mobile'        => $mobile,
                ])->execute();
            }
            
            $row = (new \yii\db\Query())->select('*')->from('client_employee_outlet')->where([
                'employee_id'   => $employee->employee_id,
                'outlet_id'     => $outlet->outlet_id,
            ])->one();
            if (false === $row) {
                echo "add employee to outlet: {$employee_name_utf8}->{$outlet_title_utf8}({$position_utf8}).".PHP_EOL;
                \Yii::$app->db->createCommand()->insert('client_employee_outlet', [
                    'employee_id'   => $employee->employee_id,
                    'outlet_id'     => $outlet->outlet_id,
                    'position'      => $position_utf8,
                ])->execute();
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
            $charge_mobile = trim($fields[0]);
            $charge_ammount = trim($fields[1]);
            if (empty($charge_ammount) || strlen($charge_ammount)==0 || $charge_ammount == 0) continue;
            if (empty($charge_mobile) || strlen($charge_mobile)==0 || strlen($charge_mobile) != 11) continue;
            $openidbindmobile = \app\models\OpenidBindMobile::findOne([
                    'gh_id' => \app\models\MGh::GH_XIANGYANGUNICOM,
                    'mobile' => $charge_mobile,
            ]);
            if (!empty($openidbindmobile)) {
                $wx_user = $openidbindmobile->user;
                if (!empty($wx_user)) {
                    echo $wx_user->nickname ." mobile ".$charge_mobile." charged ".$charge_ammount.PHP_EOL;
                    $user_account = new \app\models\MUserAccount;
                    $user_account->gh_id = $wx_user->gh_id;
                    $user_account->openid = $wx_user->openid;
//                    $user_account->scene_id = $wx_user->staff->scene_id;
                    $user_account->cat = \app\models\MUserAccount::CAT_DEBIT_FAN;
                    $user_account->amount =  $charge_ammount * 100;
                    $user_account->memo = "4G测速";
                    $user_account->charge_mobile = $charge_mobile;
                    $user_account->save(false);
                    
                    $user_account = new \app\models\MUserAccount;
                    $user_account->gh_id = $wx_user->gh_id;
                    $user_account->openid = $wx_user->openid;
//                    $user_account->scene_id = $wx_user->staff->scene_id;
                    $user_account->cat = \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE;
                    $user_account->amount = - $charge_ammount * 100;
                    $user_account->memo = "4G测速";
                    $user_account->charge_mobile = $charge_mobile;
                    $user_account->save(false);
                } else {
                    echo "can't find charge mobile ".$charge_mobile . "({$charge_ammount})".PHP_EOL;
                }
            }
        }
        fclose($fh);
    }
    
    public function actionEmployee($filename = 'employee.csv') {
        
        $xyunicom = \app\models\WosoClient::findOne(['title_abbrev' => '襄阳联通']);
        if (empty($xyunicom)) die('不能找到襄阳联通。');
        
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, "r");
        while (!feof($fh)) {
            $line = trim(fgets($fh));
            if (empty($line) || strlen($line) == 0) continue;
            $fields = explode(",", $line);
            $name = trim($fields[0]);
            $name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $name);
            $department = trim($fields[1]);
            $department_utf8 = iconv('GBK', 'UTF-8//IGNORE', $department);
            $position = trim($fields[2]);
            $position_utf8 = iconv('GBK', 'UTF-8//IGNORE', $position);
            $mobiles = explode(';', trim($fields[3]));
            echo "{$name_utf8},{$department_utf8},{$position_utf8},{$fields[3]}".PHP_EOL;
            
            $employee = \app\models\ClientEmployee::findOne(['name' => $name_utf8]);
            if (empty($employee)) {
                $employee = new \app\models\ClientEmployee;
                $employee->client_id = $xyunicom->client_id;  
                $employee->name = $name_utf8;
                $employee->save(false);
            }
            
            $organization = \app\models\ClientOrganization::findOne(['title' => $department_utf8]);
            if (empty($organization)) {
                $organization = new \app\models\ClientOrganization;
                $organization->client_id = $xyunicom->client_id;
                $organization->title = $department_utf8;
                $organization->save(false);
            }
            
            $row = (new \yii\db\Query())->select('*')->from('client_employee_organization')->where([
                'employee_id'       => $employee->employee_id,
                'organization_id'   => $organization->organization_id,
            ])->one();
            if (false === $row) {
                \Yii::$app->db->createCommand()->insert('client_employee_organization', [
                    'employee_id'       => $employee->employee_id,
                    'organization_id'   => $organization->organization_id,
                    'position'          => $position_utf8,
                ])->execute();
            } else {
                \Yii::$app->db->createCommand()->update('client_employee_organization', ['position' => $position_utf8], [
                    'employee_id'       => $employee->employee_id,
                    'organization_id'   => $organization->organization_id,
                ])->execute();
            }
                        
            foreach($mobiles as $mobile) {
                $mobile = trim($mobile);
                if (strlen($mobile) != 11 || !is_numeric($mobile)) echo "[$mobile]非手机号码；";
                else {
                    $row = (new \yii\db\Query())->select('*')->from('client_employee_mobile')->where([
                        'employee_id' => $employee->employee_id,
                        'mobile'      => $mobile,  
                    ])->one();
                    if (false === $row) {
                        \Yii::$app->db->createCommand()->insert('client_employee_mobile', [
                            'employee_id' => $employee->employee_id,
                            'mobile'      => $mobile,
                        ])->execute();
                    }
                }
            }
        }
        fclose($fh);
    }
    
     public function actionOrganizationChart($filename = 'organization-chart.csv') {    
            
        $xyunicom = \app\models\WosoClient::findOne(['title_abbrev' => '襄阳联通']);
        if (empty($xyunicom)) die('不能找到襄阳联通。');
        
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, "r");
        while (!feof($fh)) {
            $line = trim(fgets($fh));
            if (empty($line) || strlen($line) == 0) continue;
            $fields = explode(",", $line);
            $subordinate_name = trim($fields[0]);
            $subordinate_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $subordinate_name);
            $superior_name = trim($fields[1]);
            $superior_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $superior_name);
            echo "{$subordinate_name}({$subordinate_name_utf8}),{$superior_name}({$superior_name_utf8}))".PHP_EOL;
            
            $subordinate_organization = \app\models\ClientOrganization::findOne(['title' => $subordinate_name_utf8]);
            if (empty($subordinate_organization)) {
                $subordinate_organization = new \app\models\ClientOrganization;
                $subordinate_organization->client_id = $xyunicom->client_id;
                $subordinate_organization->title = $subordinate_name_utf8;
                $subordinate_organization->save(false);
            }
            
            $superior_organization = \app\models\ClientOrganization::findOne(['title' => $superior_name_utf8]);
            if (empty($superior_organization)) {
                $superior_organization = new \app\models\ClientOrganization;
                $superior_organization->client_id = $xyunicom->client_id;
                $superior_organization->title = $superior_name_utf8;
                $superior_organization->save(false);
            }
            
            $row = (new \yii\db\Query())->select('*')->from('client_organization_chart')->where([
                'subordinate_id' => $subordinate_organization->organization_id,
                'superior_id'    => $superior_organization->organization_id,
            ])->one();
            if (false === $row) {
                \Yii::$app->db->createCommand()->insert('client_organization_chart', [
                    'subordinate_id' => $subordinate_organization->organization_id,
                    'superior_id'    => $superior_organization->organization_id,
                ])->execute();
            }
        }
        fclose($fh);
     }
    
    public function actionAgent($filename = 'agent.csv') {
        $xyunicom = \app\models\WosoClient::findOne(['title_abbrev' => '襄阳联通']);
        if (empty($xyunicom)) die('不能找到襄阳联通。');
        
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, "r");
        while (!feof($fh)) {
            $line = trim(fgets($fh));
            if (empty($line) || strlen($line) == 0) continue;
            $fields = explode(",", $line);
            $contact_person = trim($fields[0]);
            $contact_person_utf8 = iconv('GBK', 'UTF-8//IGNORE', $contact_person);
            $msc_brev_name = trim($fields[1]);
            $msc_brev_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $msc_brev_name);
            $title = trim($fields[2]);
            $title_utf8 = iconv('GBK', 'UTF-8//IGNORE', $title);
            $mobiles = explode(';', trim($fields[3]));                        
//            echo "{$contact_person_utf8},{$msc_brev_name_utf8},{$title_utf8},{$fields[3]}".PHP_EOL;
            
            $supervision_organization = \app\models\ClientOrganization::find()->where([
                'like', 'title', $msc_brev_name_utf8
            ])->andWhere(['client_id' => $xyunicom->client_id])->one();
//            $supervision_organization = \Yii::$app->db->createCommand('select * from client_organization where title like \'%:title%\'')
//                    ->bindValue(':title', $msc_brev_name_utf8)->queryOne();
            if (empty($supervision_organization)) {
                die("找不到{$msc_brev_name_utf8}");
            }
            
//            var_dump($supervision_organization);
            
            $row = false;
            foreach ($mobiles as $mobile) {
                $mobile = trim($mobile);
                $row = (new \yii\db\Query())->select('*')->from('client_agent')->join('INNER JOIN', 'client_agent_mobile', [
                    'client_agent.agent_id' => 'client_agent_mobile.agent_id',
                ])->where([
                    'name'      => $contact_person_utf8,
                    'mobile'    => $mobile,
                ])->one();
                if (false !== $row) break;
            }
            
            if (false !== $row) {
                $agent = \app\models\ClientAgent::findOne(['agent_id' => $row['agent_id']]);
            } else {
                $agent = new \app\models\ClientAgent;
                $agent->name = $contact_person_utf8;
                $agent->save(false);
            }
            $outlet = \app\models\ClientOutlet::findOne(['title' => $title_utf8]);
            if (empty($outlet)) {
                $outlet = new \app\models\ClientOutlet;
                $outlet->title       = $title_utf8;
                $outlet->client_id   = $xyunicom->client_id;
                $outlet->telephone   = $fields[3];
                $outlet->category    = \app\models\ClientOutlet::CATEGORY_COOPERATED;
                $outlet->supervison_organization_id = $supervision_organization->organization_id;
                $outlet->save(false);
            } else {
                $outlet->client_id   = $xyunicom->client_id;
                $outlet->telephone   = $fields[3];
                $outlet->category    = \app\models\ClientOutlet::CATEGORY_COOPERATED;
                $outlet->supervison_organization_id = $supervision_organization->organization_id;
                $outlet->save(false);
            }
            
            $row = (new \yii\db\Query())->select('*')->from('client_agent_outlet')->where([
                'agent_id'   => $agent->agent_id,
                'outlet_id'  => $outlet->outlet_id,
            ])->one();
            if (false === $row) {
                \Yii::$app->db->createCommand()->insert('client_agent_outlet', [
                    'agent_id'   => $agent->agent_id,
                    'outlet_id'  => $outlet->outlet_id,
                    'position'   => '店主',
                ])->execute();
            }

            foreach($mobiles as $mobile) {               
                if (strlen($mobile) != 11 || !is_numeric($mobile)) echo "[$mobile]非手机号码.".PHP_EOL;
                else {
                    $row = (new \yii\db\Query())->select('*')->from('client_agent_mobile')->where([
                        'mobile' => $mobile,
                    ])->one();
                    if (false === $row) {                                            
                       \Yii::$app->db->createCommand()->insert('client_agent_mobile', [
                           'agent_id' => $agent->agent_id,
                           'mobile'   => $mobile,
                       ])->execute(); 
                    }
                }
            }
        }
        fclose($fh);
    }
    
    const FAQ_QUESTION = 'Q:';
    const FAQ_ANSWER = 'A:';
    public function actionFaq( $filename = 'faq.txt' ) {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $content = file_get_contents($filepathname);
        $offset = 0;
        $q_pos = 0;
        $a_pos = 0;
        $q = '';
        $a = '';
        while (($q_pos = strpos($content, self::FAQ_QUESTION, $offset)) !== false) {
            $a_pos = stripos($content, self::FAQ_ANSWER, $q_pos);
            if (false !== $a_pos) {
                $q = trim(substr($content, $q_pos + strlen(self::FAQ_QUESTION), $a_pos - $q_pos - strlen(self::FAQ_QUESTION)));
                echo $q.PHP_EOL;
                $q_pos = stripos($content, self::FAQ_QUESTION, $a_pos);
                if (false !== $q_pos) {
                    $a = trim(substr($content, $a_pos + strlen(self::FAQ_ANSWER), $q_pos - $a_pos - strlen(self::FAQ_ANSWER)));
                } else {
                    $a = trim(substr($content, $a_pos + strlen(self::FAQ_ANSWER)));
                }
                echo $a.PHP_EOL;
            } else {
                $q = trim(substr($content, $q_pos + strlen(self::FAQ_QUESTION)));
                $a = '';
            }  
            $faq = new \app\models\UnicomFaq;
            $faq->question = $q;
            $faq->answer = $a;
            $faq->created_at = time();
            $faq->updated_at = time();
            $faq->save(false);
            $offset = $q_pos + strlen(self::FAQ_QUESTION);
        }        
    }
}
