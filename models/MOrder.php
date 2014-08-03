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
	PRIMARY KEY (oid),
	KEY gh_id_idx(gh_id,openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

//ALTER TABLE wx_order ADD office_id int(10) unsigned NOT NULL DEFAULT '0' after attr;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MItem;
use app\models\MOffice;

class MOrder extends ActiveRecord
{
	const STATUS_AUTION = 0;
	const STATUS_PAYED = 1;		
	const STATUS_SHIPPED = 2;
	const STATUS_OK = 3;		
	const STATUS_PAYED_ERR = 8;		
	const STATUS_CANCEL = 9;

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
			'create_time' => '创建时间',
		];
	}

	static function getOrderStatusName($key=null)
	{
		$arr = array(
			self::STATUS_AUTION => '等待付款',
			self::STATUS_PAYED => '已付款',
			//self::STATUS_SHIPPED => '已发货',
			self::STATUS_OK => '成功',
		);		
		return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
	}

	public function getStatusName()
	{
		return self::getOrderStatusName($this->status);
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
		$arr = ['0'=>'10', '1'=>'20', '2'=>'30', '3'=>'60', '4'=>'90', '5'=>'129', '6'=>'150', '7'=>'190', '8'=>'290'];
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

	public static function tableName()
	{
		return 'wx_order';
	}

	public static function generateOid()
	{
		return uniqid();
	}

/*
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

*/
	public function getWxNotice($real_pay=false)
	{
		if ($this->cid == MItem::ITEM_CAT_DIY)
		{
			$gh = MGh::findOne($this->gh_id);						
			$model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);						
			$office = MOffice::findOne($this->office_id);
			$detail = $this->detail;
			list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $otherPack, $selectNum) = explode(',', $this->attr);
/*			
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
*/
			$str = <<<EOD
{$model->nickname}，您已订购:{$this->title}【{$detail}】，手机号码为{$selectNum}。订单编号为{$this->oid},订单金额为{$this->feesum}。请您在48小时内至{$office->title}({$office->address},{$office->manager},{$office->mobile})办理。【{$gh->nickname}】
EOD;
			return $str;
		}
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
				$str .= '/'.$arr[$callshowPack];

			$arr = self::getOtherPackName(false);
			if (isset($arr[$otherPack]) && $otherPack!='999')
				$str .= '/'.$arr[$otherPack];

//			$str .= '/'.$selectNum;

			$detailStr = str_replace(array('"', "'", "+", " "), '', $str);
			return $detailStr;
		}
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

*/
