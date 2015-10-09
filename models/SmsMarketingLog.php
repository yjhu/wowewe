<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sms_marketing_log".
 *
 * @property string $mobile
 * @property integer $first_sendtime
 * @property integer $last_sendtime
 * @property integer $send_count
 * @property integer $member_time
 */
class SmsMarketingLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms_marketing_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile'], 'required'],
            [['first_sendtime', 'last_sendtime', 'send_count', 'member_time'], 'integer'],
            [['mobile'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mobile' => 'Mobile',
            'first_sendtime' => 'First Sendtime',
            'last_sendtime' => 'Last Sendtime',
            'send_count' => 'Send Count',
            'member_time' => 'Member Time',
        ];
    }
    
    public static function sendCountMax() {
        return \Yii::$app->db
                ->createCommand('SELECT max(send_count) FROM sms_marketing_log')
                ->queryScalar();
    }
    
    public static function member($mobile) {
        $myself = self::findOne(['mobile' => $mobile]);
        if (!empty($myself)) {
            $myself->member_time = time();
            $myself->save(false);
        }
    }
}
