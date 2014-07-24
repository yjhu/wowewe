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

class WechatXiangYangUnicom extends Wechat
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
			return $this->responseText("{$model->nickname}, 欢迎关注襄阳联通官方微信服务号！\n\n在这里，您可以逛沃商城，享沃服务，玩游戏，参与活动...... 天天惊喜，月月有奖！");
/*
			$items = array(
				new RespNewsItem("{$model->nickname}，欢迎关注襄阳联通官方微信服务号", '欢迎关注襄阳联通官方微信服务号，在这里，您可以逛沃商城，享沃服务，游戏，参与活动...... 天天惊喜，月月有奖！', '', ''),
				//new RespNewsItem("{$model->nickname}，欢迎进入襄阳联通微信营业厅", '欢迎进入襄阳联通微信营业厅', Url::to('images/onsubscribe.jpg',true), Url::to(['site/about'],true)),
				//new RespNewsItem("{$model->nickname}，欢迎进入襄阳联通微信营业厅", '欢迎进入襄阳联通微信营业厅', Url::to('images/onsubscribe.jpg',true), 'weixin://wxpay/bizpayurl?timestamp=1405737068&appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec'),
			);
			return $this->responseNews($items);
*/
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
		return Wechat::NO_RESP;
	}

	
	protected function onImage() 
	{ 
		return Wechat::NO_RESP;
	}
	
	protected function onLocation() 
	{ 
		return Wechat::NO_RESP;	
	}

	protected function onScan() 
	{
		return Wechat::NO_RESP;		
	}
	
/*
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
*/


}

