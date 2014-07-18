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
		Yii::$app->getUrlManager()->setHostInfo('http://hoyatech.net');
		//Yii::$app->wx->setGhId('gh_78539d18fdcc');		// hoya
		Yii::$app->wx->setGhId('gh_1ad98f5481f3');		// woso		
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
				new \app\models\ButtonView('精品靓号', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
				new \app\models\ButtonView('自由组合', 'http://m.10010.com/mobilegoodsdetail/981403121719.html'),
				new \app\models\ButtonView('热销终端', 'http://m.10010.com/MobileList'),
				new \app\models\ButtonView('沃商城', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mall:'.Yii::$app->wx->getGhid())),
			]),
			new \app\models\ButtonView('促销商品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/promotion:'.Yii::$app->wx->getGhid())),
			new \app\models\ButtonComplex('我的服务', [
				new \app\models\ButtonClick('个性化账单', 'FuncQueryAccount'),
				new \app\models\ButtonClick('本地生活', 'FuncQueryFee'),
				new \app\models\ButtonClick('关注', 'FuncSignon'),
				new \app\models\ButtonClick('吐槽', 'FuncCustomService'),
				new \app\models\ButtonView('我要维权', Url::to(['site/index'],true)),
			]),
		]);

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

