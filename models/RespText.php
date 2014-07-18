<?php

namespace app\models;

use app\models\RespBase;

class RespText extends RespBase
{
	const MAX_CONTENT_BYTES = 2048;
	
	public $Content;

	public function __construct($ToUserName, $FromUserName, $Content, $FuncFlag = 0)
	{
		parent::__construct($ToUserName, $FromUserName, $FuncFlag);
		$this->Content = $Content;
		$this->MsgType = 'text';
		$this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>%s</FuncFlag>
</xml>
XML;
	}

	public function __toString()
	{
		return sprintf($this->template, $this->ToUserName, $this->FromUserName, time(), $this->MsgType, $this->Content, $this->FuncFlag);
	}
	
}

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[hello]]></Content>
</xml>
*/
