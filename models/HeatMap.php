<?php

namespace app\models;

use Yii;
use app\models\MUser;
use app\models\VipManager;

/*
DROP TABLE IF EXISTS wx_heat_map;
CREATE TABLE IF NOT EXISTS wx_heat_map (
    heat_map_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    lon float(10,6) NOT NULL DEFAULT '0.000000',
    lat float(10,6) NOT NULL DEFAULT '0.000000',
    speed_up int(10) unsigned NOT NULL DEFAULT '0',
    speed_down int(10) unsigned NOT NULL DEFAULT '0',
    speed_delay int(10) unsigned NOT NULL DEFAULT '0',
    status tinyint(3) unsigned NOT NULL DEFAULT 0,
    KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/

class HeatMap extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'wx_heat_map';
    }

    public function rules()
    {
        return [            
            [['gh_id', 'openid'], 'string', 'max' => 32],            
        ];
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function attributeLabels()
    {
        return [
            'heat_map_id' => Yii::t('app', 'ID'),
            'gh_id' => Yii::t('app', 'Gh ID'),
            'openid' => Yii::t('app', 'Openid'),
        ];
    }
}
