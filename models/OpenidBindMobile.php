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

DROP TABLE IF EXISTS wx_t3;
CREATE TABLE IF NOT EXISTS wx_t3 (
    mobile VARCHAR(32) NOT NULL DEFAULT '',
    KEY idx_mobile(mobile)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
    
    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'update_time',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
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
            [['carrier', 'province', 'city', 'zip', 'areacode', 'cardtype'], 'safe'],

        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
//            $this->getCarrier();
        }
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getCustom()
    {
        return $this->hasOne(Custom::className(), ['mobile' => 'mobile']);
    }

    public static function getMobiles()
    {
        $mobiles = OpenidBindMobile::find()->select(['mobile'])->column();
        return $mobiles;
    }
    
    public function getCarrier() {
        if (empty($this->carrier) || (strtotime($this->update_time) < strtotime('-1 month'))) {
            $resp = \app\models\U::getMobileLocation($this->mobile);
            if (empty($resp['errcode'])) {
                $this->updateAttributes([
                    'carrier'   => $resp['Corp'],
                    'province'  => $resp['Province'],
                    'city'      => $resp['City'],
                    'zip'      => $resp['zip'],
                    'areacode'      => $resp['areacode'],
                    'cardtype'      => $resp['cardtype'],
                ]);
            }
        }
        return $this->carrier;
    }
    
    public static function getMemberCarrierPieDataAjax($targetOfficeId = 0) {
        $results = [];
        $query = (new \yii\db\Query())
                ->select('carrier, count(*) as c')
                ->from(self::tableName());
        if (0 === $targetOfficeId) {
            $query = $query->where(['not', ['carrier' => null]]);
        } else {
            $query = $query->join('left join', 'wx_user', 'wx_openid_bind_mobile.gh_id = wx_user.gh_id and wx_openid_bind_mobile.openid = wx_user.openid')
                    ->where(['wx_user.belongto' => $targetOfficeId])
                    ->andWhere(['not', ['carrier' => null]]);
        }
        $query = $query->groupBy('carrier')
                ->orderBy('c desc');
        $rows = $query->all();
        foreach ($rows as $row) {
            $results[] = [
                'label' => $row['carrier'],
                'data' => $row['c'],
            ];
        }
        return \yii\helpers\Json::encode($results);
    }
    
    public function getProvince() {
        if (empty($this->province) || (strtotime($this->update_time) < strtotime('-1 month'))) {
            $resp = \app\models\U::getMobileLocation($this->mobile);
            if (empty($resp['errcode'])) {
                $this->updateAttributes([
                    'carrier'   => $resp['Corp'],
                    'province'  => $resp['Province'],
                    'city'      => $resp['City'],
                    'zip'      => $resp['zip'],
                    'areacode'      => $resp['areacode'],
                    'cardtype'      => $resp['cardtype'],
                ]);
            }
        }
        return $this->province;
    }
    
    public function getCity() {
        if (empty($this->city) || (strtotime($this->update_time) < strtotime('-1 month'))) {
            $resp = \app\models\U::getMobileLocation($this->mobile);
            if (empty($resp['errcode'])) {
                $this->updateAttributes([
                    'carrier'   => $resp['Corp'],
                    'province'  => $resp['Province'],
                    'city'      => $resp['City'],
                    'zip'      => $resp['zip'],
                    'areacode'      => $resp['areacode'],
                    'cardtype'      => $resp['cardtype'],
                ]);
            }
        }
        return $this->city;
    }
    
    public static function getMemberRegionPieDataAjax($targetOfficeId = 0) {
        $results = [];
        $query = (new \yii\db\Query())
                ->select('wx_openid_bind_mobile.province as province, wx_openid_bind_mobile.city as city, count(*) as c')
                ->from(self::tableName());
        if (0 === $targetOfficeId) {
            $query = $query->where(['not', ['wx_openid_bind_mobile.province' => null]])
                ->andWhere(['not', ['wx_openid_bind_mobile.city' => null]]);
        } else {
            $query = $query->join('left join', 'wx_user', 'wx_openid_bind_mobile.gh_id = wx_user.gh_id and wx_openid_bind_mobile.openid = wx_user.openid')
                    ->where(['wx_user.belongto' => $targetOfficeId])
                    ->andWhere(['not', ['wx_openid_bind_mobile.province' => null]])
                    ->andWhere(['not', ['wx_openid_bind_mobile.city' => null]]);
        }
        $query = $query->groupBy('wx_openid_bind_mobile.province, wx_openid_bind_mobile.city')
                ->orderBy('c desc')
                ->limit(8);
        $rows = $query->all();
        foreach ($rows as $row) {
            $results[] = [
                'label' => $row['province'] . $row['city'],
                'data' => $row['c'],
            ];
        }
        return \yii\helpers\Json::encode($results);
    }

    public function getZip() {
        if (empty($this->zip) || (strtotime($this->update_time) < strtotime('-1 month'))) {
            $resp = \app\models\U::getMobileLocation($this->mobile);
            if (empty($resp['errcode'])) {
                $this->updateAttributes([
                    'carrier'   => $resp['Corp'],
                    'province'  => $resp['Province'],
                    'city'      => $resp['City'],
                    'zip'      => $resp['zip'],
                    'areacode'      => $resp['areacode'],
                    'cardtype'      => $resp['cardtype'],
                ]);
            }
        }
        return $this->city;
    }

    public function getAreacode() {
        if (empty($this->areacode) || (strtotime($this->update_time) < strtotime('-1 month'))) {
            $resp = \app\models\U::getMobileLocation($this->mobile);
            if (empty($resp['errcode'])) {
                $this->updateAttributes([
                    'carrier'   => $resp['Corp'],
                    'province'  => $resp['Province'],
                    'city'      => $resp['City'],
                    'zip'      => $resp['zip'],
                    'areacode'      => $resp['areacode'],
                    'cardtype'      => $resp['cardtype'],
                ]);
            }
        }
        return $this->city;
    }

    public function getCardtype() {
        if (empty($this->cardtype) || (strtotime($this->update_time) < strtotime('-1 month'))) {
            $resp = \app\models\U::getMobileLocation($this->mobile);
            if (empty($resp['errcode'])) {
                $this->updateAttributes([
                    'carrier'   => $resp['Corp'],
                    'province'  => $resp['Province'],
                    'city'      => $resp['City'],
                    'zip'      => $resp['zip'],
                    'areacode'      => $resp['areacode'],
                    'cardtype'      => $resp['cardtype'],
                ]);
            }
        }
        return $this->city;
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
