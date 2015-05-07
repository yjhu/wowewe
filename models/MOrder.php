<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_order;
CREATE TABLE wx_order (
    oid VARCHAR(32) NOT NULL DEFAULT '',
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    scene_auto_id int(10) NOT NULL DEFAULT '0',        
    scene_id int(10) unsigned NOT NULL DEFAULT '0',    
    scene_src_id int(10) unsigned NOT NULL DEFAULT '0',    
    scene_amt int(10) NOT NULL DEFAULT '0',
    iid int(10) unsigned NOT NULL DEFAULT '0',
    feesum int(10) unsigned NOT NULL DEFAULT '0',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,    
    status int(10) unsigned NOT NULL DEFAULT '0',
    title VARCHAR(128) NOT NULL DEFAULT '',    
    select_mobnum VARCHAR(16) NOT NULL DEFAULT '',        
    attr VARCHAR(256) NOT NULL DEFAULT '',
    office_id int(10) unsigned NOT NULL DEFAULT '0',
    detail VARCHAR(512) NOT NULL DEFAULT '',
    cid int(10) unsigned NOT NULL DEFAULT '0',
    notify_id VARCHAR(256) NOT NULL DEFAULT '',
    partner VARCHAR(32) NOT NULL DEFAULT '',
    time_end VARCHAR(16) NOT NULL DEFAULT '',    
    total_fee int(10) unsigned NOT NULL DEFAULT '0',
    trade_state int(10) unsigned NOT NULL DEFAULT '0',    
    transaction_id VARCHAR(32) NOT NULL DEFAULT '',    
    appid_recv VARCHAR(64) NOT NULL DEFAULT '',
    openid_recv VARCHAR(32) NOT NULL DEFAULT '',    
    issubscribe_recv tinyint(1) unsigned NOT NULL DEFAULT '0',
    userid VARCHAR(32) NOT NULL DEFAULT '',
    username VARCHAR(16) NOT NULL DEFAULT '',
    usermobile VARCHAR(16) NOT NULL DEFAULT '',   
    address VARCHAR(256) NOT NULL DEFAULT '',
    kaitong VARCHAR(16) NOT NULL DEFAULT '',
    pay_kind tinyint(10) unsigned NOT NULL DEFAULT '0',
    aliwap_trade_no VARCHAR(64) NOT NULL DEFAULT '',
    aliwap_total_fee VARCHAR(16) NOT NULL DEFAULT '',
    aliwap_trade_status VARCHAR(32) NOT NULL DEFAULT '',
    aliwap_buyer_email VARCHAR(64) NOT NULL DEFAULT '',
    aliwap_quantity int(10) unsigned NOT NULL DEFAULT '0',
    aliwap_gmt_payment TIMESTAMP,
    memo VARCHAR(256) NOT NULL DEFAULT '',
    memo_reply VARCHAR(128) NOT NULL DEFAULT '',
    val_pkg_3g4g VARCHAR(32) NOT NULL DEFAULT '',
    val_pkg_period int(10) unsigned NOT NULL DEFAULT '0',
    val_pkg_monthprice int(10) unsigned NOT NULL DEFAULT '0',
    val_pkg_plan VARCHAR(8) NOT NULL DEFAULT '',
    czhm VARCHAR(64) NOT NULL DEFAULT '',
    wlgs int(10) unsigned NOT NULL DEFAULT '0',
    wldh VARCHAR(64) NOT NULL DEFAULT '',
    PRIMARY KEY (oid),
    KEY gh_id_oid(gh_id,oid),
    KEY gh_id_office_id(gh_id,office_id),
    KEY gh_id_aliwap_trade_no(gh_id,aliwap_trade_no),    
    KEY gh_id_idx(gh_id,openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS wx_order_arc;
CREATE TABLE wx_order_arc ENGINE=MyISAM DEFAULT CHARSET=utf8 AS SELECT * FROM wx_order where 1=2;


DROP TABLE IF EXISTS wx_t1;
CREATE TABLE wx_t1 (
    cat VARCHAR(32) NOT NULL DEFAULT '',
    mobile VARCHAR(32) NOT NULL DEFAULT '',
    product_name VARCHAR(128) NOT NULL DEFAULT '',
    in_date VARCHAR(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS wx_t2;
CREATE TABLE wx_t2 (
    cat VARCHAR(32) NOT NULL DEFAULT '',
    mobile VARCHAR(32) NOT NULL DEFAULT '',
    product_name VARCHAR(128) NOT NULL DEFAULT '',
    in_date VARCHAR(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE wx_t1 ADD KEY idx_mobile(mobile);
ALTER TABLE wx_t2 ADD KEY idx_mobile(mobile);

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MUser;
use app\models\MItem;
use app\models\MOffice;
use app\models\MSceneDetail;
use app\models\Wechat;
use yii\helpers\Url;
use app\models\MGh;
use app\models\wxpay\NativePay;
use app\models\wxpay\WxPayNotify;
use app\models\wxpay\WxPayApi;
use app\models\wxpay\WxPayData;
use app\models\wxpay\WxPayUnifiedOrder;
use app\models\wxpay\WxPayJsApiPay;
use app\models\wxpay\WxPayOrderQuery;
use app\models\wxpay\WxPayException;
use app\models\wxpay\WxPayConfig;
use app\models\wxpay\WxPayRefund;
    
class MOrder extends ActiveRecord
{
    const STATUS_DRAFT = 13;             // 订单初始状态    
    const STATUS_SUBMITTED = 0;         // 订单已提交
    const STATUS_PAID = 1;              // 订单已支付
    const STATUS_FULFILLED = 2;         // 订单已办理
    const STATUS_SUCCEEDED = 3;         // 订单成功
    const STATUS_BUYER_REFUND_CLOSED = 4;   // 用户申请退款，退款成功后，自动关闭订单
    const STATUS_SELLER_REFUND_CLOSED = 5;  // 卖家发起退款，退款成功后，自动关闭订单
    const STATUS_SELLER_ROLLBACK_CLOSED = 6;    // 线下支付，卖家发起从已办理状态至订单关闭
    const STATUS_BUYER_CLOSED = 7;      // 用户主动关闭未支付订单
    const STATUS_SELLER_CLOSED = 8;     // 卖家主动关闭未支付订单
    const STATUS_SYSTEM_CLOSED = 9;     // 系统超时关闭未支付订单      
    const STATUS_SYSTEM_SUCCEEDED = 10; // 订单已办理，用户未确认，系统超时自动成功

    const PAY_KIND_CASH = 0;
    const PAY_KIND_ALIWAP = 1;
    const PAY_KIND_WECHAT = 2;


    const WLGS_NULL = 0;
    const WLGS_SFSD = 1;
    const WLGS_TTKD = 2;


    const NO_CHOICE = 'null';
    
    public function attributeLabels()
    {
        return [
            'oid' => '订单号',
            'nickname' => '用户昵称',
            'title' => '商品名称',
            'cid' => '商品类别',
            'detail' => '商品详情',
            'feesum' => '支付金额',
            'status' => '订单状态',
            'select_mobnum'=>'手机号码',
            'create_time' => '创建时间',
            'userid' => '身份证',
            'username' => '姓名',
            'usermobile' => '联系电话',
            'address' => '收货地址',
            'kaitong' => '开通',
            'office_id' => '营业厅编号',
            'pay_kind' => '付款方式',
            'memo' => '留言',
            'memo_reply' => '备注',
            'wlgs' => '物流公司',
            'wldh' => '物流单号',
        ];
    }

    public function rules()
    {
        return [
            [['status', 'pay_kind','wlgs'], 'integer'],                 
            [['select_mobnum'],  'string', 'min' => 11, 'max' => 11],
            [['select_mobnum'],  'number'],  
            [['address'],  'string', 'min' => 5, 'max' => 256], 
            [['kaitong'],  'string', 'min' => 1, 'max' => 16],      
            [['memo_reply'],  'string', 'min' => 1, 'max' => 128],
            [['wldh'],  'string', 'min' => 1, 'max' => 64],          
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            if ($insert) {
                $this->status = MOrder::STATUS_DRAFT;
            }
            if (!empty($this->scene_id) && !empty($this->scene_amt))
            {
                if ($insert)
                {
                    $ar = new MSceneDetail;
                    $ar->scene_id = $this->scene_id;             
                    $ar->scene_src_id = $this->scene_src_id;
                    $ar->gh_id = $this->gh_id;
                    $ar->openid = $this->openid;
                    $ar->scene_amt = $this->scene_amt;
                    $ar->oid = $this->oid;
                    $ar->memo = $this->detail;                                 
                    $ar->status = $this->status == MOrder::STATUS_SUCCEEDED ? MSceneDetail::STATUS_CONFIRMED : MSceneDetail::STATUS_INIT;
                    if (!$ar->save(false))
                    {
                        U::W([__METHOD__, __LINE__, $_GET, $ar->getErrors()]);
                        return false;
                    }
                    $this->scene_auto_id = Yii::$app->db->getLastInsertID();
                }
                else
                {
                    if (($ar = MSceneDetail::findOne($this->scene_auto_id)) !== null) 
                    {
                        $ar->status = $this->status == MOrder::STATUS_SUCCEEDED ? MSceneDetail::STATUS_CONFIRMED : MSceneDetail::STATUS_INIT;
                        if (!$ar->save(false))
                        {
                            U::W([__METHOD__, __LINE__, $_GET, $ar->getErrors()]);
                            return false;
                        }                        
                    }                    
                }
            }              
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            return;
        }        
        if (isset($changedAttributes['status']) || isset($changedAttributes['pay_kind']))  {
            $this->sendTemplateNoticeToCustom();  
            if (($this->status == self::STATUS_SUBMITTED && $this->pay_kind == self::PAY_KIND_CASH) 
                    || ($this->status == self::STATUS_PAID)) {                
                $director = $this->office->director;
                if (!empty($director) && !empty($director->openid))
                    $this->sendTemplateNoticeToManager($director);
            }
        }
    }
    
    static function getOrderWuliugongsiName($key=null)
    {
        $arr = array(
            self::WLGS_NULL => '',
            self::WLGS_SFSD => '顺丰速递',
            self::WLGS_TTKD => '天天快递',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getOrderStatusName($key=null)
    {
        $arr = array(
            self::STATUS_DRAFT => '初始状态',
            self::STATUS_SUBMITTED => '已提交',
            self::STATUS_PAID => '已支付',
            self::STATUS_FULFILLED => '已办理',
            self::STATUS_SUCCEEDED => '交易成功',
            self::STATUS_BUYER_REFUND_CLOSED => '退款成功,交易关闭',
            self::STATUS_SELLER_REFUND_CLOSED => '退款成功,交易关闭',
            self::STATUS_SELLER_ROLLBACK_CLOSED => '订单撤销,交易关闭',
            self::STATUS_BUYER_CLOSED => '用户取消订单',
            self::STATUS_SELLER_CLOSED => '营业厅取消订单',
            self::STATUS_SYSTEM_CLOSED => '交易超时关闭',
            self::STATUS_SYSTEM_SUCCEEDED => '交易自动成功',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getOrderStatusOptionForOffice()
    {
        return static::getOrderStatusName();
    }

    static function getOrderPayKindOption($key=null)
    {
        $arr = array(
            self::PAY_KIND_WECHAT => '微信支付',
            self::PAY_KIND_CASH => '线下支付',
            self::PAY_KIND_ALIWAP => '支付宝支付',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    function getItemPayKindOption()
    {
        $model = MItem::findOne(['gh_id'=>$this->gh_id, 'cid'=>$this->cid]);
        if ($model === null)
            U::W('no item');
        else
        {
            U::W($model->getAttributes());
        }

        if (empty($model->ctrl_supportpay))
        {
            $arr[self::PAY_KIND_CASH] = self::getOrderPayKindOption(self::PAY_KIND_CASH);
            return $arr;
        }
        $cids = explode(',', trim($model->ctrl_supportpay));
        
        foreach ($cids as $cid)
        {
            $arr[$cid] = self::getOrderPayKindOption($cid);
        }
        return $arr;
    }
    
    public function getStatusName()
    {
        return self::getOrderStatusName($this->status);
    }
    
    private static function _getOfficeOrdersSql($office_id) {
        return "select * from ".self::tableName().
               " where office_id=".$office_id." and ".
               "( ".
                "(status = ".self::STATUS_SUBMITTED." and pay_kind = ".self::PAY_KIND_CASH.") or ".
                "(status in (".self::STATUS_PAID.", ".self::STATUS_FULFILLED.", ".self::STATUS_SUCCEEDED.", ".self::STATUS_SYSTEM_SUCCEEDED.", "
                . self::STATUS_SELLER_REFUND_CLOSED.", ".self::STATUS_SELLER_ROLLBACK_CLOSED.")) ".
                ") and ".
                "create_time > DATE_SUB(NOW(), INTERVAL 7 day) order by create_time DESC"
                ;
    } 
    
    public static function getOfficeOrdersCount($office_id)
    {
        return count(self::getOfficeOrders($office_id));
    }
    
    public static function getOfficeOrders($office_id)
    {
        return self::findBySql(self::_getOfficeOrdersSql($office_id))->all();
    }
    
    public function getUser()
    {
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        return $model;
    }

    public function getItem()
    {
        $model = MItem::findOne(['gh_id'=>$this->gh_id, 'cid'=>$this->cid]);
        return $model;
    }

    public function getOffice()
    {
        return $this->hasOne(MOffice::className(), ['office_id' => 'office_id']);
    }

    public static function getCardTypeName($json=true)
    {
        $arr = ['0'=>'普通卡', '1'=>'Micro卡', '2'=>'Nano卡'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getFlowPackName($json=true)
    {
        $arr = ['0'=>'100MB', '1'=>'300MB', '2'=>'500MB', '3'=>'1GB', '4'=>'2GB', '5'=>'3GB', '6'=>'4GB', '7'=>'6GB', '8'=>'11GB'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getFlowPackFee($json=true)
    {
        $arr = ['0'=>'10', '1'=>'20', '2'=>'30', '3'=>'60', '4'=>'90', '5'=>'120', '6'=>'150', '7'=>'190', '8'=>'290'];
        return $json? json_encode($arr) : $arr;
    }
    
    public static function getVoicePackName($json=true)
    {
        $arr = ['0'=>'200分钟', '1'=>'300分钟', '2'=>'500分钟', '3'=>'1000分钟', '4'=>'2000分钟', '5'=>'3000分钟', '999'=>'不选'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getVoicePackFee($json=true)
    {
        $arr = ['0'=>'40', '1'=>'50', '2'=>'70', '3'=>'140', '4'=>'200', '5'=>'300', '999'=>'0'];
        return $json? json_encode($arr) : $arr;
    }
    
    public static function getMsgPackName($json=true)
    {
        $arr = ['0'=>'200条', '1'=>'400条', '2'=>'600条', '999'=>'不选'];
        return $json? json_encode($arr) : $arr;
    }
    
    public static function getMsgPackFee($json=true)
    {
        $arr = ['0'=>'10', '1'=>'20', '2'=>'30', '999'=>'0'];
        return $json? json_encode($arr) : $arr;
    }    
    
    public static function getCallShowPackName($json=true)
    {
        $arr = ['0'=>'来显', '999'=>'不选'];
        return $json? json_encode($arr) : $arr;
    }    
    
    public static function getCallShowPackFee($json=true)
    {
        $arr = ['0'=>'6', '999'=>'0'];
        return $json? json_encode($arr) : $arr;
    }

    public static function getOtherPackName($json=true)
    {
        $arr = ['0'=>'炫铃', '1'=>'手机邮箱',  '2'=>'炫铃+手机邮箱', '999'=>'不选'];
        return $json? json_encode($arr) : $arr;
    }

    public static function getOtherPackFee($json=true)
    {
        $arr = ['0'=>'5', '1'=>'5','2'=>'6','999'=>'0'];
        return $json? json_encode($arr) : $arr;
    }

    public static function getModelColorName($json=true)
    {
        $arr = ['0'=>'黑', '1'=>'白'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getPromName($json=true)
    {
        $arr = ['0'=>'优惠活动'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getPlan66Name($json=true)
    {
        $arr = ['0'=>'66元A计划()', '1'=>'66元B计划()', '2'=>'66元C计划()'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getPlan96Name($json=true)
    {
        $arr = ['0'=>'96元A计划()', '1'=>'96元B计划()', '2'=>'96元C计划()'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function getPlan126Name($json=true)
    {
        $arr = ['0'=>'126元A计划()', '1'=>'126元B计划()', '2'=>'126元C计划()'];            
        return $json? json_encode($arr) : $arr;
    }

    public static function tableName()
    {
        return 'wx_order';
    }

    public static function generateOid()
    {
        return strtoupper(uniqid());
    }

    public function getWxNotice($real_pay=false)
    {
        $gh = MGh::findOne($this->gh_id);                        
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);                        
        $detail = $this->detail;
        $feesum = sprintf("%0.2f",$this->feesum/100);
        $office = MOffice::findOne($this->office_id);
        $office_info = ($office !== null) ? "至{$office->title}({$office->address}, {$office->manager}, {$office->mobile})" : '';
        $select_mobnum_info = ($this->select_mobnum == '') ?"": ", 所选手机号码为{$this->select_mobnum}";
        
        $usermobile_info = ($this->usermobile=="undefined")?"":", 联系电话{$this->usermobile}";
        $kaitong_info = ($this->kaitong == null) ?"":", {$this->kaitong}";

        $str = <<<EOD
{$model->nickname}, 您已订购【{$detail}】{$select_mobnum_info}。 订单编号【{$this->oid}】{$kaitong_info},订单金额{$feesum}元,  用户信息【{$this->username}, 身份证{$this->userid}{$usermobile_info}】。 【{$gh->nickname}】
EOD;

        return $str;
    }    

    public function getWxNoticeToManager($real_pay=false)
    {
        $gh = MGh::findOne($this->gh_id);                        
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);        
        $office = MOffice::findOne($this->office_id);
        $detail = $this->detail;
        $feesum = sprintf("%0.2f",$this->feesum/100);
        $str = <<<EOD
{$office->title}: {$model->nickname}于{$this->create_time}已订购【{$detail}】, 卡号{$this->select_mobnum}, 订单号【{$this->oid}】, 金额{$feesum}元, 用户信息【{$this->username}, 身份证{$this->userid}, 联系电话{$this->usermobile}】。 【{$gh->nickname}】
EOD;
        return $str;
    }    

    public function getSmNoticeToManager($real_pay=false)
    {
        $gh = MGh::findOne($this->gh_id);                        
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);                        
        $detail = mb_substr( $this->detail, 0, 16, 'utf-8');
        $feesum = sprintf("%0.2f",$this->feesum/100);
        $office = MOffice::findOne($this->office_id);
        $title = ($office !== null) ? mb_substr($office->title, 0, 5, 'utf-8') : '';
        $str = <<<EOD
【沃手科技】{$title}订单【{$this->oid}】,{$detail},{$feesum}元,{$this->username},电话{$this->usermobile}
EOD;
        U::W($str."...".mb_strlen($str, 'utf-8'));
        return $str;
    }    

    public function getDetailStrCore()
    {
        $str = '';
        if ($this->cid == MItem::ITEM_CAT_DIY)
        {
            list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $otherPack) = explode(',', $this->attr);
            $arr = self::getCardTypeName(false);
            if (isset($arr[$cardType]) && $cardType!='999')
                $str .= '/'.$arr[$cardType];
            
            $arr = self::getFlowPackName(false);
            if (isset($arr[$flowPack]) && $flowPack!='999')
                $str .= '/'.$arr[$flowPack].'流量包';

            $arr = self::getVoicePackName(false);
            if (isset($arr[$voicePack]) && $voicePack!='999')
                $str .= '/'.$arr[$voicePack].'语音包';

            $arr = self::getMsgPackName(false);
            if (isset($arr[$msgPack]) && $msgPack!='999')
                $str .= '/'.$arr[$msgPack].'短信包';

            $arr = self::getCallShowPackName(false);
            if (isset($arr[$callshowPack]) && $callshowPack!='999')
                $str .= '/'.$arr[$callshowPack];

            $arr = self::getOtherPackName(false);
            if (isset($arr[$otherPack]) && $otherPack!='999')
                $str .= '/'.$arr[$otherPack];

        }
        else if ($this->cid == MItem::ITEM_CAT_CARD_WO || $this->cid == MItem::ITEM_CAT_CARD_XIAOYUAN)
        {
            list($cardType) = explode(',', $this->attr);
            $arr = self::getCardTypeName(false);
            if (isset($arr[$cardType]) && $cardType!='999')
                $str .= '/'.$arr[$cardType];            
        }
        else if ($this->cid == MItem::ITEM_CAT_MOBILE_IPHONE4S || $this->cid == MItem::ITEM_CAT_MOBILE_K1 || $this->cid == MItem::ITEM_CAT_MOBILE_HTC516)
        {
            list($modelColor, $prom, $planFlag, $plan66, $plan96) = explode(',', $this->attr);
            $arr = self::getModelColorName(false);
            if (isset($arr[$modelColor]) && $modelColor!='999')
                $str .= '/'.$arr[$modelColor];            

            $arr = self::getPromName(false);
            if (isset($arr[$prom]) && $prom!='999')
                $str .= '/'.$arr[$prom];            

            if ($planFlag == 'plan66')
            {
                $arr = self::getPlan66Name(false);
                if (isset($arr[$plan66]) && $plan66!='999')
                    $str .= '/'.$arr[$plan66];            
            }
            else
            {
                $arr = self::getPlan96Name(false);
                if (isset($arr[$plan96]) && $plan96!='999')
                    $str .= '/'.$arr[$plan96];
            }
        }
        else if ($this->cid == MItem::ITEM_CAT_GOODNUMBER)
        {
            list($planFlag, $plan66, $plan96, $plan126) = explode(',', $this->attr);
            if ($planFlag == 'plan66')
            {
                $arr = self::getPlan66Name(false);
                if (isset($arr[$plan66]) && $plan66!='999')
                    $str .= '/'.$arr[$plan66];            
            }
            else if ($planFlag == 'plan96')
            {
                $arr = self::getPlan96Name(false);
                if (isset($arr[$plan96]) && $plan96!='999')
                    $str .= '/'.$arr[$plan96];
            }
            else
            {
                $arr = self::getPlan126Name(false);
                if (isset($arr[$plan126]) && $plan126!='999')
                    $str .= '/'.$arr[$plan126];
            }

        }

        $detailStr = str_replace(array('"', "'", "+", " "), '', $str);
        return $detailStr;
    }    

    public function getDetailStr()
    {
        $str = $this->title;
        $str .= $this->getDetailStrCore();
        $detailStr = str_replace(array('"', "'", "+", " "), '', $str);
        return $detailStr;            
    }    

    public function sendTemplateNoticeToManager($staff)
    {
        $user = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);        
        $office = MOffice::findOne($this->office_id);
        $kaitong_info = empty($this->kaitong) ? "" : "{$this->kaitong}";
        $detail = $this->detail." 卡号{$this->select_mobnum} {$kaitong_info}";
        $feesum = sprintf("%0.2f",$this->feesum/100);
        $first = "营业厅：{$office->title}";
        $remark = "用户信息：{$this->username}，身份证{$this->userid}，联系电话{$this->usermobile}";
        $url = '';
        $statusStr = self::getOrderStatusName($this->status);
        $payKindStr = self::getOrderPayKindOption($this->pay_kind);
        $msg = Wechat::getTemplateOrderStatusNotify($staff->openid, $url, $first, $remark, $this->oid, $detail, $this->create_time, 
                $feesum, $statusStr, $payKindStr);                
        Yii::$app->wx->setGhId($this->gh_id); 
        $arr = Yii::$app->wx->WxTemplateSend($msg);
        return $arr;
    }

    public function sendTemplateNoticeToCustom()
    {
        $user = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);        
        $office = MOffice::findOne($this->office_id);
        $kaitong_info = empty($this->kaitong) ? "" : "{$this->kaitong}";
        $detail = $this->detail." 卡号{$this->select_mobnum} {$kaitong_info}";
        $feesum = sprintf("%0.2f",$this->feesum/100);
        $first = "营业厅：襄阳联通{$office->title}";
        $remark = "用户信息：{$this->username}，身份证{$this->userid}，联系电话{$this->usermobile}";
        $url = Url::to(['order', 'gh_id'=>$this->gh_id, 'openid'=>$this->openid], true);
        $statusStr = static::getOrderStatusName($this->status);
        $payKindStr = static::getOrderPayKindOption($this->pay_kind);
        $msg = Wechat::getTemplateOrderStatusNotify($this->openid, $url, $first, $remark, $this->oid, $detail, $this->create_time, $feesum, $statusStr, $payKindStr);                
        Yii::$app->wx->setGhId($this->gh_id); 
        $arr = Yii::$app->wx->WxTemplateSend($msg);
        return $arr;
    }

    public function GetJsApiParameters($UnifiedOrderResult)
    {
        require_once __DIR__."/../models/wxpay/WxPayData.php";
    
        if(!array_key_exists("appid", $UnifiedOrderResult)
        || !array_key_exists("prepay_id", $UnifiedOrderResult)
        || $UnifiedOrderResult['prepay_id'] == "")
        {
            U::W(['appid or prepay_id not exists', $UnifiedOrderResult]);
            throw new \Exception("para error");
        }
        $jsapi = new WxPayJsApiPay();
        $jsapi->SetAppid($UnifiedOrderResult["appid"]);
        $timeStamp = (string)time();
        $jsapi->SetTimeStamp($timeStamp);
        $jsapi->SetNonceStr(WxPayApi::getNonceStr());
        $jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
        $jsapi->SetSignType("MD5");
        $jsapi->SetPaySign($jsapi->MakeSign());
        $parameters = json_encode($jsapi->GetValues());
        return $parameters;
    }

    public function GetOrderJsApiParameters()
    {
        require_once __DIR__."/../models/wxpay/WxPayData.php";
    
        $input = new WxPayUnifiedOrder();
        $input->SetBody($this->detail);
        //$input->SetAttach("test");
        $input->SetOut_trade_no($this->oid);
        $input->SetTotal_fee("{$this->feesum}");
        if ($this->openid == MGh::GH_XIANGYANGUNICOM_OPENID_KZENG || $this->openid == MGh::GH_XIANGYANGUNICOM_OPENID_HBHE) {
            $input->SetTotal_fee("1");
        }
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 3600));
        //$input->SetGoods_tag("test");
        $input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($this->openid);
        $unifiedOrder = WxPayApi::unifiedOrder($input);
        U::W($unifiedOrder);
        $jsApiParameters = $this->GetJsApiParameters($unifiedOrder);
        //U::W($jsApiParameters);        
        return $jsApiParameters;    
    }
    
/*
    Array
    (
        [appid] => wx1b122a21f985ea18
        [err_code] => ORDERNOTEXIST
        [err_code_des] => 订单不存在
        [mch_id] => 1234585602
        [nonce_str] => OxhI6dxTH9qS3vqj
        [result_code] => FAIL
        [return_code] => SUCCESS
        [return_msg] => OK
        [sign] => B502261BBADFD3124ADA6079CB9121CD
    )

Array
    (
        [appid] => wx1b122a21f985ea18
        [cash_fee] => 1
        [cash_refund_fee] => 1
        [coupon_refund_count] => 0
        [coupon_refund_fee] => 0
        [mch_id] => 1234585602
        [nonce_str] => qZt8kYwlzOjOpssF
        [out_refund_no] => 55494FDD0B01C
        [out_trade_no] => 55494F7511D58
        [refund_channel] => Array
            (
            )

        [refund_fee] => 1
        [refund_id] => 2001230398201505060004685282
        [result_code] => SUCCESS
        [return_code] => SUCCESS
        [return_msg] => OK
        [sign] => 8FE0AE9C2D0323953227853EFCC69641
        [total_fee] => 1
        [transaction_id] => 1001230398201505060111550271
    )    
*/
    public function refund($status)
    {
        if ($this->openid == MGh::GH_XIANGYANGUNICOM_OPENID_KZENG ||$this->openid == MGh::GH_XIANGYANGUNICOM_OPENID_HBHE) {
           $this->feesum = 1;
        }
    
        require_once __DIR__."/../models/wxpay/WxPayData.php";

        $input = new WxPayRefund();
        $input->SetOut_trade_no($this->oid);
        $input->SetTotal_fee($this->feesum);
        $input->SetRefund_fee($this->feesum);
        $input->SetOut_refund_no(MOrder::generateOid());
        $input->SetOp_user_id(WxPayConfig::MCHID);
        //U::W([__METHOD__, $input]);        
        $result = WxPayApi::refund($input);
        U::W([__METHOD__, $result]);
        if ($result["return_code"] == "SUCCESS" && $result["result_code"] == "SUCCESS") {
            $this->status = $status;
            $this->save(false);
        }        
        return $result;
    }    
}

