<?php

namespace app\models;

use app\models\RespBase;

class RespImage extends RespBase
{
	public $MediaId;

	public function __construct($ToUserName, $FromUserName, $MediaId, $FuncFlag=0) 
	{
		parent::__construct($ToUserName, $FromUserName, $FuncFlag);
		$this->MsgType = 'image';		
		$this->MediaId = $MediaId;
		$this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
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
<MsgType><![CDATA[image]]></MsgType>
<Image>
<MediaId><![CDATA[media_id]]></MediaId>
</Image>
</xml>
*/
