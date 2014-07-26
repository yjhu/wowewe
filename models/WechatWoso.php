<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

use app\models\U;
use app\models\Wechat;
use app\models\WxException;
use app\models\MUser;

use app\models\RespText;
use app\models\RespImage;
use app\models\RespNews;
use app\models\RespNewsItem;
use app\models\RespMusic;

class WechatWoso extends Wechat
{
	protected function onSubscribe() 
	{
		$MsgType = $this->getRequest('MsgType');
		$Event = $this->getRequest('Event');    
		$EventKey = $this->getRequest('EventKey');
		if (!empty($EventKey))
		{
			//a new user subscribe us with qr parameter, EventKey:qrscene_123123
			$Ticket = $this->getRequest('Ticket');
			return $this->responseText($this->getRequestString());			
		}
		else
		{
			$FromUserName = $this->getRequest('FromUserName');
			$gh_id = $this->getRequest('ToUserName');			
			$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);
			$items = array(
				new RespNewsItem("{$model->nickname}，欢迎进入沃手科技官方微信号", '欢迎进入沃手科技官方微信号', Url::to('images/onsubscribe.jpg',true), Url::to(['site/about'],true)),
				//new RespNewsItem("{$model->nickname}，欢迎进入沃手科技官方微信号", '欢迎进入沃手科技官方微信号', Url::to('images/onsubscribe.jpg',true), 'weixin://wxpay/bizpayurl?timestamp=1405737068&appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec'),
			);
			return $this->responseNews($items);
		}
	}

	protected function onUnsubscribe() 
	{ 
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);		
		if ($model !== null)
		{
			//$model->delete();		
			$model->subscribe = 0;
			$model->save(false);
		}
		return '';
	}

	const STATE_NONE = 'NONE';	
	const STATE_MOBILE = 'MOBILE';
	const STATE_DEPARTMENT = 'DEPARTMENT';	
	const STATE_MENU_1 = 'MENU_1';	
	
	protected function getState($gh_id, $openid) 
	{ 
		$key = "STATE_{$gh_id}_{$openid}";
		$state = Yii::$app->cache->get($key);
		return $state === false ? self::STATE_NONE : $state;
	}
	
	protected function setState($gh_id, $openid, $state) 
	{ 
		$key = "STATE_{$gh_id}_{$openid}";
		Yii::$app->cache->set($key, $state, 3600);	
	}

	protected function deleteState($gh_id, $openid) 
	{ 
		$key = "STATE_{$gh_id}_{$openid}";
		Yii::$app->cache->delete($key);	
	}
	
	protected function onText() 
	{ 
		$openid = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');	
		//$Content = $this->getRequest('Content');
		//return $this->responseText("you sent $Content, ".$this->WxGetOauth2Url('snsapi_userinfo')); 
		//return $this->responseText('weixin://wxpay/bizpayurl?appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec&timestamp=1405737068'); 
		while(1)
		{
			$Content = $this->getRequest('Content');
			$msg = trim($Content);

			$msg = '13545222924';

			if ($msg == '0')
				$this->deleteState($gh_id, $openid);
				
			$state = $this->getState($gh_id, $openid);
			switch ($state) 
			{
				case self::STATE_NONE:
					if ($msg !== 'xiangyang')
						return Wechat::NO_RESP;
					$this->setState($gh_id, $openid, self::STATE_MOBILE); 	
					return $this->responseText("Please enter your mobile number, 0:exit");
					
				case self::STATE_MOBILE:
					if (substr($msg, 0, 1) !== '1' || strlen($msg) != 11)
						return $this->responseText("invalid mobile number, please enter again, 0:exit");
					$this->setState($gh_id, $openid, self::STATE_DEPARTMENT); 	
					$str = <<<EOD
					1. wuhange
					2. hongsan
					3. hankou
					0. exit
EOD;
					return $this->responseText("$str");

				case self::STATE_DEPARTMENT:
					if (!($msg > 1 && $msg < 3))
						return $this->responseText("invalid department, please enter again, 0:exit");
					$this->setState($gh_id, $openid, self::STATE_MENU_1); 	
					$str = <<<EOD
					1. get my personal qr image
					2. query my score
					3. get my department qr image
					4. get my department score
					5. change my department					
					0. exit
EOD;
					return $this->responseText("$str");

				case self::STATE_MENU_1:
					if (!($msg > 1 && $msg < 5))
					{
						$str = <<<EOD
						1. get my personal qr image
						2. query my score
						3. get my department qr image
						4. get my department score
						5. change my department					
						0. exit
EOD;
						return $this->responseText("invalid department, please enter again\n\n{$str}");
					}						

					switch ($msg) 
					{
						case 1:
							return $this->responseText("this is your qr image");
						case 2:
							return $this->responseText("your score is 90");							
						case 3:
							return $this->responseText("this is your department qr image");
						case 4:
							return $this->responseText("your department score is 90");														
						default:
							return $this->responseText("sorry, i don't understand you");
					}					
					return $this->responseText("$str");
				}
		}
	}
	
	protected function onImage() 
	{ 
		return $this->responseImage($this->getRequest('MediaId')); 
	}
	
	protected function onClick()
	{ 
		$func = $this->getRequest('EventKey');		
		if (method_exists($this, $func))
			return $this->$func();			
		return $this->responseText("Click $func, this method does not exist");			
	}

	protected function onLocation() 
	{ 
		$FromUserName = $this->getRequest('FromUserName');
		$ToUserName = $this->getRequest('ToUserName');
		$CreateTime = $this->getRequest('CreateTime');
		$MsgType = $this->getRequest('MsgType');
		$MsgId = $this->getRequest('MsgId');
		$Location_X = $this->getRequest('Location_X');
		$Location_Y = $this->getRequest('Location_Y');
		$Scale = $this->getRequest('Scale');
		$Label = $this->getRequest('Label');		
		return $this->responseText($this->getRequestString()); 
	}

	protected function onScan() 
	{
		//a old subscribed user scan qr with scene_id
		$MsgType = $this->getRequest('MsgType');
		$Event = $this->getRequest('Event');    
		$EventKey = $this->getRequest('EventKey');
		$Ticket = $this->getRequest('Ticket');
		return $this->responseText($this->getRequestString());			
	}

	public function FuncCustomService() 
	{ 
		$items = array(
			new RespNewsItem('襄阳联通微商城正式上线', '襄阳联通微商城正式上线', Url::to('images/item/53a9477b995e3.png',true), Url::to(['site/about'],true)),
			new RespNewsItem('新款热销商品推荐', '新款热销商品推荐', Url::to('images/item/53a95b64d03c1_b.png',true), Url::to(['site/about'],true)),
		);
		return $this->responseNews($items);
	}

	public function FuncQueryFee() 
	{ 
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);				
		if ($model === null)
			return '';

		//test native url begin		
		$productId = '1234';
		$url = Yii::$app->wx->create_native_url($productId);		
		//$tag = Html::a('click here to pay', $url);
		//U::W($tag);
		$url = 'weixin://wxpay/bizpayurl?appid=wx79c2bf0249ede62a&noncestr=Vs7Roypb122HLZCh&productid=1234&sign=1ae0ca345323847ec8684254535c1157522e8e02&timestamp=1405751645';
		$tag = "<a href=\"$url\">click here to pay</a>";
		U::W($tag);		
		//end
