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
use app\models\MGh;
use app\models\MOffice;
use app\models\MStaff;

use app\models\RespText;
use app\models\RespImage;
use app\models\RespNews;
use app\models\RespNewsItem;
use app\models\RespMusic;

class WechatXiangYangUnicom extends Wechat
{
	protected function onSubscribe() 
	{
		$FromUserName = $this->getRequest('FromUserName');	
		$openid = $this->getRequest('FromUserName');		
		$gh_id = $this->getRequest('ToUserName');				
		$MsgType = $this->getRequest('MsgType');
		$Event = $this->getRequest('Event');    
		$EventKey = $this->getRequest('EventKey');
		if (!empty($EventKey))
		{
			//a new user subscribe us with qr parameter, EventKey:qrscene_3 qrscene_OFFICE_3
			$Ticket = $this->getRequest('Ticket');	
			$scene_pid = substr($EventKey, 8);	
			//U::W("sub....qr...., $EventKey, $scene_pid");
			
			$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);
			$model->scene_pid = $scene_pid;
			$model->save(false);
			//return $this->responseText("{$model->nickname}, 欢迎关注襄阳联通官方微信服务号！\n\n在这里，您可以逛沃商城，享沃服务，玩游戏，参与活动...... 天天惊喜，月月有奖！");
			$items = array(
				//new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('images/metro-intro.jpg',true), $this->WxGetOauth2Url('snsapi_base', "wap/home:{$gh_id}")),
				new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
			);
			return $this->responseNews($items);
		}
		else
		{
			$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);
			//return $this->responseText("{$model->nickname}, 欢迎关注襄阳联通官方微信服务号！\n\n在这里，您可以逛沃商城，享沃服务，玩游戏，参与活动...... 天天惊喜，月月有奖！");
			$items = array(
				new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
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
			$model->scene_pid = 0;
			$model->save(false);
		}
		return '';
	}

	const STATE_NONE = 'NONE';	
	const STATE_MOBILE = 'MOBILE';	
	const STATE_CHANGE_MOBILE = 'CHANGE_MOBILE';	
	const STATE_OFFICE = 'OFFICE';		
	const STATE_MENU_ONE = 'MENU_ONE';
	const PROMPT_MENU_ONE = <<<EOD
