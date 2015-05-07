<?php

namespace app\commands;

use Yii;

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

}
