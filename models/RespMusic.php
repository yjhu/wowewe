<?php

namespace app\models;

use app\models\RespBase;

class RespMusic extends RespBase
{
	public $Title;
	public $Description;
	public $MusicUrl;
	public $HQMusicUrl;
	public $ThumbMediaId;	

	public function __construct($ToUserName, $FromUserName, $Title, $Description, $MusicUrl, $HQMusicUrl, $ThumbMediaId, $FuncFlag=0) 
	{
		parent::__construct($ToUserName, $FromUserName, $FuncFlag);
		$this->MsgType = 'music';		
		$this->Title = $Title;
		$this->Description = $Description;
		$this->MusicUrl = $MusicUrl;
		$this->HQMusicUrl = $HQMusicUrl;
		$this->ThumbMediaId = $ThumbMediaId;		
		$this->template = <<<XML
<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>    
  </Music>
  <FuncFlag>%s</FuncFlag>
</xml>
XML;

	}

	public function __toString()
	{
		return sprintf($this->template,$this->ToUserName, $this->FromUserName, time(), $this->MsgType, $this->Title, $this->Description, $this->MusicUrl, $this->HQMusicUrl, $this->ThumbMediaId, $this->FuncFlag);		
	}
	
}

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
<Music>
<Title><![CDATA[TITLE]]></Title>
<Description><![CDATA[DESCRIPTION]]></Description>
<MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
<HQMusicUrl><![CDATA[HQ_MUSIC_Url]]></HQMusicUrl>
<ThumbMediaId><![CDATA[media_id]]></ThumbMediaId>
</Music>
</xml>
*/
