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
use app\models\MAccessLog;
use app\models\MAccessLogAll;
use app\models\MUser;
use app\models\MGh;
use app\models\MOffice;
use app\models\MStaff;
use app\models\MGroup;
use app\models\MSceneDetail;

use app\models\RespText;
use app\models\RespImage;
use app\models\RespNews;
use app\models\RespNewsItem;
use app\models\RespMusic;
use app\models\RespTransfer;

class WechatHoya extends Wechat
{

    protected function saveAccessLogAll($params=[]) 
    {
        $request = $this->getRequest();
        $log = new MAccessLogAll;
        $log->setAttributes($request, false);
        $log->save(false);
    }

    protected function saveAccessLog($params=[]) 
    {
        $request = $this->getRequest();
        //U::W($request);            
        $log = new MAccessLog;
        $log->setAttributes($request, false);
        $log->setAttributes($params, false);
        //U::W($log->getAttributes()); 
        $log->save(false);
    }
    
    protected function onSubscribe($isNewFan) 
    {            
        $FromUserName = $this->getRequest('FromUserName');    
        $openid = $this->getRequest('FromUserName');        
        $gh_id = $this->getRequest('ToUserName');                
        $MsgType = $this->getRequest('MsgType');
        $Event = $this->getRequest('Event');    
        $EventKey = $this->getRequest('EventKey');
        $user = $this->getUser();
        if ($isNewFan || $FromUserName==MGh::GH_Hoya_OPENID_KZENG || $FromUserName==MGh::GH_Hoya_OPENID_HBHE)  
            $this->saveAccessLog();

        /*
        $url_1 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_CARD], true)."\">单卡产品</a>";
        $url_2 = "<a href=\"".Url::to(['wap/mobilelist', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">特惠手机</a>";
        $url_3 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_INTERNET_CARD], true)."\">8折包年上网卡</a>"; 
        $url_4 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_FLOW_CARD], true)."\">5折专享流量包</a>";
        $url_5 = "<a href=\"http://wsq.qq.com/reflow/263163652-1044?_wv=1&source=\">用户吐槽</a>";
        $url_6 = "<a href=\"http://m.wsq.qq.com/263163652\">襄阳沃社区</a>";
        $url_7 = "<a href=\"".Url::to(['wap/g2048', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">游戏2048</a>";
        $url_8 = "<a href=\"".Url::to(['wap/nearestoffice', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">最近营业厅</a>";
        $url_9 = "<a href=\"".Url::to(['wap/order', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">您的订单</a>";
        $url_10 = "<a href=\"http://lm.10010.com/wolm/ot/guideDetail.html\">沃联盟</a>";
        */

        $url_ltsjyyt = "<a href=\"http://wap.10010.com/t/query/queryRealTimeFeeInfo.htm?menuId=000200010001\">话费查询</a>";//手机营业厅
        $url_hfcz = "<a href=\"http://upay.10010.com/npfwap/npfMobWap/bankcharge/index.html?version=null&desmobile=8E2104B024B5116C9EA24F8EE55A29A8#/bankcharge\">话费充值</a>";
        $url_ltsjsc = "<a href=\"http://m.10010.com/\">手机商城</a>";
        $url_wxdp = "<a href=\"".Url::to(['wap/wlmshop', 'gh_id'=>$gh_id], true)."\">微信店铺</a>";
        $url_4gyw = "<a href=\"".Url::to(['wap/show4ginfo', 'gh_id'=>$gh_id], true)."\">数信业务</a>";
        $url_sxyw = "<a href=\"".Url::to(['wap/showpage', 'gh_id'=>$gh_id], true)."\">数信业务</a>";
        $url_dzl = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_FLOW_CARD], true)."\">5折专享流量包</a>";

        $url_1 = "查话费,查流量，请访问沃服务->{$url_ltsjyyt}；\n";
        $url_2 = "充话费，请访问沃服务->{$url_hfcz}，全网最低9.85折；\n";
        //$url_3 = "挑号码，选手机，请访问沃业务->{$url_ltsjsc}，或沃业务->{$url_wxdp}；\n";
        $url_3 = "挑号码，选手机，请访问沃业务->{$url_wxdp}；\n";

        //$url_4 = "了解并订购联通的{$url_4gyw}，{$url_sxyw}，或其他业务，请访问下面的菜单“沃业务”；\n";
        //$url_5 = "了解联通的服务内容，请访问下面的菜单“沃服务”；\n";
        $url_6 = "了解更多联通业务、资讯和服务内容，请访问下面的菜单系统；\n\n";
        //$url_7 = "另，如果您是联通3G用户，现在微信平台订购3G省内流量包，可专享3个月5折话费返还，{$url_dzl}办理！\n";
        $url_8 = "您如果还有其他问题，请微信平台留言，或直接致电10010，我们会有客服帮助您！\n";
        //$url_all = $url_1.$url_2.$url_3.$url_4.$url_5.$url_6.$url_7.$url_8;
        //$url_all = $url_1.$url_2.$url_3.$url_6.$url_7.$url_8;
        $url_all = $url_1.$url_2.$url_3.$url_6.$url_8;

        if (!empty($EventKey))
        {        
            //a new fan subscribe with qr parameter, EventKey:qrscene_3
            $Ticket = $this->getRequest('Ticket');    
            $scene_pid = substr($EventKey, 8);    
            //U::W("EventKey=$EventKey, scene_pid=$scene_pid");
            
            if ($isNewFan || $FromUserName==MGh::GH_Hoya_OPENID_KZENG || $FromUserName==MGh::GH_Hoya_OPENID_HBHE)  
            {                 
                //if father is office, move it to the office group
                $office = MOffice::find()->where("gh_id = :gh_id AND scene_id = :scene_id", [':gh_id'=>$gh_id, ':scene_id'=>$scene_pid])->one();
                if ($office !== null)
                {
                    $mg = MGroup::findOne(['gh_id'=>$gh_id, 'office_id'=>$office->office_id]);
                    if ($mg === null)
                        U::W([__METHOD__, "group does not exists!, {$office->office_id}"]);                                            
                    $user->gid = $mg->gid;
                    $arr =  $this->WxGroupMoveMember($FromUserName, $mg->gid);
                }            

                $user->scene_pid = $scene_pid;                            
                $user->save(false);

                // insert cash into MSceneDetail
                $father = MUser::findOne(['gh_id'=>$gh_id, 'scene_id'=>$scene_pid]);
                if ($father !== null)
                {
                    $ar = new MSceneDetail;
                    $ar->gh_id = $father->gh_id;
                    $ar->openid = $father->openid;
                    $ar->scene_id = $father->scene_id;
                    $ar->cat = MSceneDetail::CAT_FAN;
                    $ar->scene_amt = 100;
                    $ar->memo = '推荐粉丝';
                    $ar->openid_fan = $openid;
                    if (!$ar->save(false))
                        U::W([__METHOD__, __LINE__, $_GET, $ar->getErrors()]);
                }
            }    
            else
            {
                U::W("SORRY, $FromUserName IS NOT NEW, can not be considered a fan");
            }
                
            $nickname = empty($user->nickname) ? '' : $user->nickname;            
            //return $this->responseText("{$nickname}, 您好, 欢迎进入厚亚科技服务号! \n\n您可以逛逛沃商城, 看看【{$url_1}】,【{$url_2}】, 还有【{$url_3}】和【{$url_4}】; \n\n沃服务:来【{$url_5}】和【{$url_6}】与数十万联通用户一起聊聊襄阳的那些事儿, 玩玩【{$url_7}】, 查询【{$url_8}】, 管理【{$url_9}】; \n\n您还可以参与【{$url_10}】, \"成功面前你不孤单，致富路上有沃相伴\", \"快速赚钱, 只需4步\"!");
            return $this->responseText("{$nickname}, 您好, /:rose 欢迎进入厚亚科技服务号!/:showlove么么哒~\n\n{$url_all}");
        }
        else
        {
            $nickname = empty($user->nickname) ? '' : $user->nickname;            
            //return $this->responseText("{$nickname}, 您好, 欢迎进入厚亚科技服务号! \n\n您可以逛逛沃商城, 看看【{$url_1}】,【{$url_2}】, 还有【{$url_3}】和【{$url_4}】; \n\n沃服务:来【{$url_5}】和【{$url_6}】与数十万联通用户一起聊聊襄阳的那些事儿, 玩玩【{$url_7}】, 查询【{$url_8}】, 管理【{$url_9}】; \n\n您还可以参与【{$url_10}】, \"成功面前你不孤单，致富路上有沃相伴\", \"快速赚钱, 只需4步\"!");
            return $this->responseText("{$nickname}, 您好, /:rose 欢迎进入厚亚科技服务号!/:showlove么么哒~\n\n{$url_all}");
        }
    }

    protected function onUnsubscribe() 
    { 
        $FromUserName = $this->getRequest('FromUserName');
        $gh_id = $this->getRequest('ToUserName');
        $user = $this->getUser();
        $scene_pid = $user->scene_pid; 
        $user->subscribe = 0;
        //$user->scene_pid = 0;
        $user->gid = 0;
        $user->msg_cnt = 0;
        $user->save(false);

        $this->saveAccessLog(['scene_pid'=>$user->scene_pid]);

        // cancel MSceneDetail
        if ($scene_pid > 0)
        {
            $arr = MSceneDetail::findAll(['gh_id'=>$gh_id, 'scene_id'=>$scene_pid, 'openid_fan'=>$FromUserName]);
            foreach ($arr as $ar) 
            {            
                $ar->status = MSceneDetail::STATUS_CANCEL;
                if (!$ar->save(false))
                    U::W([__METHOD__, __LINE__, $_GET, $ar->getErrors()]);
            }            
        }            
        return Wechat::NO_RESP;            
    }

    protected function onText() 
    { 
        $this->saveAccessLogAll();
        $openid = $this->getRequest('FromUserName');
        $gh_id = $this->getRequest('ToUserName');    
        $Content = $this->getRequest('Content');
        $msg = trim($Content);   
     
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        $nickname = empty($model->nickname) ? '' : $model->nickname;            
       
        return $this->responseText("{$nickname}, 您好, /:rose 欢迎进入厚亚科技服务号!/:showlove么么哒~ ");
    }
    
    public function FuncNearestOffice() 
    { 
        $FromUserName = $this->getRequest('FromUserName');
        $gh_id = $this->getRequest('ToUserName');
        //$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);                
        $model = $this->getUser();
        if ($model === null)
            return Wechat::NO_RESP;    
        $sendLocationInfo = $this->getRequest('SendLocationInfo');
        $model->lat = $sendLocationInfo['Location_X'];
        $model->lon = $sendLocationInfo['Location_Y'];        
        //$model->scale = $this->getRequest('Scale');            
        $model->save(false);
        $rows = MOffice::getNearestOffices($gh_id, $model->lon, $model->lat);
        $rows = array_slice($rows, 0, 4);
        $items = [];
        $i = 0;
        foreach ($rows as $row)
        {
            //$url = "http://apis.map.qq.com/uri/v1/routeplan?type=bus&from=我的位置&fromcoord={$model->lat},{$model->lon}&to={$row['title']}&tocoord={$row['lat']},{$row['lon']}&policy=0&referer=wosotech";
            //$url = "http://api.map.baidu.com/direction?origin=latlng:{$model->lat},{$model->lon}|name:我的位置&destination=latlng:{$row['lat']},{$row['lon']}|name:{$row['title']}&mode=driving&region=襄阳&output=html&src=wosotech|wosotech";            
            $office_imgurl = '@web/images/office/'.'office'.$row['office_id'].'.jpg' ;
            $office_imgurl_160 = $office_imgurl.'-160x160.jpg';
            $url = Url::to(['wapx/nearestmap', 'gh_id'=>$gh_id, 'openid'=>$FromUserName, 'office_id'=>$row['office_id'], 'lon'=>$model->lon, 'lat'=>$model->lat], true);
            //$items[] = new RespNewsItem("{$row['title']}({$row['address']}-距离{$row['distance']}米)", $row['title'], Url::to($i == 0 ? '@web/images/nearestoffice-info.jpg' : '@web/images/metro-intro.jpg',true), $url);
            $items[] = new RespNewsItem("{$row['title']}({$row['address']}-距离{$row['distance']}米)", $row['title'], Url::to($i == 0 ? $office_imgurl : $office_imgurl_160, true), $url);
            $i++;
        }
        return $this->responseNews($items);
    }

    protected function onLocation() 
    { 
        //return Wechat::NO_RESP;    

        $FromUserName = $this->getRequest('FromUserName');
        $gh_id = $this->getRequest('ToUserName');
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);                
        if ($model === null)
            return Wechat::NO_RESP;    
            
        $model->lat = $this->getRequest('Location_X');
        $model->lon = $this->getRequest('Location_Y');
        //$model->scale = $this->getRequest('Scale');            
        $model->save(false);
        $rows = MOffice::getNearestOffices($gh_id, $model->lon, $model->lat);
        $rows = array_slice($rows, 0, 4);
        $items = [];
        $i = 0;
        foreach ($rows as $row)
        {
            //$url = "http://apis.map.qq.com/uri/v1/routeplan?type=bus&from=我的位置&fromcoord={$model->lat},{$model->lon}&to={$row['title']}&tocoord={$row['lat']},{$row['lon']}&policy=0&referer=wosotech";
            //$url = "http://api.map.baidu.com/direction?origin=latlng:{$model->lat},{$model->lon}|name:我的位置&destination=latlng:{$row['lat']},{$row['lon']}|name:{$row['title']}&mode=driving&region=襄阳&output=html&src=wosotech|wosotech";
            
            $office_imgurl = '@web/images/office/'.'office'.$row['office_id'].'.jpg' ;
            $office_imgurl_160 = $office_imgurl.'-160x160.jpg';

            $url = Url::to(['wapx/nearestmap', 'gh_id'=>$gh_id, 'openid'=>$FromUserName, 'office_id'=>$row['office_id'], 'lon'=>$model->lon, 'lat'=>$model->lat], true);
            //$items[] = new RespNewsItem("{$row['title']}({$row['address']}-距离{$row['distance']}米)", $row['title'], Url::to($i == 0 ? '@web/images/nearestoffice-info.jpg' : '@web/images/metro-intro.jpg',true), $url);
            $items[] = new RespNewsItem("{$row['title']}({$row['address']}-距离{$row['distance']}米)", $row['title'], Url::to($i == 0 ? $office_imgurl : $office_imgurl_160, true), $url);
            $i++;
        }
        return $this->responseNews($items);

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

    protected function onView() 
    {
        $this->saveAccessLogAll();
        return parent::onView();    
    }

    protected function onClick()
    {
        $this->saveAccessLogAll();
        return parent::onClick();
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
    


}

