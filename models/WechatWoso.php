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
	
	protected function onText() 
	{ 
		$Content = $this->getRequest('Content');
		//return $this->responseText("you sent $Content, ".$this->WxGetOauth2Url('snsapi_userinfo')); 
		return $this->responseText('weixin://wxpay/bizpayurl?appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec&timestamp=1405737068'); 
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

