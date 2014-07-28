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
	const STATE_CHANGE_MOBILE = 'CHANGE_MOBILE';	
	const STATE_DEPARTMENT = 'DEPARTMENT';		
	const STATE_MENU_ONE = 'MENU_ONE';
	const PROMPT_MENU_ONE = <<<EOD
Please select:
1. Get my personal qr image
2. Query my score
3. Get my department qr image
4. Get my department score
5. Change my mobile number
6. Change my department
0. Exit
EOD;

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

	protected function getOfficePrompt($gh_id) 
	{ 
	
		$offices = \app\models\MOffice::find(['gh_id'=>$gh_id])->asArray()->all();		
		$str = "Please select office:\n";
		foreach($offices as $office)
		{
			$str .= "{$office['office_id']}. {$office['title']}\n";
		}
		$str .= "0. Exit";
		return $str;		
	}

	protected function onText() 
	{ 
		$openid = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');	
		while(1)
		{
			$Content = $this->getRequest('Content');
			$msg = trim($Content);
			if ($msg == '0')
			{
				U::W('deleteState');
				$this->deleteState($gh_id, $openid);
				return $this->responseText("thank you, bye!");				
			}
				
			$state = $this->getState($gh_id, $openid);
			//U::W($state);
			switch ($state) 
			{
				case self::STATE_NONE:
					if ($msg !== 'Xy')
						return Wechat::NO_RESP;
					$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
					if (empty($model->mobile))
					{	
						$this->setState($gh_id, $openid, self::STATE_MOBILE); 	
						return $this->responseText("Please enter your mobile number, 0:exit...");
					}
					else if (empty($model->office_id))
					{	
						$this->setState($gh_id, $openid, self::STATE_DEPARTMENT);
						return $this->responseText($this->getOfficePrompt($gh_id));						
					}
					else
					{
						$this->setState($gh_id, $openid, self::STATE_MENU_ONE); 	
						return $this->responseText(self::PROMPT_MENU_ONE);						
					}
					
				case self::STATE_MOBILE:
					if ((!is_numeric($msg)) ||substr($msg, 0, 1) !== '1' || strlen($msg) != 11)
						return $this->responseText("invalid mobile#!\n\n"."Please enter your mobile number, 0:exit");
					$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
					$model->mobile = $msg;
					$model->save(false);
					$this->setState($gh_id, $openid, self::STATE_DEPARTMENT);
					$str = $this->getOfficePrompt($gh_id);
					return $this->responseText("$str");

				case self::STATE_DEPARTMENT:
					if ((!is_numeric($msg)) ||$msg < 0 || $msg > 3)
						return $this->responseText("invalid department!\n\n".$this->getOfficePrompt($gh_id));
					$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
					$model->office_id = $msg;
					$model->save(false);
					$this->setState($gh_id, $openid, self::STATE_MENU_ONE); 	
					return $this->responseText(self::PROMPT_MENU_ONE);

				case self::STATE_CHANGE_MOBILE:
					if ((!is_numeric($msg)) ||substr($msg, 0, 1) !== '1' || strlen($msg) != 11)
						return $this->responseText("invalid mobile#!\n\n"."Please enter your mobile number, 0:exit");
					$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
					$model->mobile = $msg;
					$model->save(false);
					$this->setState($gh_id, $openid, self::STATE_MENU_ONE); 	
					return $this->responseText(self::PROMPT_MENU_ONE);

				case self::STATE_MENU_ONE:
					if ((!is_numeric($msg)) ||$msg < 0 || $msg > 6)					
					{
						return $this->responseText("invalid operator!\n\n".self::PROMPT_MENU_ONE);
					}						
					switch ($msg) 
					{
						case 1:
							$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
							$scene_id = $model->id;
							$log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."$scene_id.jpg";
							//U::W($log_file_path);							
							if (!file_exists($log_file_path))
							{
								$arr = $this->WxgetQRCode($scene_id);
								$url = $this->WxGetQRUrl($arr['ticket']);
								Wechat::downloadFile($url, $log_file_path);	
							}
							$msg = ['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>'how to use qr image? <a href="http://baidu.com">Click me</a>']];
							$arr = $this->WxMessageCustomSend($msg);
							return $this->responseLocalImage('image', $log_file_path);
						case 2:
							return $this->responseText("your score is 90");							
						case 3:
							return $this->responseText("this is your department qr image");
						case 4:
							return $this->responseText("your department score is 90");
						case 5:
							$this->setState($gh_id, $openid, self::STATE_CHANGE_MOBILE);
							return $this->responseText("Please enter your mobile number, 0:exit");							
						case 6:
							$this->setState($gh_id, $openid, self::STATE_DEPARTMENT);
							return $this->responseText($this->getOfficePrompt($gh_id));
						default:
							return $this->responseText("sorry, i don't understand you");
					}					
					return $this->responseText(self::PROMPT_MENU_ONE);
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

/*
		//return $this->responseText("you sent $Content, ".$this->WxGetOauth2Url('snsapi_userinfo')); 
		//return $this->responseText('weixin://wxpay/bizpayurl?appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec&timestamp=1405737068'); 
			//$msg = '13545222924';
			//$this->setState($gh_id, $openid, self::STATE_MOBILE); 	
			//$msg = '2';
			//$this->setState($gh_id, $openid, self::STATE_DEPARTMENT); 	


*/

