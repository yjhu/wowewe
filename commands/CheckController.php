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
            if (!empty($director))
                echo " ".$director->name.' '.$director->mobile;
            echo PHP_EOL;
        }
    }

}
