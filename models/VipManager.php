<?php

namespace app\models;

use Yii;
use app\models\MUser;

/*
DROP TABLE IF EXISTS wx_vip_manager;
CREATE TABLE IF NOT EXISTS wx_vip_manager (
    vip_manager_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    mobile VARCHAR(32) NOT NULL DEFAULT '',
    manager_name VARCHAR(32) NOT NULL DEFAULT '',
    manager_mobile VARCHAR(32) NOT NULL DEFAULT '',
    UNIQUE KEY idx_mobile(mobile),
    KEY idx_gh_id_open_id(gh_id, mobile)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/

/**
 * This is the model class for table "wx_vip_manager".
 *
 * @property string $vip_manager_id
 * @property string $gh_id
 * @property string $openid
 * @property string $mobile
 */
class VipManager extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'wx_vip_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['gh_id', 'openid', 'mobile'], 'string', 'max' => 32],            
            [['mobile'], 'unique'],
            ['mobile', 'filter', 'filter' => 'trim'],
            ['mobile', 'required'], 
        ];
    }

    public function attributeLabels()
    {
        return [
            'vip_manager_id' => Yii::t('app', 'ID'),
            'gh_id' => Yii::t('app', 'Gh ID'),
            'mobile' => Yii::t('app', 'Mobile'),
        ];
    }
}
