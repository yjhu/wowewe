<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sms_marketing_config".
 *
 * @property string $key
 * @property integer $value
 */
class SmsMarketingConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms_marketing_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
            [['key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key',
            'value' => 'Value',
        ];
    }
    const ENABLE_KEY = 'enabled';
    const DAILY_LIMIT_KEY = 'daily_limit';
    const SINGLE_STEP_LIMIT = 1000;
    
    private static function enable()
    {
        $enable = self::findOne(['key' => self::ENABLE_KEY]);
        if (empty($enable)) {
            $enable = new self;
            $enable->key = self::ENABLE_KEY;
            $enable->value = 1;
            $enable->save(false);
        }
        return $enable->value;
    }
    
    private static function dailyLimit()
    {
        $daily_limit = self::findOne(['key' => self::DAILY_LIMIT_KEY]);
        if (empty($daily_limit)) {
            $daily_limit = new self;
            $daily_limit->key = self::DAILY_LIMIT_KEY;
            $daily_limit->value = 900;
            $daily_limit->save(false);
        }
        return $daily_limit->value;
    }
    
    private static function sms($mobile) {
//        \Yii::$app->wx->setGhId(\app\models\MGh::GH_XIANGYANGUNICOM);
        $long_url = 'http://wosotech.com/wx/web/index.php?r=wapx/sm-qr'.'&mobile='.$mobile;
//        $short_url = \Yii::$app->wx->WxGetShortUrl($long_url);
        $short_url = BaiduDwz::dwz($long_url);
        $content = '【襄阳联通】尊敬的'.$mobile.'用户，诚邀您关注襄阳联通官方微信号，点击下面链接直接成为会员，专享特权！'.$short_url;
        return \app\models\sm\ESmsGuodu::yjhu_test($mobile, $content);
    }
    
    public static function run() 
    {
        if (self::enable()) {
            self::sms('18971288549');// warning
            self::sms('13545296480');// warning
            $cnt = 1;            
            
            // first round: 76+ customers
            $offset = 0;
            $limit = self::SINGLE_STEP_LIMIT;
            while (true) {
                $mobiles = MHd201509t5::find()->where([
                    'tcnx' => 2,
                ])->orderBy('mobile DESC')->offset($offset)->limit($limit)->all();
                foreach ($mobiles as $mobile) {
                    $openid_bind_mobile = OpenidBindMobile::findOne([
                        'gh_id' => MGh::GH_XIANGYANGUNICOM,
                        'mobile' => $mobile->mobile,
                    ]);
                    if (empty($openid_bind_mobile)) {
                        $smslog = SmsMarketingLog::findOne(['mobile' => $mobile->mobile]);
                        if (empty($smslog)) {
                            self::sms($mobile->mobile);
                            $smslog = new SmsMarketingLog;
                            $smslog->mobile = $mobile->mobile;
                            $smslog->first_sendtime = time();
                            $smslog->last_sendtime = time();
                            $smslog->send_count = 1;
                            $smslog->save(false);
                            
                            $cnt++;
                            if ($cnt > self::dailyLimit()) return;
                        }
                    }                    
                }                
                $offset += $limit;
            }
            
            // 2nd round, 76- customers
            $offset = 0;
            $limit = self::SINGLE_STEP_LIMIT;
            while (true) {
                $mobiles = MHd201509t5::find()->where([
                    'tcnx' => 1,
                ])->orderBy('mobile DESC')->offset($offset)->limit($limit)->all();
                foreach ($mobiles as $mobile) {
                    $openid_bind_mobile = OpenidBindMobile::findOne([
                        'gh_id' => MGh::GH_XIANGYANGUNICOM,
                        'mobile' => $mobile->mobile,
                    ]);
                    if (empty($openid_bind_mobile)) {
                        $smslog = SmsMarketingLog::findOne(['mobile' => $mobile->mobile]);
                        if (empty($smslog)) {
                            self::sms($mobile->mobile);
                            $smslog = new SmsMarketingLog;
                            $smslog->mobile = $mobile->mobile;
                            $smslog->first_sendtime = time();
                            $smslog->last_sendtime = time();
                            $smslog->send_count = 1;
                            $smslog->save(false);
                            
                            $cnt++;
                            if ($cnt > self::dailyLimit()) return;
                        }
                    }                    
                }                
                $offset += $limit;
            }
            
            // 3rd round, 76+ customers
            $offset = 0;
            $limit = self::SINGLE_STEP_LIMIT;
            $max_send_count = SmsMarketingLog::sendCountMax();
            while (true) {
                $mobiles = MHd201509t5::find()->where([
                    'tcnx' => 2,
                ])->orderBy('mobile DESC')->offset($offset)->limit($limit)->all();
                foreach ($mobiles as $mobile) {
                    $openid_bind_mobile = OpenidBindMobile::findOne([
                        'gh_id' => MGh::GH_XIANGYANGUNICOM,
                        'mobile' => $mobile->mobile,
                    ]);
                    if (empty($openid_bind_mobile)) {
                        $smslog = SmsMarketingLog::findOne(['mobile' => $mobile->mobile]);
                        if (!empty($smslog) && ($smslog->send_count < $max_send_count)) {                            
                            self::sms($mobile->mobile);   
                            $smslog->send_count++;
                            $smslog->last_sendtime = time();
                            $smslog->save(false);
                            
                            $cnt++;
                            if ($cnt > self::dailyLimit()) return;
                        }
                    }                    
                }                
                $offset += $limit;
            }
            
            // 4th round, 76- customers
            $offset = 0;
            $limit = self::SINGLE_STEP_LIMIT;
            $max_send_count = SmsMarketingLog::sendCountMax();
            while (true) {
                $mobiles = MHd201509t5::find()->where([
                    'tcnx' => 1,
                ])->orderBy('mobile DESC')->offset($offset)->limit($limit)->all();
                foreach ($mobiles as $mobile) {
                    $openid_bind_mobile = OpenidBindMobile::findOne([
                        'gh_id' => MGh::GH_XIANGYANGUNICOM,
                        'mobile' => $mobile->mobile,
                    ]);
                    if (empty($openid_bind_mobile)) {
                        $smslog = SmsMarketingLog::findOne(['mobile' => $mobile->mobile]);
                        if (!empty($smslog) && ($smslog->send_count < $max_send_count)) {                            
                            self::sms($mobile->mobile);   
                            $smslog->send_count++;
                            $smslog->last_sendtime = time();
                            $smslog->save(false);
                            
                            $cnt++;
                            if ($cnt > self::dailyLimit()) return;
                        }
                    }                    
                }                
                $offset += $limit;
            }
        }
    }
    
    public static function smsAjax($mobile) {
        $ret = self::sms($mobile);
        if ($ret) {
            return \yii\helpers\Json::encode(['err_code' => 0, 'err_msg' => '']);
        } else {
            return \yii\helpers\Json::encode(['err_code' => -1, 'err_msg' => '短信网关发送失败。']);
        }
    }
}
