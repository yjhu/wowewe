<?php

namespace app\models;

use app\models\RespBase;

class RespTransfer extends RespBase
{
       public $KfAccount;
       
	public function __construct($ToUserName, $FromUserName, $KfAccount=null)
	{
		parent::__construct($ToUserName, $FromUserName, 0);
		$this->MsgType = 'transfer_customer_service';
		$this->KfAccount = $KfAccount;
		if (empty($this->KfAccount))
		{
		    $this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
</xml>
XML;
            }
            else
            {
		    $this->template = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<TransInfo>
<KfAccount>%s</KfAccount>
</TransInfo>
</xml>
XML;
            }
	}

	public function __toString()
	{
	       if (empty($this->KfAccount)) 
    		    return sprintf($this->template, $this->ToUserName, $this->FromUserName, time(), $this->MsgType);
    		else
    		    return sprintf($this->template, $this->ToUserName, $this->FromUserName, time(), $this->MsgType, $this->KfAccount);
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
