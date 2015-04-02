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
    pic_url VARCHAR(256) NOT NULL DEFAULT '',             
    status tinyint(3) unsigned NOT NULL DEFAULT 0,
    KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO wx_heat_map (gh_id, openid,lon,lat, speed_up, speed_down, speed_delay) VALUES ('gh_03a74ac96138', 'oKgUduNHzUQlGRIDAghiY7ywSeWk', '114.277223','30.594135', 1,2,3);
INSERT INTO wx_heat_map (gh_id, openid,lon,lat, speed_up, speed_down, speed_delay) VALUES ('gh_03a74ac96138', 'oKgUduNHzUQlGRIDAghiY7ywSeWk', '114.292745','30.591649', 10,20,30);

media_id VARCHAR(256) NOT NULL DEFAULT '',    


*/

class HeatMap extends \yii\db\ActiveRecord
{
	const PHOTO_PATH = 'heatmap';

    public static function tableName()
    {
        return 'wx_heat_map';
    }

    public function rules()
    {
        return [            
            [['gh_id', 'openid'], 'string', 'max' => 32],  
            [['status'], 'integer', 'integerOnly' =>true, 'min'=>0 ],                   
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

	public function afterDelete()
	{
		$file = $this->getPicFile();
		@unlink($file);
		parent::afterDelete();
	}

	public function getPicFile()
	{
		return Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . $this->pic_url;
	}

    public function getImageUrl()
    {
        $gh_id = $this->gh_id;
        $pic_url = $this->pic_url;
//        $url = Yii::$app->getRequest()->baseUrl."/../runtime/heatmap/{$pic_url}";
        $url = Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl() . '/'. self::PHOTO_PATH. '/' ."{$this->pic_url}";
        U::W($url);        
        return $url;
    }
    
}
