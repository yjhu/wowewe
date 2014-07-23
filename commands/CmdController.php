<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii cache/flush
C:\xampp\php\php.exe C:\htdocs\wx\yii cmd
C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-menu
*/

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\db\Query;
use yii\helpers\Url;

use app\models\U;
use app\models\WX;
use app\models\MGh;
use app\models\MUser;

use app\models\Wechat;

class CmdController extends Controller
{
	public function init()
	{		
		Yii::$app->getUrlManager()->setBaseUrl('/wx/web/index.php');
		Yii::$app->getUrlManager()->setHostInfo('http://www.hoyatech.net');
		//Yii::$app->getUrlManager()->setHostInfo('http://wosotech.com');
		//Yii::$app->wx->setGhId(MGh::GH_HOYA);
		Yii::$app->wx->setGhId(MGh::GH_WOSO);
		//Yii::$app->wx->setGhId(MGh::GH_XIANGYANGUNICOM);
	}

	public function actionIndex()
	{		
		echo 'Hello, world!!';
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/group-list
	public function actionGroupList()
	{			
/*		
		$arr = Yii::$app->wx->WxGroupCreate(['group'=>['name'=>'Test']]);
		U::W("{$arr['group']['id']},{$arr['group']['name']}");		

		$arr = Yii::$app->wx->WxGroupUpdate(['group'=>['id'=>100, 'name'=>'vip']]);
		U::W($arr);
*/
		$arr = Yii::$app->wx->WxGroupMoveMember(Wechat::OPENID_TESTER1, 103);
		U::W($arr);
		
		$arr = Yii::$app->wx->WxGroupListGet();
		U::W($arr);
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/get-subscriber-list
	public function actionGetSubscriberList()
	{		
		$openids = Yii::$app->wx->WxGetSubscriberList();
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/qr-image
	public function actionQrImage()
	{	

		$scene_id = 't1';
		$arr = Yii::$app->wx->WxgetQRCode($scene_id);
		//$arr = Yii::$app->wx->WxgetQRCode('weixin://wxpay/bizpayurl?appid=wx79c2bf0249ede62a&noncestr=Vs7Roypb122HLZCh&productid=1234&sign=1ae0ca345323847ec8684254535c1157522e8e02&timestamp=1405751645');
		U::W($arr);
		$url = Yii::$app->wx->WxGetQRUrl($arr['ticket']);
		U::W($url);
		$log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."$scene_id.jpg";
		U::W($log_file_path);
		Wechat::downloadFile($url, $log_file_path);	
	}
	
	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/message-custom-send
	public function actionMessageCustomSend()
	{	
		//$msg = ['touser'=>Wechat::OPENID_TESTER1, 'msgtype'=>'text', 'text'=>['content'=>'您好, 何华斌']];
		//$msg = ['touser'=>Wechat::OPENID_TESTER1, 'msgtype'=>'image', 'image'=>['media_id'=>'id123456']];
		//$msg = ['touser'=>Wechat::OPENID_TESTER1, 'msgtype'=>'voice', 'voice'=>['media_id'=>'id123456']];		
		//$msg = ['touser'=>Wechat::OPENID_TESTER1, 'msgtype'=>'video', 'video'=>['media_id'=>'id123456','title'=>'a', 'description'=>'b']];				
		//$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'music', 'music'=>['musicurl '=>'http://baidu.com', 'hqmusicurl'=>'', 'thumb_media_id'=>'123', 'title'=>'a', 'description'=>'123']];
		$msg = [
			'touser'=>Wechat::OPENID_TESTER1, 
			'msgtype'=>'news', 
			'news'=> [
				'articles'=>[
					['title'=>'标题-A', 'description'=>'详情-A, Analyze UA. This tool was developed for user agent string analysis. Our analysis gives you information on client SW type (browser, webcrawler, anonymizer etc.)', 'url'=>'http://hoyatech.net/wx/web/index.php', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'],
					['title'=>'title-b', 'description'=>'description-b, welcome to wechat site', 'url'=>'http://hoyatech.net/wx/web/index.php', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'],
				]				
			]
		];
		$msg = ['touser'=>Wechat::OPENID_TESTER1, 'msgtype'=>'text', 'text'=>['content'=>'how are you, huabin']];
		$arr = Yii::$app->wx->WxMessageCustomSend($msg);
		U::W($arr);		
		return;	
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/media-upload
	public function actionMediaUpload()
	{	
		$arr = Yii::$app->wx->WxMediaUpload('image', 'C:\\earth.jpg');
		//U::W([$arr['type'],$arr['media_id'],$arr['created_at']]);
		return;	
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/media-download
	public function actionMediaDownload()
	{	
		//$url = Yii::$app->wx->WxMediaGetUrl('r2zUx5VVXPVclkPSUTNE3P51dAEZOe8U0UwJCCWZZxSr5UW_SqMmeUODxtjeSnZt');
		//U::W($url);		
		Yii::$app->wx->WxMediaDownload('r2zUx5VVXPVclkPSUTNE3P51dAEZOe8U0UwJCCWZZxSr5UW_SqMmeUODxtjeSnZt', 'abcd.jpg');
		return;	
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/user-info
	public function actionUserInfo()
	{	
		$arr = Yii::$app->wx->WxGetUserInfo(Wechat::OPENID_TESTER1);	
		U::W($arr);
		return;		
	}
	
	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-menu
	public function actionCreateMenu()
	{	

		$menu = new \app\models\WxMenu([
			new \app\models\ButtonComplex('产品', [
				//new \app\models\ButtonView('精品靓号', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
				new \app\models\ButtonView('自由组合', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/diy:'.Yii::$app->wx->getGhid())),
				//new \app\models\ButtonView('热销终端', 'http://m.10010.com/MobileList'),
				//new \app\models\ButtonView('demo0', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx520c15f417810387&redirect_uri=http%3A%2F%2Fchong.qq.com%2Fphp%2Findex.php%3Fd%3D%26c%3DwxAdapter%26m%3DmobileDeal%26showwxpaytitle%3D1%26vb2ctag%3D4_2030_5_1194_60&response_type=code&scope=snsapi_base&state=123#wechat_redirect'),				
				new \app\models\ButtonView('demo', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf0e81c3bee622d60&redirect_uri=http%3A%2F%2Fnba.bluewebgame.com%2Foauth_response.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'),
				new \app\models\ButtonView('沃商城', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mall:'.Yii::$app->wx->getGhid())),
				//new \app\models\ButtonView('lucy', 'http://www.hoyatech.net/wx/webtest/lucy.html'),
				//new \app\models\ButtonView('lucynew', 'http://www.hoyatech.net/wx/webtest/lucyNew.php'),
                                                                                new \app\models\ButtonView('2048', 'http://www.hoyatech.net/wx/webtest/2048/index.htm'),
			]),
//			new \app\models\ButtonView('★促销商品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/prom:'.Yii::$app->wx->getGhid())),
			new \app\models\ButtonView('★促销商品', 'http://www.hoyatech.net/wx/webtest/index.php?r=wap/prom&gh_id=gh_1ad98f5481f3'),
			new \app\models\ButtonComplex('我的服务', [
				//new \app\models\ButtonClick('个性化账单', 'FuncQueryAccount'),
				new \app\models\ButtonClick('本地生活', 'FuncQueryFee'),
				new \app\models\ButtonClick('关注', 'FuncSignon'),
				//new \app\models\ButtonClick('吐槽', 'FuncCustomService'),
				//new \app\models\ButtonView('我要维权', Url::to(['site/index'],true)),
				new \app\models\ButtonView('jsnative', 'http://www.hoyatech.net/wx/webtest/jsnative.php'),
				new \app\models\ButtonView('jsphp', 'http://www.hoyatech.net/wx/webtest/jsphp.php'),
				//new \app\models\ButtonView('jsjs', 'http://www.hoyatech.net/wx/webtest/jsjs.php'),
				new \app\models\ButtonView('靓号运程', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/luck:'.Yii::$app->wx->getGhid())),
			]),
		]);

/*
		$menu = new \app\models\WxMenu([
			new \app\models\ButtonComplex('沃商城', [
				new \app\models\ButtonView('微信沃卡', 'http://m.10010.com/mall-mobile/chseSearchList/init?keyword=%E5%BE%AE%E4%BF%A1%E6%B2%83%E5%8D%A1'),
				new \app\models\ButtonView('精品靓号', 'http://m.10010.com/mall-mobile/NumList/search'),
				new \app\models\ButtonView('热销终端', 'http://m.10010.com/MobileList'),
				new \app\models\ButtonView('上网卡', 'http://m.10010.com/CardList'),
				new \app\models\ButtonView('资费套餐', 'http://m.10010.com/'),
			]),
			new \app\models\ButtonView('自由组合', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
			new \app\models\ButtonComplex('沃服务', [
				new \app\models\ButtonView('账单查询', 'http://wap.10010.com/t/siteMap.htm?menuId=query'),
				//new \app\models\ButtonView('靓号运程', 'http://m.10010.com/'),
				new \app\models\ButtonView('襄阳沃社区', 'http://m.10010.com/'),
				
			]),
		]);
*/
		$menu_json = Wechat::json_encode($menu);
		U::W([$menu, $menu_json]);
		$arr = Yii::$app->wx->WxMenuCreate($menu);
		U::W($arr);
		return;
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/menu-get
	public function actionMenuGet()
	{	
		$arr = Yii::$app->wx->WxMenuGet();	
		U::W($arr);
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/menu-delete
	public function actionMenuDelete()
	{	
		$arr = Yii::$app->wx->WxMenuDelete();	
		U::W($arr);
		return;		
	}
	
}

/*		
		$articles[] = ['title'=>'title-a', 'description'=>'description-a:Analyze UA. This tool was developed for user agent string analysis. Our analysis gives you information on client SW type (browser, webcrawler, anonymizer etc.)', 'url'=>'http://hoyatech.net/wx/web/index.php', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'];
		$articles[] = ['title'=>'title-b', 'description'=>'description-b', 'url'=>'http://baidu.com'];		
		$news = ['articles'=>$articles];
		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'news', 'news'=>$news];

		$menu = new \app\models\WxMenu([
			new \app\models\ButtonComplex('热卖商品', [
				new \app\models\ButtonClick('在线充值', 'FuncChargeOnline'),
				new \app\models\ButtonView('自选靓号', 'http://hoyatech.net/wx/web/index.php'),
				new \app\models\ButtonView('精品商店', 'http://hoyatech.net/wx/web/index.php'),
			]),

			new \app\models\ButtonComplex('活动有礼', [
				new \app\models\ButtonClick('签到有礼', 'FuncSignon'),
				new \app\models\ButtonView('幸运大转盘', 'http://sina.com'),
				new \app\models\ButtonView('刮刮乐', 'http://baidu.com'),
			]),

			new \app\models\ButtonComplex('我的服务', [
				new \app\models\ButtonClick('话费查询', 'FuncQueryFee'),
				new \app\models\ButtonView('我的积分', 'http://sina.com'),
				new \app\models\ButtonClick('客服小沃', 'FuncCustomService'),
			]),
		]);
//		new \app\models\ButtonView('网上营业厅', Yii::$app->wx->WxGetOauth2Url('snsapi_base', urlencode(json_encode(['wap/mall','gh_id'=>Yii::$app->wx->getGhid()])))),

		new \app\models\ButtonClick('沃竞猜，猜胜负', 'FuncCustomService'),

		//$menu = new \app\models\WxMenu([
		//	new \app\models\ButtonComplex('沃4G专柜', [
		//		new \app\models\ButtonView('自由套餐', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
		//		new \app\models\ButtonView('4G套餐', 'http://m.10010.com/mobilegoodsdetail/981403121719.html'),
		//		new \app\models\ButtonView('4G手机', 'http://m.10010.com/MobileList'),
		//	]),
		//	new \app\models\ButtonView('网上营业厅', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mall:'.Yii::$app->wx->getGhid())),
		//	new \app\models\ButtonComplex('我的服务', [
		//		new \app\models\ButtonView('自助查询', Url::to(['site/about', 'id'=>1],true)),
		//		new \app\models\ButtonClick('天天抽话费', 'FuncQueryFee'),
		//		new \app\models\ButtonClick('签到送积分', 'FuncSignon'),
		//		new \app\models\ButtonClick('客服小沃', 'FuncCustomService'),
		//		new \app\models\ButtonView('我要维权', Url::to(['site/index'],true)),
		//	]),
		//]);
		
*/

