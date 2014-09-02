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
use app\models\MGh;
use app\models\MUser;
use app\models\MMobnum;
use app\models\MItem;
use app\models\MSmQueue;

use app\models\Wechat;
use app\models\MMapbd;
use app\models\MOffice;

class CmdController extends Controller
{
	public function init()
	{		
		Yii::$app->getUrlManager()->setBaseUrl('/wx/web/index.php');
		Yii::$app->getUrlManager()->setHostInfo('http://wosotech.com');
		Yii::$app->getUrlManager()->setScriptUrl('/wx/web/index.php');
		//Yii::$app->getUrlManager()->setHostInfo('http://wosotech.com');
		//Yii::$app->wx->setGhId(MGh::GH_HOYA);
		//Yii::$app->wx->setGhId(MGh::GH_WOSO);
		Yii::$app->wx->setGhId(MGh::GH_XIANGYANGUNICOM);
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd
	public function actionIndex()
	{		
		echo 'Hello, world!!';
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/sendsm
	public function actionSendsm()	
	{		
		$mobile = '15527766232';
		if (!U::mobileIsValid($mobile))
		{
			echo "$mobile is a invalid mobile number!";
			return;
		}
		U::W("balance before is ".\app\models\sm\ESmsGuodu::B());
		//$s = Yii::$app->sm->S($mobile, 'hello world', '', 'guodu', true);
		//$s = Yii::$app->sm->S($mobile, 'hello world', '', null, true);
		$s = Yii::$app->sm->S($mobile, '【襄阳联通】, 您已订购商品', '', null, true);
		U::W($s->resp);
		
		$err_code = $s->getErrorMsg();
		$className = get_class($s);				
		$err_code .= get_class($s);
		
		$smQueue = new MSmQueue;
		$smQueue->gh_id = '123';
		$smQueue->receiver_mobile = $mobile;
		$smQueue->msg = 'hello jack';
		$smQueue->err_code = $err_code;
		if ($s->isSendOk())
		{
			U::W('Send OK');
			$smQueue->status = MSmQueue::STATUS_SENT;
		}
		else 
		{
			U::W('Send ERR');
			$smQueue->status = MSmQueue::STATUS_ERR;			
		}
		$smQueue->save(false);
			
		U::W("balance after is ".\app\models\sm\ESmsGuodu::B());		
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
	//kzeng
	//d:\xampp\php\php.exe d:\xampp\htdocs\wx\yii cmd/create-menu
	public function actionCreateMenu()
	{	
		$gh_id = Yii::$app->wx->getGhid();
		if ($gh_id == MGh::GH_WOSO)
		{
			$menu = new \app\models\WxMenu([
				new \app\models\ButtonComplex('产品', [
					//new \app\models\ButtonView('精品靓号', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
					new \app\models\ButtonView('自由组合', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/diy:{$gh_id}")),
					//new \app\models\ButtonView('demo0', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx520c15f417810387&redirect_uri=http%3A%2F%2Fchong.qq.com%2Fphp%2Findex.php%3Fd%3D%26c%3DwxAdapter%26m%3DmobileDeal%26showwxpaytitle%3D1%26vb2ctag%3D4_2030_5_1194_60&response_type=code&scope=snsapi_base&state=123#wechat_redirect'),				
					new \app\models\ButtonView('demo', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf0e81c3bee622d60&redirect_uri=http%3A%2F%2Fnba.bluewebgame.com%2Foauth_response.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'),
					new \app\models\ButtonView('沃商城', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mall:{$gh_id}")),
					new \app\models\ButtonView('明星产品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/product:{$gh_id}")),
				]),
				//new \app\models\ButtonView('促销商品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/prom:{$gh_id}")),
				new \app\models\ButtonView('促销商品', "http://wosotech.com/wx/web/index.php?r=wap/prom&gh_id={$gh_id}"),
				new \app\models\ButtonComplex('我的服务', [
					new \app\models\ButtonView('我的订单', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/order:{$gh_id}")),
					//new \app\models\ButtonClick('个性化账单', 'FuncQueryAccount'),
					//new \app\models\ButtonClick('本地生活', 'FuncQueryFee'),
					//new \app\models\ButtonClick('关注', 'FuncSignon'),
					//new \app\models\ButtonClick('吐槽', 'FuncCustomService'),
					//new \app\models\ButtonView('用户吐槽', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/suggest:{$gh_id}")),
					//new \app\models\ButtonView('我要维权', Url::to(['site/index'],true)),
					//new \app\models\ButtonView('jsnative', 'http://wosotech.com/wx/web/jsnative.php'),
					//new \app\models\ButtonView('我要推广', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/tui:{$gh_id}")),
					new \app\models\ButtonView('jsphp', 'http://wosotech.com/wx/web/jsphp.php'),
					new \app\models\ButtonView('靓号运程', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/luck:{$gh_id}")),
					//new \app\models\ButtonView('游戏2048', 'http://wosotech.com/wx/webtest/2048/index.php'),
					new \app\models\ButtonView('游戏2048', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/g2048:{$gh_id}")),
                    new \app\models\ButtonView('幸运大转盘', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/disk:{$gh_id}")),
				]),
			]);
		}
		/*
		else if ($gh_id == MGh::GH_XIANGYANGUNICOM)
		{
			$menu = new \app\models\WxMenu([
				new \app\models\ButtonComplex('沃商城', [

                    new \app\models\ButtonView('自由组合套餐', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/product:{$gh_id}")),
					//new \app\models\ButtonView('幸运大转盘', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/disk:{$gh_id}")),
                    new \app\models\ButtonView('微信沃卡', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardwo:{$gh_id}")),
                    new \app\models\ButtonView('沃派校园套餐', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardxiaoyuan:{$gh_id}")),
                    new \app\models\ButtonView('特惠手机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mobilelist:{$gh_id}")),
                    //new \app\models\ButtonView('精选靓号', 'http://m.10010.com/mall-mobile/NumList/search'),
					new \app\models\ButtonView('精选靓号', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/goodnumber:{$gh_id}")),
					//new \app\models\ButtonView('微信沃卡', 'http://m.10010.com/mobilegoodsdetail/711404033449.html'),
					//new \app\models\ButtonView('精品靓号', 'http://m.10010.com/mall-mobile/NumList/search'),
					//new \app\models\ButtonView('热销终端', 'http://m.10010.com/MobileList'),
					//new \app\models\ButtonView('上网卡', 'http://m.10010.com/CardList'),
					//new \app\models\ButtonView('资费套餐', 'http://m.10010.com/'),
				]),
				//new \app\models\ButtonView('★自由组合', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
				//new \app\models\ButtonView('八月浪漫季', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203837364&idx=1&sn=e320d6d5bc60b71bdedabe25b515f93d#rd'),
				new \app\models\ButtonView('八月浪漫季', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/disk:{$gh_id}")),
				new \app\models\ButtonComplex('沃服务', [
					new \app\models\ButtonView('账单查询', 'http://wap.10010.com/t/siteMap.htm?menuId=query'),
					new \app\models\ButtonView('流量包订购', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd'),
					new \app\models\ButtonView('用户吐槽', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/suggest:{$gh_id}")),
					//new \app\models\ButtonView('关注有礼', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203837364&idx=1&sn=e320d6d5bc60b71bdedabe25b515f93d#rd'),
					new \app\models\ButtonView('我的订单', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/order:{$gh_id}")),
					//new \app\models\ButtonView('襄阳沃社区', 'http://m.10010.com/'),
					//new \app\models\ButtonView('靓号运程', Yii::$app->wx->WxGetOauth2Url('snsapi_base','wap/luck:'.Yii::$app->wx->getGhid())),
					//new \app\models\ButtonView('游戏2048', 'http://wosotech.com/wx/webtest/2048/index.htm'),
					new \app\models\ButtonView('游戏2048', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/g2048:{$gh_id}")),
				]),
			]);
		}
		*/
		else if ($gh_id == MGh::GH_XIANGYANGUNICOM)
		{
			$menu = new \app\models\WxMenu([
				new \app\models\ButtonComplex('沃商城', [
                    //new \app\models\ButtonView('沃派校园套餐', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardxiaoyuan:{$gh_id}")),
                    new \app\models\ButtonView('单卡产品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}")),
                    new \app\models\ButtonView('特惠手机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mobilelist:{$gh_id}")),
				]),
				new \app\models\ButtonComplex('沃服务', [
					new \app\models\ButtonView('账单查询', 'http://wap.10010.com/t/siteMap.htm?menuId=query'),
					new \app\models\ButtonView('流量包订购', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd'),
					new \app\models\ButtonView('用户吐槽', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/suggest:{$gh_id}")),
					new \app\models\ButtonView('游戏2048', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/g2048:{$gh_id}")),
				]),
				new \app\models\ButtonComplex('沃订单', [
					//new \app\models\ButtonView('最近营业厅', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/xxxxxx:{$gh_id}")),
					new \app\models\ButtonClick('最近营业厅', 'FuncNearestOffice'),
					new \app\models\ButtonView('我的订单', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/order:{$gh_id}")),
				]),
			]);
		}
		else
		{
			die("invalid gh_id=$gh_id");
		}
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

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/import-mobilenum
	// /usr/bin/php /mnt/wwwroot/wx/yii cmd/import-mobilenum
	public function actionImportMobilenum()
	{
/*	
$pattern = "/(?:0(?=1)|1(?=2)|2(?=3)|3(?=4)|4(?=5)|5(?=6)|6(?=7)|7(?=8)|8(?=9)){5}\d/";
//$ret = preg_match($pattern, '123456789');
$ret = preg_match($pattern, 'a234567b6789');
if ($ret)
	echo 'match';
else
	echo 'no match';
*/
	
		$num_cat = MMobnum::getNumCat(MItem::ITEM_CAT_MOBILE_IPHONE4S);		
		$file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'mobile_num.txt';
		$fh = fopen($file, "r");
		$i = 0;
		$sm_valid_cids = array();
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;

			$mobnum = trim($line);
			$ychf = 0;
			$zdxf = 0;
			$is_good = 1;

			$tableName = MMobnum::tableName();
			$n = Yii::$app->db->createCommand("REPLACE INTO $tableName (num, num_cat, ychf, zdxf, is_good) VALUES (:num, :num_cat, :ychf, :zdxf, :is_good)", [':num' => $mobnum,':num_cat' => $num_cat, ':ychf'=>$ychf, ':zdxf'=>$zdxf, ':is_good'=>$is_good])->execute();

			$i++;
			//if ($i > 2) break;
		}
		fclose($fh);	
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

			$menu = new \app\models\WxMenu([
				new \app\models\ButtonComplex('产品', [
					//new \app\models\ButtonView('精品靓号', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
					new \app\models\ButtonView('自由组合', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/diy:{$gh_id}")),
					//new \app\models\ButtonView('demo0', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx520c15f417810387&redirect_uri=http%3A%2F%2Fchong.qq.com%2Fphp%2Findex.php%3Fd%3D%26c%3DwxAdapter%26m%3DmobileDeal%26showwxpaytitle%3D1%26vb2ctag%3D4_2030_5_1194_60&response_type=code&scope=snsapi_base&state=123#wechat_redirect'),				
					new \app\models\ButtonView('demo', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf0e81c3bee622d60&redirect_uri=http%3A%2F%2Fnba.bluewebgame.com%2Foauth_response.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'),
					new \app\models\ButtonView('沃商城', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mall:{$gh_id}")),
				]),
				//new \app\models\ButtonView('促销商品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/prom:{$gh_id}")),
				new \app\models\ButtonView('促销商品', "http://wosotech.com/wx/web/index.php?r=wap/prom&gh_id={$gh_id}"),
				new \app\models\ButtonComplex('我的服务', [
					//new \app\models\ButtonClick('个性化账单', 'FuncQueryAccount'),
					new \app\models\ButtonClick('本地生活', 'FuncQueryFee'),
					//new \app\models\ButtonClick('关注', 'FuncSignon'),
					//new \app\models\ButtonClick('吐槽', 'FuncCustomService'),
					//new \app\models\ButtonView('我要维权', Url::to(['site/index'],true)),
					new \app\models\ButtonView('jsnative', 'http://wosotech.com/wx/web/jsnative.php'),
					new \app\models\ButtonView('jsphp', 'http://wosotech.com/wx/web/jsphp.php'),
					//new \app\models\ButtonView('jsjs', 'http://wosotech.com/wx/webtest/jsjs.php'),
					new \app\models\ButtonView('靓号运程', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/luck:{$gh_id}")),
					//new \app\models\ButtonView('游戏2048', 'http://wosotech.com/wx/webtest/2048/index.php'),
					new \app\models\ButtonView('游戏2048', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/g2048:{$gh_id}")),
				]),
			]);


	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/tmp
	public function actionTmp()	
	{
		set_time_limit(0);	
//		$filename =  Yii::$app->getRuntimePath()."/a.txt";
		$filename =  Yii::$app->getRuntimePath()."/b.txt";		
		$filename1 =  Yii::$app->getRuntimePath()."/b.txt";		
		$handle = @fopen($filename, "r");
		if (!$handle)
			die("fopen $filename failed");

		$i = 0;
		$rows = array();
		while (!feof($handle)) 
		{
			$data = fgets($handle);
			$data = trim($data);			
			if (empty($data))
				continue;
	    		if (strlen($data) == 0)
				continue;

			$arr = explode(' ', $data);

			$mob = $arr[0];
			$name = $arr[1];				
			$title = isset($arr[2]) ? $arr[2] : '';							

			$s = new \app\models\MStaff;


			$s->gh_id = 'gh_03a74ac96138';
			$s->name = $name;
			$s->mobile = $mob;

			$title = trim($title);
			if (empty($title))
			{
				$s->office_id = 0;			
				U::W("NO PARTMENT, $name");				
			}
			else
			{
				$model = \app\models\MOffice::findOne(['title'=>$title]);
				if ($model === null)
				{
					U::W("NOT FOUND THIS PARTMENT $title, $name");
					$s->office_id = 0;							
				}
				else
					$s->office_id = $model->office_id;
			}
			$s->save(false);
			
//			$i++;
//			if ($i>4) break;
			

		}
		fclose($handle);

	}
		
*/

