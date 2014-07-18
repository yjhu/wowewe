<?php

namespace app\models;

class RespNewsItem
{
	public $Title;
	public $Description;
	public $PicUrl;
	public $Url;

	protected $template;

	public function __construct($Title, $Description, $PicUrl, $Url)
	{
		$this->Title = $Title;
		$this->Description = $Description;
		$this->PicUrl = $PicUrl;
		$this->Url = $Url;
		$this->template = <<<XML
<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
XML;
	}

	public function __toString()
	{
		return sprintf($this->template, $this->Title, $this->Description, $this->PicUrl, $this->Url);
	}
	
}

/*
big image size 360*200
small image size 200*200
<item>
<Title><![CDATA[title1]]></Title> 
<Description><![CDATA[description1]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url>
</item>
*/
