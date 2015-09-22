<?php

namespace app\commands;

use Yii;
use app\models\MStaff;
use app\models\MUser;

class CheckController extends \yii\console\Controller {

    public function actionOfficeManager() {
        $visible_offices = \app\models\MOffice::findAll([
            'visable' => 1, 
            'gh_id' => \app\models\MGh::GH_XIANGYANGUNICOM,
        ]);
        $i = 0;
        foreach ($visible_offices as $visible_office) {
            echo $i++; echo ":";
//            echo iconv("UTF-8", "GBK", $visible_office->title);
            echo $visible_office->title;
            $manager = $visible_office->getManager();
            if (!empty($manager))
//                echo " ".iconv("UTF-8", "GBK", $manager->name).' '.iconv("UTF-8", "GBK", $manager->mobile);
                echo " ".$manager->name.' '.$manager->mobile;
            echo PHP_EOL;
        }
    }
    
    public function actionOfficeDirector() {
        $selfOperated_offices = \app\models\MOffice::findAll([
            'is_selfOperated' => 1, 
            'gh_id' => \app\models\MGh::GH_XIANGYANGUNICOM,
        ]);
        $i = 0;
        foreach ($selfOperated_offices as $selfOperated_office) {
            echo ++$i; echo ":";
            echo $selfOperated_office->title;
            $director = $selfOperated_office->director;
            if (!empty($director)) {
                echo " ".$director->name.' '.$director->mobile;
                if (empty($director->office) || $director->office->office_id != $selfOperated_office->office_id) {
                    echo " "."班长的营业厅对应错了。";
                    if (empty($director->office))
                        echo "(NULL)";
                    else
                        echo "{$director->office->title}({$director->office->office_id} != {$selfOperated_office->office_id})";
                     $director->office_id = $selfOperated_office->office_id;
                     $director->save(false);
                }
            }
            echo PHP_EOL;
        }
    }
    
    public function actionOfficeCampaignDetail()
    {
        $details = \app\models\MOfficeCampaignDetail::find()->all();
        foreach ($details as $detail) {
            $pic_filename = $detail->getPicFile();
            $pic_filename_new = $pic_filename."-new.jpg";
            try {
                \app\models\U::compress_image_file($pic_filename);
                echo $pic_filename." compressed.".PHP_EOL;
            } catch (Exception $e) {
                echo $e->getMessage();
                echo $pic_filename.PHP_EOL;
            }
        }
    }
    
    public function actionWxuserBelongto()
    {
        $total_count = \app\models\MUser::find()->count();
        $offset = 0; $step = 1000;
        while (true) {
            if ($offset > $total_count) break;
            $wx_users = \app\models\MUser::find()->orderBy('id')->offset($offset)->limit($step)->all();
            foreach($wx_users as $wx_user) {
//                echo $wx_user->openid.PHP_EOL;
                if ($wx_user->belongto  == 0) {
                    $wx_user->belongto = $wx_user->getBelongTo();
                    $wx_user->save(false);
                }
            }
            $offset += $step;
        }
        echo "done with ". $total_count . PHP_EOL;
    }
    
    public function actionOfficeCampaignScorer() {
        $scorers = \app\models\MOfficeCampaignScorer::find()->all();
        foreach($scorers as $scorer) {
            $openidbindmobile = \app\models\OpenidBindMobile::findOne(['mobile' => $scorer->mobile]);
            if (empty($openidbindmobile)) {
                echo "{$scorer->name}({$scorer->mobile})手机未绑定。".PHP_EOL;
            }
            $staffs = \app\models\MStaff::find()->where(['gh_id' => \app\models\MGh::GH_XIANGYANGUNICOM, 'mobile' => $scorer->mobile])->all();
            if (empty($staffs)) {
                echo "{$scorer->name}({$scorer->mobile})不在Staff表中。".PHP_EOL;
                $staff = new \app\models\MStaff;
            } else if (count($staffs) > 1) {
                echo "{$scorer->name}({$scorer->mobile})在Staff表中存在多项。".PHP_EOL;
                $n = count($staffs); $selected = -1;
                for ($i = 0; $i < $n; $i++) {
                    $staff = $staffs[$i];
                    if (empty($staff->openid) || $selected != -1) $staff->delete();
                    else if (!empty($staff->openid)) $selected = $i;
                }
                if ($selected == -1) $staff = new \app\models\MStaff;
                else                 $staff = $staffs[$selected];
            } else {
                $staff = $staffs[0];               
            }
            $staff->gh_id = \app\models\MGh::GH_XIANGYANGUNICOM;
            $staff->name = $scorer->name;
            $staff->mobile = $scorer->mobile;
            $staff->cat = \app\models\MStaff::SCENE_CAT_IN;
            $staff->save(false);
        }
    }
    
    public function actionUserAccountBalance() {
        \Yii::$app->db->createCommand("update wx_user set user_account_balance = 0")->execute();
        $user_accounts = \app\models\MUserAccount::find()->all();
        foreach($user_accounts as $user_account) {
//            if ($user_account->cat == \app\models\MUserAccount::CAT_DEBIT_FAN)
                $user_account->user->updateCounters(['user_account_balance' => $user_account->amount]);
        }
    }
    
