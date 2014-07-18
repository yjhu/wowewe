<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii cmd
C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-menu
*/

namespace app\commands;

use yii\console\Controller;
use yii\db\Query;

use app\models\U;
use app\models\WX;
use app\models\MOwner;
use app\models\MUser;


class CmdController extends Controller
{
	public function actionIndex()
	{	
		$arr = WX::WxMediaUpload('image', 'C:\\earth.jpg');
		U::W($arr);	
		return;
	
		$access_token = WX::getAccessTokenById(WX::getActiveGhId());

		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'text', 'text'=>['content'=>'how are you, huabin']];
		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'image', 'image'=>['media_id'=>'id123456']];
		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'voice', 'voice'=>['media_id'=>'id123456']];		
		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'video', 'video'=>['media_id'=>'id123456','title'=>'a', 'description'=>'b']];				
		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'music', 'music'=>['musicurl '=>'http://baidu.com', 'hqmusicurl'=>'', 'thumb_media_id'=>'123', 'title'=>'a', 'description'=>'123']];
		$articles[] = ['title'=>'title-a', 'description'=>'description-a:Analyze UA. This tool was developed for user agent string analysis. Our analysis gives you information on client SW type (browser, webcrawler, anonymizer etc.)', 'url'=>'http://hoyatech.net/wx/web/index.php', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'];
		//$articles[] = ['title'=>'title-b', 'description'=>'description-b', 'url'=>'http://baidu.com'];		
		$news = ['articles'=>$articles];
		$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'news', 'news'=>$news];
		$arr = WX::WxCustomSend($access_token, $msg);
		U::W($arr);
		return;

/*
		$openid = 'oySODt2YXO_JMcFWpFO5wyuEYX-0';
		$row = ['province'=>'hubei', 'city'=>'wuhan', 'openid'=>$openid];
		$model = MUser::findOne($openid);
		if (!$model) 
			$model = new MUser;
		U::W($row);	
//               $model->load($row);
               $model->setAttributes($row, false);
               U::W($model->getAttributes());
		if (!$model->save(false))
			U::W($model->getErrors());
		return;
*/
		echo 'ok';
	}

	//C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-menu
	public function actionCreateMenu()
	{	
		$access_token = WX::getAccessTokenById(WX::getActiveGhId());
		//$menu = \app\models\WxMenu::createDemoWxMenu();
		$menu = new \app\models\WxMenu([
			new \app\models\ButtonComplex('热卖商品', [
				new \app\models\ButtonClick('在线充值', '10'),
				new \app\models\ButtonView('自选靓号', 'http://hoyatech.net/wx/web/index.php'),
				new \app\models\ButtonView('精品商店', 'http://hoyatech.net/wx/web/index.php'),
			]),

			new \app\models\ButtonComplex('活动有礼', [
				new \app\models\ButtonClick('签到有礼', '20'),
				new \app\models\ButtonView('幸运大转盘', 'http://sina.com'),
				new \app\models\ButtonView('刮刮乐', 'http://baidu.com'),
			]),

			new \app\models\ButtonComplex('我的服务', [
				new \app\models\ButtonClick('话费查询', '30'),
				new \app\models\ButtonView('我的积分', 'http://sina.com'),
				new \app\models\ButtonView('客服小沃', '31'),
			]),
		]);

		$menu_json = json_encode($menu, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
		U::W([$menu, $menu_json]);
		$arr = WX::WxMenuCreate($access_token, $menu);
		U::W($arr);
		return;
	
/*
		$arr = WX::WxGetUserInfo($access_token, 'o6biBt5yaB7d3i0YTSkgFSAHmpdo');	
		U::W($arr);
		return;

		$arr = WX::WxMenuGet($access_token);
		$menu = $arr['menu'];
		U::W([$menu, json_encode($menu)]);		

		$menu['button'][0]['name'] = 'Button 1';
		U::W([$menu, json_encode($menu)]);
		$arr = WX::WxMenuCreate($access_token, $menu);
		U::W($arr);

		$arr = WX::WxMenuDelete($access_token);
		U::W($arr);
		return;		
*/
		echo 'ok';
	}
	
}
