<?php
namespace app\models;

/*
#
# 推广日报，每天晚上计算一次，记录前一天每个推广者每天的推广成绩, 每个scene_id如果每天有成绩的话，每天晚上增加一条记录
#
DROP TABLE IF EXISTS wx_scene_day;
CREATE TABLE wx_scene_day (
    scene_day_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    create_date DATE COMMENT '统计日期',
    scene_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推广者的推广ID',    
    score int(10) NOT NULL DEFAULT '0' COMMENT '当天推广人数',
    KEY idx_gh_id_create_date_scene_id(gh_id, create_date, scene_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

use app\models\U;
use app\models\MStaff;
use app\models\MGh;

class MSceneDay extends ActiveRecord
{
    public static function tableName()
    {
        return 'wx_scene_day';
    }

    public function getGh()
    {
        return $this->hasOne(MGh::className(), ['gh_id' => 'gh_id']);
    }
    
    public function getStaff()
    {
        return $this->hasOne(MStaff::className(), ['gh_id' => 'gh_id', 'scene_id' => 'scene_id']);
    }

}


