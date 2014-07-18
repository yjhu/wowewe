<?php

namespace app\models;

use DOMDocument;
use DOMElement;
use DOMText;
use DOMCdataSection;
use app\models\ReqRespCommBase;

use yii\helpers\StringHelper;

class RespBase
{
	public $ToUserName;
	public $FromUserName;
	public $CreateTime;
	public $MsgType;
	public $FuncFlag = '0';

	protected $template;
	
	public function __construct($ToUserName, $FromUserName, $FuncFlag) {
		$this->ToUserName = $ToUserName;
		$this->FromUserName = $FromUserName;
		$this->FuncFlag = $FuncFlag;
	}
	
}

/*	
	const RESP_MSG_TYPE_TEXT = 'text';
	const RESP_MSG_TYPE_IMAGE = 'image';
	const RESP_MSG_TYPE_VOICE = 'voice';
	const RESP_MSG_TYPE_VIDEO = 'video';
	const RESP_MSG_TYPE_MUSIC = 'music';
	const RESP_MSG_TYPE_NEWS = 'news';

	public function toXmlString()
	{
		$dom = new DOMDocument();
		$root = new DOMElement('xml');
		$dom->appendChild($root);
		//$element = $root;
	       $this->buildXml($root, $this);
		$str = $dom->saveXML($root);
		return $str;
	}	

	public  function buildXml($element, $data)
	{
		$itemTag='item';
		if (is_object($data)) 
		{
			$className = StringHelper::basename(get_class($data));
			if ($className == 'RespNewsItem')
			{
				$className = 'item';        	
				$child = new DOMElement($className);
				$element->appendChild($child);
			}
			else
				$child = $element;

			if ($data instanceof Arrayable) {
				$this->buildXml($child, $data->toArray());
			} 
			else 
			{
				$array = [];				
				//foreach ($data as $name => $value) {
				//	$array[$name] = $value;
				//}				
				$names = $this->attributes();
				foreach ($names as $name) {
					$array[$name] = $this->$name;
				}
				
				$this->buildXml($child, $array);
			}
		} 
		elseif (is_array($data)) 
		{
			foreach ($data as $name => $value) 
			{
				if (is_int($name) && is_object($value)) {
					$this->buildXml($element, $value);
				} elseif (is_array($value) || is_object($value)) {
					$child = new DOMElement(is_int($name) ? $itemTag : $name);
					$element->appendChild($child);
					$this->buildXml($child, $value);
				} else {
					$child = new DOMElement(is_int($name) ? $itemTag : $name);
					$element->appendChild($child);
					if (ReqRespCommBase::needCdata($name, $value))
						$child->appendChild(new DOMText((string) $value));
					else
						$child->appendChild(new DOMCdataSection((string) $value));
				}
			}
		} 
		else 
		{
			$element->appendChild(new DOMText((string) $data));
		}
	}
    
	data['ToUserName'] = 'aaa';
	data['FromUserName'] = 'bbb';
	data['CreateTime'] = time();
	data['MsgType'] = 'music';
	data['FuncFlag'] = '0';
	data['Music'] = ['Title'=>'','Description'=>'','MusicUrl'=>'','HQMusicUrl'=>''];
	$xml = new SimpleXMLElement('<xml></xml>');	
	$this->data2xml($xml, $data);
	echo ($xml->asXML());

	data['ToUserName'] = 'aaa';
	data['FromUserName'] = 'bbb';
	data['CreateTime'] = time();
	data['MsgType'] = 'news';
	data['FuncFlag'] = '0';
	$articles = array();
	$news[] = array('Title'=>'abc1','Description'=>'desc');
	$news[] = array('Title'=>'abc2','Description'=>'desc');		
	foreach ($news as $key => $value) {
		//list($articles[$key]['Title'],$articles[$key]['Description'],$articles[$key]['PicUrl'],$articles[$key]['Url']) = $value;
		$articles[] = $value;
	}
	$data['ArticleCount'] = count($articles);
	$data['Articles'] = $articles;
	$xml = new SimpleXMLElement('<xml></xml>');	
	$this->data2xml($xml, $data);
	echo ($xml->asXML());

	//array: $data 
	private function data2xml($xml, $data, $item = 'item') 
	{
	    foreach ($data as $key => $value) 
	    {
	        is_numeric($key) && $key = $item;

	        if(is_array($value) || is_object($value)){
	            $child = $xml->addChild($key);
	            $this->data2xml($child, $value, $item);
	        } else {
	        	if(is_numeric($value)){
	        		$child = $xml->addChild($key, $value);
	        	} else {
	        		$child = $xml->addChild($key);
	                $node  = dom_import_simplexml($child);
				    $node->appendChild($node->ownerDocument->createCDATASection($value));
	        	}
	        }
	    }
	}


*/		


