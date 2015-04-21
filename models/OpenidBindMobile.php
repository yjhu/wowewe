<?php

namespace app\models;

use Yii;
use app\models\MUser;
use app\models\VipManager;

/*
DROP TABLE IF EXISTS wx_openid_bind_mobile;
CREATE TABLE IF NOT EXISTS wx_openid_bind_mobile (
    openid_bind_mobile_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    mobile VARCHAR(32) NOT NULL DEFAULT '',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,    
    UNIQUE KEY idx_mobile(mobile),
    KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE wx_openid_bind_mobile ADD create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

*/

/**
 * This is the model class for table "wx_openid_bind_mobile".
 *
 * @property string $openid_bind_mobile_id
 * @property string $gh_id
 * @property string $openid
 * @property string $mobile
 */
class OpenidBindMobile extends \yii\db\ActiveRecord
{
    public $verifyCode;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_openid_bind_mobile';
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
            ['mobile', 'match', 'pattern' => '/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/' ],

            ['verifyCode', 'captcha', 'captchaAction'=>'site/smcaptcha', 'on'=>'bind_mobile'],
        
        ];
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getCustom()
    {
        return $this->hasOne(Custom::className(), ['mobile' => 'mobile']);
    }

    public function attributeLabels()
    {
        return [
            'openid_bind_mobile_id' => Yii::t('app', 'Openid Bind Mobile ID'),
            'gh_id' => Yii::t('app', 'Gh ID'),
            'openid' => Yii::t('app', 'Openid'),
            'mobile' => Yii::t('app', 'Mobile'),
        ];
    }
}
