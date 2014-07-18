<?php

namespace app\models;

use app\models\RespBase;

class RespVideo extends RespBase
{
	public $MediaId;
	public $Title;
	public $Description;	

	public function __construct($ToUserName, $FromUserName, $MediaId, $Title, $Description, $FuncFlag=0) 
	{
		parent::__construct($ToUserName, $FromUserName, $FuncFlag);
		$this->MsgType = 'video';
		$this->MediaId = $MediaId;
		$this->Title = $Title;
		$this->Description = $Description;		
		$this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Video>
<MediaId><![CDATA[%s]]></MediaId>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
</Video>
<FuncFlag>%s</FuncFlag>
</xml>
XML;

	}

	public function __toString()
	{
		return sprintf($this->template,$this->ToUserName, $this->FromUserName, time(), $this->MsgType, $this->MediaId, $this->Title, $this->Description, $this->FuncFlag);		
	}
	
}

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
<Video>
<MediaId><![CDATA[media_id]]></MediaId>
<Title><![CDATA[title]]></Title>
<Description><![CDATA[description]]></Description>
</Video> 
</xml>
*/
