<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_order;
CREATE TABLE wx_order (
    oid VARCHAR(32) NOT NULL DEFAULT '',
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
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
    pay_kind tinyint(10) unsigned NOT NULL DEFAULT '0',
    aliwap_trade_no VARCHAR(64) NOT NULL DEFAULT '',
    aliwap_total_fee VARCHAR(16) NOT NULL DEFAULT '',
    aliwap_trade_status VARCHAR(32) NOT NULL DEFAULT '',
    aliwap_buyer_email VARCHAR(64) NOT NULL DEFAULT '',
    aliwap_quantity int(10) unsigned NOT NULL DEFAULT '0',
    aliwap_gmt_payment TIMESTAMP,
    memo VARCHAR(256) NOT NULL DEFAULT '',
    val_pkg_3g4g VARCHAR(32) NOT NULL DEFAULT '',
    val_pkg_period int(10) unsigned NOT NULL DEFAULT '0',
    val_pkg_monthprice int(10) unsigned NOT NULL DEFAULT '0',
    val_pkg_plan VARCHAR(8) NOT NULL DEFAULT '',
    PRIMARY KEY (oid),
    KEY gh_id_oid(gh_id,oid),
    KEY gh_id_office_id(gh_id,office_id),
    KEY gh_id_aliwap_trade_no(gh_id,aliwap_trade_no),    
    KEY gh_id_idx(gh_id,openid)
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
use app\models\MOffice;

class MOrder extends ActiveRecord
{
    const STATUS_AUTION = 0;
    const STATUS_OK = 3;        
    const STATUS_CLOSED_USER = 7;        
    const STATUS_CLOSED_AUTO = 9;            
//    const STATUS_PAYED = 1;        
//    const STATUS_SHIPPED = 2;
//    const STATUS_CLOSED_OFFICE = 8;    

    const PAY_KIND_CASH = 0;
    const PAY_KIND_ALIWAP = 1;
    const PAY_KIND_WECHAT = 2;

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
            'office_id' => '营业厅编号',
            'pay_kind' => '付款方式',
            'memo' => '留言',
        ];
    }

    public function rules()
    {
        return [
            [['status', 'pay_kind'], 'integer'],                    
            [['select_mobnum'],  'string', 'min' => 11, 'max' => 11],
            [['select_mobnum'],  'number'],  
            [['address'],  'string', 'min' => 5, 'max' => 256],          
        ];
    }

    static function getOrderStatusName($key=null)
    {
        $arr = array(
            self::STATUS_AUTION => '等待付款',
            self::STATUS_OK => '交易成功',
            self::STATUS_CLOSED_USER => '用户取消订单',
            self::STATUS_CLOSED_AUTO => '超时自动取消订单',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getOrderStatusOptionForOffice()
    {
        $arr = array(
            self::STATUS_AUTION => '等待付款',
            self::STATUS_OK => '交易成功',
            self::STATUS_CLOSED_USER => '取消订单',
        );        
        return $arr;
    }

    static function getOrderPayKindOption($key=null)
    {
        $arr = array(
            self::PAY_KIND_CASH => '自取',
            self::PAY_KIND_ALIWAP => '支付宝',
            self::PAY_KIND_WECHAT => '微信支付',
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

    public function getUser()
    {
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
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
        return uniqid();
    }

    public function getWxNotice($real_pay=false)
    {
        $gh = MGh::findOne($this->gh_id);                        
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);                        
        $detail = $this->detail;
        $feesum = sprintf("%0.2f",$this->feesum/100);
        $office = MOffice::findOne($this->office_id);
        $office_info = ($office !== null) ? "至{$office->title}({$office->address}, {$office->manager}, {$office->mobile})" : '';
        $str = <<<EOD
{$model->nickname}, 您已订购【{$detail}】, 手机号码为{$this->select_mobnum}。 订单编号为【{$this->oid}】, 订单金额为{$feesum}元, 用户信息为【{$this->username}, 身份证{$this->userid}, 联系电话{$this->usermobile}】。 请您在48小时内携身份证或相关证件{$office_info}办理, 逾期将自动关闭。 【{$gh->nickname}】
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
【{$gh->nickname}】{$title}订单【{$this->oid}】,{$detail},{$feesum}元,{$this->username},电话{$this->usermobile}
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

            //$str .= '/'.$selectNum;
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
    
}

/*        
DROP TABLE IF EXISTS wx_order_arc;
CREATE TABLE wx_order_arc LIKE wx_order;

DROP TABLE IF EXISTS wx_order_arc;
CREATE TABLE wx_order_arc ENGINE=MyISAM DEFAULT CHARSET=utf8 AS SELECT * FROM wx_order where 1=2;

ALTER TABLE wx_order ADD userid VARCHAR(32) NOT NULL DEFAULT '', ADD username VARCHAR(16) NOT NULL DEFAULT '', ADD usermobile VARCHAR(16) NOT NULL DEFAULT '';

    $flowPackName = ['0'=>'100MB', '1'=>'300MB', '2'=>'500MB', '3'=>'1GB', '4'=>'2GB', '5'=>'3GB', '6'=>'4GB', '7'=>'6GB', '8'=>'11GB'];

    $flowPackFee = ['0'=>'8', '1'=>'16', '2'=>'24', '3'=>'48', '4'=>'72', '5'=>'96', '6'=>'120', '7'=>'152', '8'=>'232'];            

    $voicePackName = ['0'=>'200分钟', '1'=>'300分钟', '2'=>'500分钟', '3'=>'1000分钟', '4'=>'2000分钟', '5'=>'3000分钟'];            

    $voicePackFee = ['0'=>'32', '1'=>'40', '2'=>'56', '3'=>'112', '4'=>'160', '5'=>'240'];            

    $msgPackName = ['0'=>'200条', '1'=>'400条', '2'=>'600条', '3'=>'不选'];            

    $msgPackFee = ['0'=>'10', '1'=>'20', '2'=>'30', '3'=>'0'];            

    $callShowPackName = ['0'=>'来显', '1'=>'不选'];            

    $callShowPackFee = ['0'=>'6', '1'=>'0'];

    public static function getFlowPackName()
    {
        return json_encode($this->flowPackName);
    }

    public static function getFlowPackFee()
    {
        return json_encode($this->flowPackFee);
    }
    
    public static function getVoicePackName()
    {
        return json_encode($this->voicePackName);
    }
        
    public static function getVoicePackFee()
    {
        return json_encode($this->voicePackFee);
    }
    
    public static function getMsgPackName()
    {
        return json_encode($this->msgPackName);
    }
    
    public static function getMsgPackFee()
    {
        return json_encode($this->msgPackFee);
    }    
    
    public static function getCallShowPackName()
    {
        return json_encode($this->callShowPackName);
    }    
    
    public static function getCallShowPackFee()
    {
        return json_encode($this->callShowPackFee);
    }
    
    public function getDetailStrCore()
    {
        if ($this->cid == MItem::ITEM_CAT_DIY)
        {
            list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $otherPack, $selectNum) = explode(',', $this->attr);

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
                $str .= '/'.$arr[$callshowPack].'来电显示';

            $arr = self::getOtherPackName(false);
            if (isset($arr[$otherPack]) && $otherPack!='999')
                $str .= '/'.$arr[$otherPack].;

            $str .= '/'.$selectNum;

            $detailStr = str_replace(array('"', "'", "+", " "), '', $str);
            return $detailStr;
        }
    }    

    public function getWxNotice($real_pay=false)
    {
        if ($this->cid == MItem::ITEM_CAT_DIY)
        {
            $gh = MGh::findOne($this->gh_id);                        
            $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);                        
            $office = MOffice::findOne($this->office_id);    
            
            list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $otherPack, $selectNum) = explode(',', $this->attr);
            
            $arr = self::getCardTypeName(false);
            $cardTypeStr = isset($arr[$cardType]) ? $arr[$cardType] : '';
            $arr = self::getFlowPackName(false);
            $flowPackStr = isset($arr[$flowPack]) ? $arr[$flowPack] : '';
            $arr = self::getVoicePackName(false);
            $voicePackStr = isset($arr[$voicePack]) ? $arr[$voicePack] : '';
            $arr = self::getMsgPackName(false);
            $msgPackStr = isset($arr[$msgPack]) ? $arr[$msgPack] : '';
            $arr = self::getCallShowPackName(false);
            $callshowPackStr = isset($arr[$callshowPack]) ? $arr[$callshowPack] : '';
            $str = <<<EOD
【{$gh->nickname}】{$model->nickname}您的订单号{$this->oid}已生成。
购买商品:{$this->title}
卡类型:{$cardTypeStr}
流量包:{$flowPackStr}
语音包:{$voicePackStr}
短信包:{$msgPackStr}
来电显示:{$callshowPackStr}
卡号:{$selectNum}
EOD;
            return $str;
        }
    }    


            $arr = self::getCardTypeName(false);
            $cardTypeStr = isset($arr[$cardType]) ? $arr[$cardType] : '';
            $arr = self::getFlowPackName(false);
            $flowPackStr = isset($arr[$flowPack]) ? $arr[$flowPack] : '';
            $arr = self::getVoicePackName(false);
            $voicePackStr = isset($arr[$voicePack]) ? $arr[$voicePack] : '';
            $arr = self::getMsgPackName(false);
            $msgPackStr = isset($arr[$msgPack]) ? $arr[$msgPack] : '';
            $arr = self::getCallShowPackName(false);
            $callshowPackStr = isset($arr[$callshowPack]) ? $arr[$callshowPack] : '';

            $str = <<<EOD
{$model->nickname}，您已订购:{$this->title}【{$cardTypeStr}/{$flowPackStr}流量包/..】，手机号码为{$selectNum}。订单编号为xx,订单金额为yy。请您在48小时内至xx(addrees,mobile)办理。【{$gh->nickname}】



                {$this->oid}已生成。
购买商品:{$this->title}
卡类型:{$cardTypeStr}
流量包:{$flowPackStr}
语音包:{$voicePackStr}
短信包:{$msgPackStr}
来电显示:{$callshowPackStr}
卡号:{$selectNum}
EOD;
            return $str;

        if ($this->cid == MItem::ITEM_CAT_DIY)
        {
            list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $otherPack) = explode(',', $this->attr);
            $str = <<<EOD
{$model->nickname},您已订购【{$detail}】,手机号码为{$selectNum}。订单编号为【{$this->oid}】,订单金额为{$feesum}元。请您在48小时内至{$office->title}({$office->address},{$office->manager},{$office->mobile})办理,逾期自动关闭。【{$gh->nickname}】
EOD;
            return $str;
        }
        else if ($this->cid == MItem::ITEM_CAT_CARD_WO)
        {
            list($cardType) = explode(',', $this->attr);
            $str = <<<EOD
{$model->nickname},您已订购【{$detail}】,手机号码为{$selectNum}。订单编号为【{$this->oid}】,订单金额为{$feesum}元。请您在48小时内至{$office->title}({$office->address},{$office->manager},{$office->mobile})办理,逾期自动关闭。【{$gh->nickname}】
EOD;
            return $str;
        }
        else if ($this->cid == MItem::ITEM_CAT_CARD_XIAOYUAN)
        {
            list($cardType) = explode(',', $this->attr);
            $str = <<<EOD
{$model->nickname},您已订购【{$detail}】,手机号码为{$selectNum}。订单编号为【{$this->oid}】,订单金额为{$feesum}元。请您在48小时内至{$office->title}({$office->address},{$office->manager},{$office->mobile})办理,逾期自动关闭。【{$gh->nickname}】
EOD;
            return $str;
        }
        else
            return 'Error';

//ALTER TABLE wx_order ADD select_mobnum VARCHAR(16) NOT NULL DEFAULT '' after title;
        
    public function getWxNoticeToManager($real_pay=false)
    {
        $gh = MGh::findOne($this->gh_id);                        
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);                        
        $office = MOffice::findOne($this->office_id);
        $detail = $this->detail;
        $feesum = sprintf("%0.2f",$this->feesum/100);
        //$create_time = substr($model->create_time, 0, 10);
        $str = <<<EOD
{$office->title}, 用户{$model->nickname}于{$model->create_time} 在微信营业厅成功下单, 订单信息如下:
订单号: 【{$this->oid}】
商品: 【{$detail}】, 
卡号: {$this->select_mobnum}, 
金额: {$feesum}元
姓名: {$this->username}
身份证: {$this->userid}
联系电话: {$this->usermobile}】
【{$gh->nickname}】
EOD;
            return $str;
    }    
            
        $str = <<<EOD
【{$gh->nickname}】{$office->title}: {$model->nickname}已订购【{$detail}】, 卡号{$this->select_mobnum}, 订单号【{$this->oid}】, 金额{$feesum}元, 用户信息【{$this->username}, 身份证{$this->userid}, 联系电话{$this->usermobile}】
EOD;


        
ALTER TABLE wx_order ADD pay_kind tinyint(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_order ADD aliwap_trade_no VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE wx_order ADD aliwap_total_fee VARCHAR(16) NOT NULL DEFAULT '';
ALTER TABLE wx_order ADD aliwap_trade_status VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_order ADD aliwap_buyer_email VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE wx_order ADD aliwap_quantity int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_order ADD aliwap_gmt_payment TIMESTAMP;

ALTER TABLE wx_order ADD KEY gh_id_aliwap_trade_no(gh_id,aliwap_trade_no);
    
DROP TABLE IF EXISTS wx_order_arc;
CREATE TABLE wx_order_arc ENGINE=MyISAM DEFAULT CHARSET=utf8 AS SELECT * FROM wx_order where 1=2;

//给卖家留言
ALTER TABLE wx_order ADD memo VARCHAR(256) NOT NULL DEFAULT '';


ALTER TABLE wx_order ADD val_pkg_3g4g VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_order ADD val_pkg_period int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_order ADD val_pkg_monthprice int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_order ADD val_pkg_plan VARCHAR(8) NOT NULL DEFAULT '';

ALTER TABLE wx_order ADD address VARCHAR(256) NOT NULL DEFAULT '';
*/
