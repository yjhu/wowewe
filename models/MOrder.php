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
	attr text NOT NULL DEFAULT '',
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
		
	
	public static function getFlowPackName()
	{
		$arr = ['0'=>'100MB', '1'=>'300MB', '2'=>'500MB', '3'=>'1GB', '4'=>'2GB', '5'=>'3GB', '6'=>'4GB', '7'=>'6GB', '8'=>'11GB'];			
		return json_encode($arr);
	}

	public static function getFlowPackFee()
	{
		$arr = ['0'=>'8', '1'=>'16', '2'=>'24', '3'=>'48', '4'=>'72', '5'=>'96', '6'=>'120', '7'=>'152', '8'=>'232'];			
		return json_encode($arr);
	}
	
	public static function getVoicePackName()
	{
		$arr = ['0'=>'200分钟', '1'=>'300分钟', '2'=>'500分钟', '3'=>'1000分钟', '4'=>'2000分钟', '5'=>'3000分钟'];			
		return json_encode($arr);
	}
		
	public static function getVoicePackFee()
	{
		$arr = ['0'=>'32', '1'=>'40', '2'=>'56', '3'=>'112', '4'=>'160', '5'=>'240'];			
		return json_encode($arr);
	}
	
	public static function getMsgPackName()
	{
		$arr = ['0'=>'200条', '1'=>'400条', '2'=>'600条', '3'=>'不选'];			
		return json_encode($arr);
	}
	
	public static function getMsgPackFee()
	{
		$arr = ['0'=>'10', '1'=>'20', '2'=>'30', '3'=>'0'];			
		return json_encode($arr);
	}	
	
	public static function getCallShowPackName()
	{
		$arr = ['0'=>'来显', '1'=>'不选'];			
		return json_encode($arr);
	}	
	
	public static function getCallShowPackFee()
	{
		$arr = ['0'=>'6', '1'=>'0'];			
		return json_encode($arr);
	}	
	
	
	public static function tableName()
	{
		return 'wx_order';
	}

	public static function generateOid()
	{
		return uniqid();
	}

	
}

/*

*/