请选择:
1. 我的推广二维码
2. 我的推广人数
3. 所在部门的推广二维码
4. 所在部门的推广人数
5. 修改手机号
6. 修改所在部门
7. 解除绑定
0. 退出
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
	
		//$offices =MOffice::find(['gh_id'=>$gh_id])->asArray()->all();		
		//$offices =MOffice::find()->where(['gh_id'=>$gh_id])->asArray()->all();		
		$offices =MOffice::find()->where("gh_id = '$gh_id' AND office_id <=25 ")->asArray()->all();
		$str = "请选择部门:\n";
		foreach($offices as $office)
		{
			$str .= "{$office['office_id']}. {$office['title']}\n";
		}
		$str .= "0. 退出";
		return $str;		
	}

	protected function onText() 
	{ 
		$openid = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');	
		$Content = $this->getRequest('Content');
		$msg = trim($Content);	
		if ($msg == '我是襄阳联通员工')
		{
			$url = Url::to(['wapx/staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid, 'owner'=>1], true);
			//return $this->responseText("<a href=\"{$url}\">联通内部员工通道, 点击这里进入...</a>");
			return $this->responseText("襄阳联通内部员工通道, 参与推广, 查看成绩, <a href=\"{$url}\">请点击这里进入...</a>");
		}
		else if ($msg == '.debug')
		{
			$url = Url::to(['wapx/staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid, 'owner'=>1], true);
			return $this->responseText("see my score? <a href=\"{$url}\">click me</a>");
		}
		else
		{
			$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
			$items = array(
				new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
			);
			return $this->responseNews($items);
		}
	}

	protected function onTextOld() 
	{ 
		$openid = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');	
		while(1)
		{
			$Content = $this->getRequest('Content');
			$msg = trim($Content);	
			$state = $this->getState($gh_id, $openid);
			if ($msg == '0' && $state != self::STATE_NONE)
			{
				U::W('deleteState');
				$this->deleteState($gh_id, $openid);
				return $this->responseText("谢谢，再见!");
			}

			U::W($state);
			switch ($state) 
			{
				case self::STATE_NONE:
					//if ($msg !== 'Xy')					
					if ($msg !== '我是襄阳联通员工')
					{
						//return Wechat::NO_RESP;
						$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
						$items = array(
							new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
						);
						return $this->responseNews($items);
					}
					$model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
					if ($model === null)
					{	
						$this->setState($gh_id, $openid, self::STATE_MOBILE); 	
						return $this->responseText("请输入手机号, 0:退出");
					}
					else if (empty($model->office_id))
					{	
						$this->setState($gh_id, $openid, self::STATE_OFFICE);
						return $this->responseText($this->getOfficePrompt($gh_id));						
					}
					else
					{
						$this->setState($gh_id, $openid, self::STATE_MENU_ONE); 	
						return $this->responseText(self::PROMPT_MENU_ONE);						
					}
					break;
					
				case self::STATE_MOBILE:
					if ((!is_numeric($msg)) ||substr($msg, 0, 1) !== '1' || strlen($msg) != 11)
						return $this->responseText("无效的手机号!\n\n"."请重新输入手机号, 0:退出");

					$model = MStaff::findOne(['mobile'=>$msg]);
					if ($model === null)	
						return $this->responseText("非襄阳联通员工手机号!\n\n"."请重新输入手机号, 0:退出");					
					$model->gh_id = $gh_id;
					$model->openid = $openid;					
					$model->save(false);
					 if (empty($model->office_id))
					 {
						$this->setState($gh_id, $openid, self::STATE_OFFICE);
						$str = $this->getOfficePrompt($gh_id);
						return $this->responseText("{$model->name}，您好!\n,$str");
					}
					else
					{
						$this->setState($gh_id, $openid, self::STATE_MENU_ONE);
						return $this->responseText(self::PROMPT_MENU_ONE);
					}

				case self::STATE_OFFICE:
					//$offices =MOffice::find()->where(['gh_id'=>$gh_id])->asArray()->all();
					$offices =MOffice::find()->where("gh_id = '$gh_id' AND office_id <=25 ")->asArray()->all();					
					$office_ids = [];
					foreach($offices as $office)
						$office_ids[] = $office['office_id'];
					if ((!is_numeric($msg)) || $msg < 0 || !in_array($msg, $office_ids))
						return $this->responseText("无效的部门号!\n\n".$this->getOfficePrompt($gh_id));
					$model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
					$model->office_id = $msg;
					$model->save(false);
					$this->setState($gh_id, $openid, self::STATE_MENU_ONE); 	
					return $this->responseText(self::PROMPT_MENU_ONE);

				case self::STATE_CHANGE_MOBILE:
					if ((!is_numeric($msg)) ||substr($msg, 0, 1) !== '1' || strlen($msg) != 11)
						return $this->responseText("无效的手机号!\n\n"."请重新输入手机号, 0:退出");
					$model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);					
					$model->mobile = $msg;
					$model->save(false);
					$this->setState($gh_id, $openid, self::STATE_MENU_ONE); 	
					return $this->responseText(self::PROMPT_MENU_ONE);

				case self::STATE_MENU_ONE:
					if ((!is_numeric($msg)) ||$msg < 0 || $msg > 7)					
					{
						return $this->responseText("输入无效!\n\n".self::PROMPT_MENU_ONE);
					}						
					switch ($msg) 
					{
						case 1:
							//U::W('enter 111111');
							$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
							if (empty($model->scene_id))
							{
								$gh = MGh::findOne($gh_id);
								$scene_id = $gh->newSceneId();
								$gh->save(false);
								$model->scene_id = $scene_id;
								$model->save(false);
								//U::W("new a scene_id=$scene_id");								
							}
							else
							{
								$scene_id = $model->scene_id;
								//U::W("old scene_id=$scene_id");																
							}
							$log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
							//U::W($log_file_path);							
							if (!file_exists($log_file_path))
							{
								$arr = $this->WxgetQRCode($scene_id, true);
								$url = $this->WxGetQRUrl($arr['ticket']);
								Wechat::downloadFile($url, $log_file_path);	
							}
							//$url = Url::to(['wap/aboutqr','name'=>$model->nickname, 'qrurl'=>Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg"],true);
							$url = "http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203659175&idx=1&sn=0efaf2269fb7ba6a022f5c31d0d5e255#rd";
							//U::W($url);
							$msg = ['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>"如何使用个人的二维码? <a href=\"{$url}\">点击这里...</a>"]];
							$arr = $this->WxMessageCustomSend($msg);
							return $this->responseLocalImage('image', $log_file_path);
							
						case 2:
							$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);			
							if ($model->scene_id == 0)
								$count = 0;
							else
								$count = MUser::find()->where(['gh_id'=>$gh_id, 'scene_pid' => $model->scene_id])->count();
							return $this->responseText("你的推广人数是:{$count}\n\n".self::PROMPT_MENU_ONE);
							
						case 3:
							$staff = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
							if (empty($staff->office_id))
							{
								$this->setState($gh_id, $openid, self::STATE_OFFICE);
								return $this->responseText($this->getOfficePrompt($gh_id));
							}
							$model = MOffice::findOne($staff->office_id);
							if ($model === null)
							{
								$this->setState($gh_id, $openid, self::STATE_OFFICE);
								$str = $this->getOfficePrompt($gh_id);
								return $this->responseText("invalid office id\n,$str");
							}							
							if (empty($model->scene_id))
							{
								$gh = MGh::findOne($gh_id);
								$scene_id = $gh->newSceneId();
								$gh->save(false);
								$model->scene_id = $scene_id;
								$model->save(false);
								U::W("scene_id=$scene_id");								
							}
							else
								$scene_id = $model->scene_id;
							$log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
							//U::W($log_file_path);							
							if (!file_exists($log_file_path))
							{
								$arr = $this->WxgetQRCode($scene_id, true);
								$url = $this->WxGetQRUrl($arr['ticket']);
								Wechat::downloadFile($url, $log_file_path);	
							}
							//$msg = ['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>'如何使用部门的二维码? <a href="http://baidu.com">点击这里...</a>']];
							//$url = Url::to(['wap/aboutqr','name'=>$model->title, 'qrurl'=>Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg"],true);
							$url = "http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203659175&idx=1&sn=0efaf2269fb7ba6a022f5c31d0d5e255#rd";
							$msg = ['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>"如何使用部门的二维码? <a href=\"{$url}\">点击这里...</a>"]];
							$arr = $this->WxMessageCustomSend($msg);
							return $this->responseLocalImage('image', $log_file_path);
							
						case 4:
							$staff = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
							if (empty($staff->office_id))
							{
								$this->setState($gh_id, $openid, self::STATE_OFFICE);
								return $this->responseText($this->getOfficePrompt($gh_id));
							}		
							$model = MOffice::findOne($staff->office_id);
							if ($model === null)
							{
								$this->setState($gh_id, $openid, self::STATE_OFFICE);
								$str = $this->getOfficePrompt($gh_id);
								return $this->responseText("invalid office id\n,$str");
							}														
							if ($model->scene_id == 0)
								$count = 0;
							else
								$count = MUser::find()->where(['gh_id'=>$gh_id, 'scene_pid' => $model->scene_id])->count();
								
							//U::W($user->office_id);
							//U::W('a1111111111');								
							$staffs = MStaff::find()->where(['gh_id'=>$gh_id, 'office_id'=>$staff->office_id])->asArray()->all();
							$openids = [];
							//U::W($staffs);							
							foreach($staffs as $staff)
							{
								if (!empty($staff['openid']))
									$openids[] = $staff['openid'];
							}

							if (empty($openids))
							{
								$staff_count = 0;
							}
							else
							{
								$users = MUser::find()->where(['gh_id'=>$gh_id, 'openid'=>$openids])->asArray()->all();
								$scene_ids = [];													
								foreach($users as $user)
								{
									if ($user['scene_id'] != 0)
										$scene_ids[] = $user['scene_id'];
								}
								if (empty($scene_ids))
									$staff_count = 0;
								else														
									$staff_count = MUser::find()->where(['gh_id'=>$gh_id, 'scene_pid' => $scene_ids])->count();								
							}
							return $this->responseText("部门所属员工推广人数是:{$staff_count}\n部门推广人数是:{$count}\n\n".self::PROMPT_MENU_ONE);
							
						case 5:
							$this->setState($gh_id, $openid, self::STATE_CHANGE_MOBILE);
							return $this->responseText("请重新输入手机号, 0:退出");
							
						case 6:
							$staff = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
							$current_office_id = empty($staff->office_id) ? '' : "当前所属部门号:{$staff->office_id}\n";
							$this->setState($gh_id, $openid, self::STATE_OFFICE);
							return $this->responseText($current_office_id.$this->getOfficePrompt($gh_id));

						case 7:
							$staff = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
							if ($staff !== null)
							{
								$staff->openid = '';
								$staff->save(false);
								return $this->responseText("成功解除微信号与员工之间的绑定!\n\n".self::PROMPT_MENU_ONE);
							}
							else
								return $this->responseText("你不需要解除绑定\n\n".self::PROMPT_MENU_ONE);
							
						default:
							return $this->responseText("输入无效!\n\n".self::PROMPT_MENU_ONE);
					}					
					return $this->responseText(self::PROMPT_MENU_ONE);
				}
		}
	}
	
	protected function onLocation() 
	{ 
		return Wechat::NO_RESP;	
		
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);		
		if ($model !== null)
		{
			$model->lat = $this->getRequest('Location_X');
			$model->lon = $this->getRequest('Location_Y');
			//$model->scale = $this->getRequest('Scale');			
			$model->save(false);
		}	
		return Wechat::NO_RESP;	
	}

	protected function onEventLocation()
	{ 
		return Wechat::NO_RESP;	
		
		$FromUserName = $this->getRequest('FromUserName');
		$gh_id = $this->getRequest('ToUserName');
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);		
		if ($model !== null)
		{
			$model->lat = $this->getRequest('Latitude');
			$model->lon = $this->getRequest('Longitude');
			$model->prec = $this->getRequest('Precision');
			$model->save(false);
			U::W("{$model->lat}, {$model->lon}");			
		}	
		return Wechat::NO_RESP;
	}

	protected function onImage() 
	{ 
		return Wechat::NO_RESP;
	}

	protected function onScan() 
	{
		return Wechat::NO_RESP;		
	}

	protected function onVoice() 
	{
		return Wechat::NO_RESP;		
	}

	protected function onVideo() 
	{
		return Wechat::NO_RESP;		
	}
	
/*
	public function FuncCustomService() 
	{ 
		$items = array(
			new RespNewsItem('襄阳联通微商城正式上线', '襄阳联通微商城正式上线', Url::to('images/item/53a9477b995e3.png',true), Url::to(['site/about'],true)),
			new RespNewsItem('新款热销商品推广', '新款热销商品推广', Url::to('images/item/53a95b64d03c1_b.png',true), Url::to(['site/about'],true)),
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

/*
			$items = array(
				new RespNewsItem("{$model->nickname}，欢迎关注襄阳联通官方微信服务号", '欢迎关注襄阳联通官方微信服务号，在这里，您可以逛沃商城，享沃服务，游戏，参与活动...... 天天惊喜，月月有奖！', '', ''),
				//new RespNewsItem("{$model->nickname}，欢迎进入襄阳联通微信营业厅", '欢迎进入襄阳联通微信营业厅', Url::to('images/onsubscribe.jpg',true), Url::to(['site/about'],true)),
				//new RespNewsItem("{$model->nickname}，欢迎进入襄阳联通微信营业厅", '欢迎进入襄阳联通微信营业厅', Url::to('images/onsubscribe.jpg',true), 'weixin://wxpay/bizpayurl?timestamp=1405737068&appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec'),
			);
			return $this->responseNews($items);
*/

}

