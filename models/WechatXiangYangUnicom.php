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

class WechatXiangYangUnicom extends Wechat
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
        
        if ($isNewFan || $FromUserName==MGh::GH_XIANGYANGUNICOM_OPENID_KZENG || $FromUserName==MGh::GH_XIANGYANGUNICOM_OPENID_HBHE)  
            $this->saveAccessLog();

        $url_1 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_CARD], true)."\">单卡产品</a>";
        $url_2 = "<a href=\"".Url::to(['wap/mobilelist', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">特惠手机</a>";
        $url_3 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_INTERNET_CARD], true)."\">8折包年上网卡</a>"; 
        $url_4 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_FLOW_CARD], true)."\">5折专享流量包</a>";
        $url_5 = "<a href=\"http://wsq.qq.com/reflow/263163652-1044?_wv=1&source=\">用户吐槽</a>";
        $url_6 = "<a href=\"http://m.wsq.qq.com/263163652\">襄阳沃社区</a>";
        $url_7 = "<a href=\"".Url::to(['wap/g2048', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">游戏2048</a>";
        $url_8 = "<a href=\"".Url::to(['nearestoffice', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">最近营业厅</a>";
        $url_9 = "<a href=\"".Url::to(['order', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">您的订单</a>";
        $url_10 = "<a href=\"http://lm.10010.com/wolm/ot/guideDetail.html\">沃联盟</a>";

        if (!empty($EventKey))
        {        
            //a new fan subscribe with qr parameter, EventKey:qrscene_3
            $Ticket = $this->getRequest('Ticket');    
            $scene_pid = substr($EventKey, 8);    
            //U::W("EventKey=$EventKey, scene_pid=$scene_pid");
            
            $model = $this->getUser();
            if ($isNewFan || $FromUserName==MGh::GH_XIANGYANGUNICOM_OPENID_KZENG || $FromUserName==MGh::GH_XIANGYANGUNICOM_OPENID_HBHE)  
            {                 
                //if father is office, move it to the office group
                $office = MOffice::find()->where("gh_id = :gh_id AND scene_id = :scene_id", [':gh_id'=>$gh_id, ':scene_id'=>$scene_pid])->one();
                if ($office !== null)
                {
                    $mg = MGroup::findOne(['gh_id'=>$gh_id, 'office_id'=>$office->office_id]);
                    if ($mg === null)
                        U::W([__METHOD__, "group does not exists!, {$office->office_id}"]);                                            
                    $model->gid = $mg->gid;
                    $arr =  $this->WxGroupMoveMember($FromUserName, $mg->gid);
                }            

                $model->scene_pid = $scene_pid;                            
                $model->save(false);

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
                
            $nickname = empty($model->nickname) ? '' : $model->nickname;            
            return $this->responseText("{$nickname}, 您好, 欢迎进入襄阳联通官方微信服务号! \n\n您可以逛逛沃商城, 看看【{$url_1}】,【{$url_2}】, 还有【{$url_3}】和【{$url_4}】; \n\n沃服务:来【{$url_5}】和【{$url_6}】与数十万联通用户一起聊聊襄阳的那些事儿, 玩玩【{$url_7}】, 查询【{$url_8}】, 管理【{$url_9}】; \n\n您还可以参与【{$url_10}】, \"成功面前你不孤单，致富路上有沃相伴\", \"快速赚钱, 只需4步\"!");
        }
        else
        {
            $model = $this->getUser();
            $nickname = empty($model->nickname) ? '' : $model->nickname;            
            return $this->responseText("{$nickname}, 您好, 欢迎进入襄阳联通官方微信服务号! \n\n您可以逛逛沃商城, 看看【{$url_1}】,【{$url_2}】, 还有【{$url_3}】和【{$url_4}】; \n\n沃服务:来【{$url_5}】和【{$url_6}】与数十万联通用户一起聊聊襄阳的那些事儿, 玩玩【{$url_7}】, 查询【{$url_8}】, 管理【{$url_9}】; \n\n您还可以参与【{$url_10}】, \"成功面前你不孤单，致富路上有沃相伴\", \"快速赚钱, 只需4步\"!");
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
            $ar = MSceneDetail::findOne(['gh_id'=>$gh_id, 'scene_id'=>$scene_pid, 'openid_fan'=>$FromUserName]);
            if ($ar !== null) 
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

        $url_1 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_CARD], true)."\">单卡产品</a>";
        $url_2 = "<a href=\"".Url::to(['wap/mobilelist', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">特惠手机</a>";
        $url_3 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_INTERNET_CARD], true)."\">8折包年上网卡</a>"; 
        $url_4 = "<a href=\"".Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_FLOW_CARD], true)."\">5折专享流量包</a>";
        $url_5 = "<a href=\"http://wsq.qq.com/reflow/263163652-1044?_wv=1&source=\">用户吐槽</a>";
        $url_6 = "<a href=\"http://m.wsq.qq.com/263163652\">襄阳沃社区</a>";
        $url_7 = "<a href=\"".Url::to(['wap/g2048', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">游戏2048</a>";
        $url_8 = "<a href=\"".Url::to(['nearestoffice', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">最近营业厅</a>";
        $url_9 = "<a href=\"".Url::to(['order', 'gh_id'=>$gh_id, 'openid'=>$openid], true)."\">您的订单</a>";
        $url_10 = "<a href=\"http://lm.10010.com/wolm/ot/guideDetail.html\">沃联盟</a>";


        if ($msg == '我是襄阳联通员工')
        {
            $url = Url::to(['wapx/staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid, 'owner'=>1], true);
            $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
            if ($user !== null && $user->is_liantongstaff == 0)
            {
                $user->is_liantongstaff = 1;
                $user->save(false);
            }
            return $this->responseText("襄阳联通内部员工通道, 参与推广, 查看成绩, <a href=\"{$url}\">请点击这里进入...</a>");
        }
        else if ($msg == '.debug')
        {
            //$url = Url::to(['wapx/staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid, 'owner'=>1], true);
            $url = Url::to(['wap/testpay', 'gh_id'=>$gh_id, 'openid'=>$openid, 'owner'=>1], true);
            return $this->responseText("Test only <a href=\"{$url}\">clickme</a>\n----------\n <a href=\"http://m.wsq.qq.com/263163652\">wsq</a>    \n----------\n  <a href=\"http://www.baidu.com/?surf_token=a40aeb590b4674cad5c74246ba41bd9f\">active wifi</a>");
        }
        else if ($msg == '.woke')
        {
            $url1 = Url::to(['wap/woke', 'gh_id'=>$gh_id, 'openid'=>$openid ], true);
            $urlStr1 = "<a href=\"{$url1}\">Test woke page</a>\n\n ";

            $url2 = Url::to(['wap/wokelist', 'gh_id'=>$gh_id, 'openid'=>$openid ], true);
            $urlStr2 = "<a href=\"{$url2}\">Test wokelist page</a>\n\n ";

            $urlStr = $urlStr1.$urlStr2;
            return $this->responseText($urlStr);
        }
        else
        {

            $arr = $this->WxGetOnlineKfList();

            /*
            if (count($arr) > 0)
                return $this->responseTransfer();
            */
            
            $auto_accept = 0;
            $accepted_case = 0;

            foreach ($arr as $a1) {
                U::W($a1);
                $auto_accept = $auto_accept + (int)$a1["auto_accept"];
                $accepted_case = $accepted_case + (int)$a1["accepted_case"];
            }

            U::W($auto_accept."-----------\n");
            U::W($accepted_case."-----------\n");

            if(($auto_accept-$accepted_case)>0)
                return $this->responseTransfer();

            //$txt = U::callSimsimi($msg);
            //return $this->responseText($txt);
            
            $kfStr = "客服人员暂时不在线。";

            $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
            $nickname = empty($model->nickname) ? '' : $model->nickname;            
            return $this->responseText("{$nickname}, 您好, 欢迎进入襄阳联通官方微信服务号! {$kfStr}\n\n您可以逛逛沃商城, 看看【{$url_1}】,【{$url_2}】, 还有【{$url_3}】和【{$url_4}】; \n\n沃服务:来【{$url_5}】和【{$url_6}】与数十万联通用户一起聊聊襄阳的那些事儿, 玩玩【{$url_7}】, 查询【{$url_8}】, 管理【{$url_9}】; \n\n您还可以参与【{$url_10}】, \"成功面前你不孤单，致富路上有沃相伴\", \"快速赚钱, 只需4步\"!");

        }
        
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

/*
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
                            new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('@web/images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
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

    public function FuncCustomService() 
    { 
        $items = array(
            new RespNewsItem('襄阳联通微商城正式上线', '襄阳联通微商城正式上线', Url::to('@web/images/item/53a9477b995e3.png',true), Url::to(['site/about'],true)),
            new RespNewsItem('新款热销商品推广', '新款热销商品推广', Url::to('@web/images/item/53a95b64d03c1_b.png',true), Url::to(['site/about'],true)),
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
//        return $this->responseText("{$model->nickname}, your fee is ".rand(0, 1000). ' '.$tag.' '.$url);
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
                    new RespNewsItem('话费账单', '话费账单概况：168元', Url::to('@web/images/item/53a9477b995e3.png',true), Url::to(['wap/billDetail', 'openid'=>$FromUserName, 'gh_id'=>$gh_id],true)),
                );
                return $this->responseNews($items);                
            }
        }
    }
            $items = array(
                new RespNewsItem("{$model->nickname}，欢迎关注襄阳联通官方微信服务号", '欢迎关注襄阳联通官方微信服务号，在这里，您可以逛沃商城，享沃服务，游戏，参与活动...... 天天惊喜，月月有奖！', '', ''),
                //new RespNewsItem("{$model->nickname}，欢迎进入襄阳联通微信营业厅", '欢迎进入襄阳联通微信营业厅', Url::to('@web/images/onsubscribe.jpg',true), Url::to(['site/about'],true)),
                //new RespNewsItem("{$model->nickname}，欢迎进入襄阳联通微信营业厅", '欢迎进入襄阳联通微信营业厅', Url::to('@web/images/onsubscribe.jpg',true), 'weixin://wxpay/bizpayurl?timestamp=1405737068&appid=wx79c2bf0249ede62a&noncestr=PSottf4eivpHqKlV&productid=1234&sign=e1f9bca3625bfd1bdb4753906753c9f13917f0ec'),
            );
            return $this->responseNews($items);
            //return $this->responseText("{$model->nickname}, 欢迎关注襄阳联通官方微信服务号！\n\n在这里，您可以逛沃商城，享沃服务，玩游戏，参与活动...... 天天惊喜，月月有奖！");

        $FromUserName = $this->getRequest('FromUserName');
        $gh_id = $this->getRequest('ToUserName');
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);                
        if ($model === null)
            return '';
        //if ($model->lon < 1)
        {
            $items = array(
                new RespNewsItem('附近营业厅查询', '如果你需要查询附近的营业厅，请点击文字输入框旁边的+号,把你的位置发给小沃, 即可查询喔-(如上图)', Url::to('@web/images/nearestoffice.jpg',true), ''),
            );
            return $this->responseNews($items);
        }

    public function FuncNearestOffice() 
    { 
        $FromUserName = $this->getRequest('FromUserName');
        $gh_id = $this->getRequest('ToUserName');
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);                
        if ($model === null)
            return '';
        //if ($model->lon < 1)
        {
            $items = array(
                new RespNewsItem('附近营业厅查询', '如果你需要查询附近的营业厅，请点击文字输入框旁边的+号,把你的位置发给小沃, 即可查询喔-(如上图)', Url::to('@web/images/nearestoffice.jpg',true), ''),
            );
            return $this->responseNews($items);
        }
    }

    $items = array(
    new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('@web/images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
    );
    return $this->responseNews($items);

            $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
            $items = array(
                new RespNewsItem("{$model->nickname}, 欢迎进入襄阳联通官方微信营业厅", '猛戳进入首页！', Url::to('@web/images/metro-intro.jpg',true), Url::to(['wap/home', 'gh_id'=>$gh_id, 'openid'=>$openid], true)),
            );
            return $this->responseNews($items);

*/

