<?php

namespace app\models;

use app\models\RespBase;

class RespVoice extends RespBase
{
	public $MediaId;

	public function __construct($ToUserName, $FromUserName, $MediaId, $FuncFlag=0) 
	{
		parent::__construct($ToUserName, $FromUserName, $FuncFlag);
		$this->MsgType = 'voice';		
		$this->MediaId = $MediaId;
		$this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>
<FuncFlag>%s</FuncFlag>
</xml>
XML;

	}

	public function __toString()
	{
		return sprintf($this->template, $this->ToUserName, $this->FromUserName, time(), $this->MsgType, $this->MediaId, $this->FuncFlag);		
	}
	
}

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<Voice>
<MediaId><![CDATA[media_id]]></MediaId>
</Voice>
*/