//		return $this->responseText("{$model->nickname}, your fee is ".rand(0, 1000). ' '.$tag.' '.$url);
		return $this->responseText("{$model->nickname}, your fee is ".rand(0, 1000). ' '.$url);
	}	

	public function FuncSignon() 
	{ 
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);				
		return $this->responseText("{$model->nickname}, Thanks for your Signon today");
	}	

	public function FuncChargeOnline() 
	{ 
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);				
		return $this->responseText("{$model->nickname}, Charge online, are you sure?");
	}


	public function FuncQueryAccount()
	{
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);		        
		if ($model === null)
		{
			//return $this->responseText("openid 不存在.");
			U::W("This identity does not exist, openid={$FromUserName}");
			throw new \yii\web\HttpException(500, "This identity does not exist, openid={$FromUserName}");
		}
		else
		{
			$url = Html::a('请先绑定',Url::to(['wap/account','openid'=>$FromUserName, 'gh_id'=>$gh_id],true));
			if(empty($model->mobile))
				return $this->responseText("{$model->nickname}, 您的手机还未绑定{$url}.");
			else
			{
				// return $this->responseText("{$model->nickname}, 您绑定的手机号码是 ". $model->mobile);
				//返回图文消息
				$items = array(
					new RespNewsItem('话费账单', '话费账单概况：168元', Url::to('images/item/53a9477b995e3.png',true), Url::to(['wap/billDetail', 'openid'=>$FromUserName, 'gh_id'=>$gh_id],true)),
				);
				return $this->responseNews($items);                
			}
		}
	}

}

