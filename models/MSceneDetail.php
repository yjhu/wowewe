<?php
namespace app\models;


/*
DROP TABLE IF EXISTS wx_scene_detail;
CREATE TABLE wx_scene_detail (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',    
    scene_id int(10) unsigned NOT NULL DEFAULT '0',    
    src_id int(10) unsigned NOT NULL DEFAULT '0',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    amount int(10) NOT NULL DEFAULT '0',
    oid VARCHAR(32) NOT NULL DEFAULT '',
    memo VARCHAR(256) NOT NULL DEFAULT '',    
    status tinyint(1) unsigned NOT NULL DEFAULT '0',    
    KEY idx_gh_id_scene_id(gh_id, scene_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MUser;
use app\models\MItem;
use app\models\MOrder;

class MSceneDetail extends ActiveRecord
{

    const SRC_ID_SHARE_FRIEND = 1;

    const STATUS_AUCTION = 0;
    const STATUS_CONFIRMED = 1;    
    
    public static function tableName()
    {
        return 'wx_scene_detail';
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'scene_id' => 'scene_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(MOrder::className(), ['oid' => 'oid']);
    }
    
}

/*        
*/
