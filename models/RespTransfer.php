<?php

namespace app\models;

use app\models\RespBase;

class RespTransfer extends RespBase
{
	public function __construct($ToUserName, $FromUserName)
	{
		parent::__construct($ToUserName, $FromUserName, 0);
		$this->MsgType = 'transfer_customer_service';
		$this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
</xml>
XML;
	}

	public function __toString()
	{
		return sprintf($this->template, $this->ToUserName, $this->FromUserName, time(), $this->MsgType);
	}
	
}

/*
<xml>
<ToUserName><![CDATA[touser]]></ToUserName>
<FromUserName><![CDATA[fromuser]]></FromUserName>
<CreateTime>1399197672</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>

<xml>
    <ToUserName><![CDATA[touser]]></ToUserName>
    <FromUserName><![CDATA[fromuser]]></FromUserName>
    <CreateTime>1399197672</CreateTime>
    <MsgType><![CDATA[transfer_customer_service]]></MsgType>
    <TransInfo>
        <KfAccount>test1@test</KfAccount>
    </TransInfo>
</xml>

*/