    public function actionOutlets() {
       $outlets = \app\models\ClientOutlet::find()->all();
       foreach($outlets as $outlet) {
           $office = \app\models\MOffice::find()->where([
               'title'  => $outlet->title,
           ])->one();
           if (!empty($office)) {
               echo "found {$outlet->title}".PHP_EOL;
               $details = \app\models\MOfficeCampaignDetail::findAll(['office_id' => $office->office_id]);
               $pics = [];
               foreach($details as $detail) {
                    $pic_urls = explode(',', $detail->pic_url);
                    foreach ($pic_urls as $pic_url) {
                        $from = $detail->getPicFileByMedia($pic_url);
                        $media = str_replace('.jpg', '', $pic_url);
                        $to   = $outlet->getPicPathname($media);
                        copy($from, $to);
                        $pics[] = $media;
                    }
               }
               $outlet->pics = implode(",", $pics);
               $outlet->original_office_id = $office->office_id;
               $outlet->latitude = $office->lat;
               $outlet->longitude = $office->lon;
               $outlet->save(false);
           }
       }
    }
    
    public function actionSm()
    {
        \app\models\sm\ESmsGuodu::S_test2();
    }
    
    public function actionMember()
    {
        $startDate = date('Y-m-d 00:00:00', strtotime('-1 month'));
        $endDate = date('Y-m-d 23:59:59');
        echo "daily:\n";
        echo \app\models\MUser::getMemberTimeline($startDate, $endDate, 0) . PHP_EOL;
        echo "accumulated:\n";
        echo \app\models\MUser::getMemberTimeline($startDate, $endDate, 1) . PHP_EOL;
    }
    
    public function actionSceneId() {
        $sql = 'select scene_id, count(*) as c from wx_staff where scene_id != 0 group by scene_id having c > 1 order by c desc';
        $rows = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($rows as $row) {
//            echo $row['scene_id'] . ': ' . $row['c'] . PHP_EOL;
            $staffs = MStaff::findAll(['scene_id' => $row['scene_id']]);
            $cat_staffs = [];
            foreach ($staffs as $staff) {
                $cat_staffs[$staff->cat][] = $staff;
            }
            $cat_staffs['individual'] = [];
            if (!empty($cat_staffs[MStaff::SCENE_CAT_IN])) 
                $cat_staffs['individual'] = array_merge($cat_staffs['individual'], $cat_staffs[MStaff::SCENE_CAT_IN]);
            if (!empty($cat_staffs[MStaff::SCENE_CAT_OUT])) 
                $cat_staffs['individual'] = array_merge($cat_staffs['individual'], $cat_staffs[MStaff::SCENE_CAT_OUT]);
            if (!empty($cat_staffs[MStaff::SCENE_CAT_FAN])) 
                $cat_staffs['individual'] = array_merge($cat_staffs['individual'], $cat_staffs[MStaff::SCENE_CAT_FAN]);
            
            $first = null;
            foreach($cat_staffs['individual'] as $individual_staff) {
                if (null === $first) {
                    $first = $individual_staff; continue;
                }
                if ($individual_staff->openid == $first->openid) {
                    echo "duplicate staff! " . $individual_staff->openid .' '. $individual_staff->name . PHP_EOL;
                    $individual_staff->delete();
                }
            }
            
            if (empty($cat_staffs[MStaff::SCENE_CAT_OFFICE])) {
                
            } else {                               
                if (count($cat_staffs[MStaff::SCENE_CAT_OFFICE]) > 1) {
                    $all_offices = [];
                    $first = null;
                    foreach ($cat_staffs[MStaff::SCENE_CAT_OFFICE] as $cat_staff) {
                        echo $cat_staff->scene_id . $cat_staff->name . PHP_EOL;
                        if (null === $first) {
                            $first = $cat_staff; 
                            $all_offices[] = $first;
                            continue;
                        }
                        if ($cat_staff->office_id == $first->office_id) {
                            echo "duplicate staff! " . $cat_staff->office_id .' '. $cat_staff->name . PHP_EOL;
                            $cat_staff->delete();
                        } else {
                            $cat_staff->scene_id = MStaff::newSceneId($cat_staff->gh_id);
                            $cat_staff->save(false);
                            echo 'change OFFICE sceneid: '. $cat_staff->name . ' ' . $first->scene_id . ' -> ' . $cat_staff->scene_id .PHP_EOL;
                            $all_offices[] = $cat_staff;
                        }
                    }
                    
                    $musers = MUser::findAll(['scene_pid' => $first->scene_id]);
                    foreach ($musers as $muser) {
                        $cnt = count($all_offices);
                        $index = rand(0, $cnt - 1);
                        echo 'change USER belongto: '. $muser->nickname . ' ' . $muser->belongto . ' -> ' . $all_offices[$index]->office_id .PHP_EOL;
                        $muser->belongto = $all_offices[$index]->office_id;
                        $muser->scene_pid = $all_offices[$index]->scene_id;
                        $muser->save(false);
                    }
                    
                } else {
                    $cat_staff = $cat_staffs[MStaff::SCENE_CAT_OFFICE][0];
                    echo $cat_staff->scene_id . $cat_staff->name . PHP_EOL;
                    
                    $musers = MUser::findAll(['scene_pid' => $cat_staff->scene_id]);
                    foreach ($musers as $muser) {
                        echo 'change USER belongto: '. $muser->nickname . ' ' . $muser->belongto . ' -> ' . $cat_staff->office_id .PHP_EOL;
                        $muser->belongto = $cat_staff->office_id;
                        $muser->save(false);
                    }
                    
                    
                }
            
                foreach ($cat_staffs['individual'] as $individual_staff) {                       
                    $individual_staff->scene_id = MStaff::newSceneId($individual_staff->gh_id);
                    $individual_staff->save(false);
                    echo 'change INDIVIDUAL sceneid: '. $individual_staff->name . ' ' . $cat_staff->scene_id . ' -> ' . $individual_staff->scene_id .PHP_EOL;
                }
            }
        }
    }
}
