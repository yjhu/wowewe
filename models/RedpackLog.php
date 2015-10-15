<?php

namespace app\models;

use Yii;
use app\models\wxpay\WxPayApi;

/**
 * This is the model class for table "redpack_log".
 *
 * @property string $gh_id
 * @property string $openid
 * @property string $mobile
 * @property integer $amount
 * @property integer $sendtime
 * @property integer $category
 */
class RedpackLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redpack_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'sendtime', 'category'], 'integer'],
            [['gh_id', 'openid', 'mobile'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gh_id' => 'Gh ID',
            'openid' => 'Openid',
            'mobile' => 'Mobile',
            'amount' => 'Amount',
            'sendtime' => 'Sendtime',
            'category' => 'Category',
        ];
    }
    const CATEGORY_SMS = 0;
    public static function sendRedpack($gh_id, $openid, $mobile, $category = self::CATEGORY_SMS) {
//        U::yjhu_w('sendRedpack begins.');
        $log = self::findOne([
            'gh_id' => $gh_id,
            'openid' => $openid,
            'mobile' => $mobile,
            'category' => $category,
        ]);
        if (empty($log)) {
            $log = new self;
            $log->gh_id = $gh_id;
            $log->openid = $openid;
            $log->mobile = $mobile;
            $log->category = $category;
            $log->amount = self::redpackAmount($category);
            
            if (WxPayApi::sendRedPack($openid, $log->amount, '会员首次关注红包')) {
                $log->sendtime = time();
                $log->save(false);
//                U::yjhu_w('sendRedpack ends.');
                return true;
            }
        }
        return false;
    }
    
    private static function redpackAmount($category) {
        if (self::CATEGORY_SMS == $category) {
            $r = rand(1, 500);
            if ($r > 498) {
                return 5000;
            } else if ($r > 488) {
                return rand(900,1100);
            } else {
                return rand(100,120);
            }
        }
    }
}
