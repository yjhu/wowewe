<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_mobnum;
CREATE TABLE wx_order (
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	mobnum VARCHAR(16) NOT NULL DEFAULT '',
	price int(10) unsigned NOT NULL DEFAULT '0',
	status int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (mobnum),
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;

class MMobnum extends ActiveRecord
{
	const ITEM_CAT_DIY = 0;

	const STATUS_WAIT_AUTION = 0;
	const STATUS_WAIT_PAYED = 1;		
	const STATUS_WAIT_SHIPPED = 2;
	const STATUS_WAIT_PAYED_ERR = 3;		

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
		$arr = ['0'=>'8', '1'=>'16', '2'=>'24', '3'=>'48', '4'=>'72', '5'=>'96', '6'=>'120', '7'=>'152', '8'=>'232'];			
		return $json? json_encode($arr) : $arr;
	}
	
	public static function getVoicePackName($json=true)
	{
		$arr = ['0'=>'200分钟', '1'=>'300分钟', '2'=>'500分钟', '3'=>'1000分钟', '4'=>'2000分钟', '5'=>'3000分钟', '999'=>'不选'];			
		return $json? json_encode($arr) : $arr;
	}
		
	public static function getVoicePackFee($json=true)
	{
		$arr = ['0'=>'32', '1'=>'40', '2'=>'56', '3'=>'112', '4'=>'160', '5'=>'240', '999'=>'0'];			
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

	public static function tableName()
	{
		return 'wx_mobnum';
	}

	public static function generateOid()
	{
		return uniqid();
	}

	public function getWxNotice($real_pay=false)
	{
		if ($this->cid == self::ITEM_CAT_DIY)
		{
			$gh = MGh::findOne($this->gh_id);						
			$model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);						
			list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $selectNum) = explode(',', $this->attr);
			
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

	public function getDetail()
	{
		if ($this->cid == self::ITEM_CAT_DIY)
		{
			$str = $this->title;		
			list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack, $selectNum) = explode(',', $this->attr);

			$arr = self::getCardTypeName(false);
			if (isset($arr[$cardType]) && $cardType!='999')
				$str .= '/'.$arr[$cardType];
			
			$arr = self::getFlowPackName(false);
			if (isset($arr[$flowPack]) && $flowPack!='999')
				$str .= '/'.$arr[$flowPack];

			$arr = self::getVoicePackName(false);
			if (isset($arr[$voicePack]) && $voicePack!='999')
				$str .= '/'.$arr[$voicePack];

			$arr = self::getMsgPackName(false);
			if (isset($arr[$msgPack]) && $msgPack!='999')
				$str .= '/'.$arr[$msgPack];

			$arr = self::getCallShowPackName(false);
			if (isset($arr[$callshowPack]) && $callshowPack!='999')
				$str .= '/'.$arr[$callshowPack];

			$str .= '/'.$selectNum;

			$detailStr = str_replace(array('"', "'", "+", " "), '', $str);
			return $detailStr;
		}
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
*/