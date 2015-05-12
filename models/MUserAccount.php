<?php
namespace app\models;


/*
#
# cat用来描述账户发生变动的几种原因
# amount为正表示产生收入, 为负表示产生支出, 
# 账户余额(user_account_balance)放在表MUser中, 因此每增加一条记录，须在MUser中修改相应的balance
#
DROP TABLE IF EXISTS wx_user_account;
CREATE TABLE wx_user_account (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    amount int(10) NOT NULL DEFAULT '0',
    status tinyint(1) unsigned NOT NULL DEFAULT '0',
    memo VARCHAR(512) NOT NULL DEFAULT '',
    cat tinyint(1) unsigned NOT NULL DEFAULT '0',
    scene_id int(10) unsigned NOT NULL DEFAULT '0',
    oid VARCHAR(32) NOT NULL DEFAULT '',
    charge_mobile VARCHAR(32) NOT NULL DEFAULT '', 
    KEY idx_gh_id_openid(gh_id, openid),    
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

class MUserAccount extends ActiveRecord
{
    private $_oldAmount;
    
    const CAT_DEBIT_FAN = 0;    
    const CAT_DEBIT_SIGN = 1;
    const CAT_DEBIT_ITEM = 2;
    const CAT_CREDIT_CHARGE_MOBILE = 100;

    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['amount', 'status', 'cat', 'scene_id'], 'integer'],
            [['gh_id', 'openid', 'oid', 'charge_mobile'], 'string', 'max' => 32],
            [['memo'], 'string', 'max' => 512]
        ];
    }

    public static function getCatOptionName($key=null)
    {
        $arr = array(
            self::CAT_DEBIT_FAN => '推荐粉丝',
            self::CAT_DEBIT_SIGN => '签到',
            self::CAT_DEBIT_ITEM => '推荐商品获取佣金 ',
            self::CAT_CREDIT_CHARGE_MOBILE => '充话费',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public function attributeLabels()
    {
        return [
            'amount'=>'发生额',
			'scene_id'=>'推广ID',
            'charge_mobile'=>'充值手机号',
            'create_time'=>'时间',
            'memo'=>'备注',
            'oid'=>'交易ID',
            'cat'=>'类型',
        ];
    }

    public static function tableName()
    {
        return 'wx_user_account';
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getOrder()
    {
        return $this->hasOne(MOrder::className(), ['oid' => 'oid']);
    }

    public function afterFind()
    {
        $this->_oldAmount = $this->amount;
        parent::afterFind();
    }

    public function beforeSave($insert)
    {    
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
//        static $items = 0;
//        static $openids = [];
        parent::afterSave($insert, $changedAttributes);
        $user = $this->user;
        if (!empty($user)) {
            if ($insert) {
                $user->user_account_balance += $this->amount;
            } else {
                $user->user_account_balance = $user->user_account_balance - $this->_oldAmount + $this->amount;
            }
//            U::W("--------MUserAccount::afterSave()");
//            U::W([++$items, $user->user_account_balance, $user->openid]);
//            if (in_array($user->openid, $openids)) {
//                U::W(["duplicate openid: ", $user->openid, $user->staff->staff_id]);
//            } else 
//                $openids[] = $user->openid;
            $user->save(false);            
        } else {
            U::W("---------------MUserAccount::afterSave()");
            U::W($this);
        }
    }    

    public function afterDelete()
    {
         $user = $this->user;
         if (!empty($user)) {
             $user->user_account_balance -= $this->amount;
             $user->save(false);
         }         
         parent::afterDelete();
    }
    
    public function getMemoInfo()
    {
        if ($this->cat == static::CAT_DEBIT_FAN) {
            return $this->memo."(推广ID:{$this->scene_id})";
        }
        if ($this->cat == static::CAT_CREDIT_CHARGE_MOBILE) {
            return $this->memo." {充值手机号:$this->charge_mobile}";
        }
        
        return $this->memo;
    }

    public function getAmountInfo()
    {
        return Yii::$app->formatter->asCurrency($this->amount/100);    
    }    
}

/*
    public function getUserFan()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid_fan']);
    }

    public static function getUserAccountStatusOption()
    {
        $arr = array(
            self::STATUS_TIXIAN_APPLY => '申请提现',
            self::STATUS_TIXIAN_OK => '提现成功',
            self::STATUS_TIXIAN_NOTOK => '提现失败',
        );        
        return $arr;
    }    

    const STATUS_INIT = 0;
    const STATUS_CONFIRMED = 1;    
    const STATUS_CANCEL = 2;

    //amt<0 means tixian
    const STATUS_TIXIAN_APPLY = 0;
    const STATUS_TIXIAN_OK = 1;    
    const STATUS_TIXIAN_NOTOK = 2;
*/

