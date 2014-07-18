<?php

namespace app\models;

use app\models\RespBase;

class RespNews extends RespBase
{
	const MAX_ARTICLE_COUNT = 10;
	
	public $ArticleCount;

	public $Articles = array();

	public function __construct($ToUserName, $FromUserName, $Articles, $FuncFlag=0) 
	{
		parent::__construct($ToUserName, $FromUserName, $FuncFlag);
		$this->MsgType = 'news';		
		$this->Articles = $Articles;
		$this->ArticleCount = min(self::MAX_ARTICLE_COUNT, count($this->Articles));
		$this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<ArticleCount>%d</ArticleCount>
<Articles>
%s
</Articles>
<FuncFlag>%s</FuncFlag>
</xml>
XML;
	}

	public function __toString() 
	{
		return sprintf($this->template,$this->ToUserName, $this->FromUserName, time(), $this->MsgType, $this->ArticleCount, implode($this->Articles), $this->FuncFlag);		
	}
	
}

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>2</ArticleCount>
<Articles>
<item>
<Title><![CDATA[title1]]></Title> 
<Description><![CDATA[description1]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url>
</item>
<item>
<Title><![CDATA[title]]></Title>
<Description><![CDATA[description]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url>
</item>
</Articles>
</xml> 
*/
