<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_order;
CREATE TABLE wx_order (
	oid VARCHAR(32) NOT NULL DEFAULT '',
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	iid int(10) unsigned NOT NULL DEFAULT '0',
	total_fee int(10) unsigned NOT NULL DEFAULT '0',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,	
	status int(10) unsigned NOT NULL DEFAULT '0',
	title VARCHAR(128) NOT NULL DEFAULT '',
	attr VARCHAR(256) NOT NULL DEFAULT '',
	detail VARCHAR(512) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (oid),
	KEY gh_id_idx(gh_id,openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class MOrder extends ActiveRecord
{
	const ITEM_CAT_DIY = 0;

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
		$arr = ['0'=>'200条', '1'=>'400条', '2'=>'600条', '3'=>'不选'];			
		return $json? json_encode($arr) : $arr;
	}
	
	public static function getMsgPackFee($json=true)
	{
		$arr = ['0'=>'10', '1'=>'20', '2'=>'30', '3'=>'0'];			
		return $json? json_encode($arr) : $arr;
	}	
	
	public static function getCallShowPackName($json=true)
	{
		$arr = ['0'=>'来显', '1'=>'不选'];			
		return $json? json_encode($arr) : $arr;
	}	
	
	public static function getCallShowPackFee($json=true)
	{
		$arr = ['0'=>'6', '1'=>'0'];			
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

	public function getDetailStr()
	{
		if ($this->cid == self::ITEM_CAT_DIY)
		{
			//$str = '';		
			$str = $this->title;		
			list($cardType,$flowPack,$voicePack,$msgPack,$callshowPack) = explode(',', $this->attr);
			
			$arr = self::getFlowPackName(false);
			$str .= isset($arr[$flowPack]) ? $arr[$flowPack] : '';
			
			$arr = self::getVoicePackName(false);
			$str .= isset($arr[$voicePack]) ? $arr[$voicePack] : '';			

			$arr = self::getMsgPackName(false);
			$str .= isset($arr[$msgPack]) ? $arr[$msgPack] : '';			

			$arr = self::getCallShowPackName(false);
			$str .= isset($arr[$callshowPack]) ? $arr[$callshowPack] : '';			

			$detailStr = str_replace(array('"', "'", "/", "+", " "), '', $str);
			//U::W("$detailStr ------");			
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
