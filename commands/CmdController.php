<?php

/*
C:\xampp\php\php.exe C:\htdocs\wx\yii cache/flush
C:\xampp\php\php.exe C:\htdocs\wx\yii cmd
C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-menu
/usr/bin/php /mnt/wwwroot/wx/yii cmd/media-download

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
use app\models\MOffice;
use app\models\MStaff;
use app\models\MGroup;
use app\models\MChannel;
use app\models\Custom;
use app\models\Manager;
use app\models\CustomManager;
use app\models\VipLevel;

use app\models\sm\ESms;
use app\models\sm\ESmsGuodu;

use app\models\ClientOrganization;

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

        //U::W(U::getQqAddress(114.253578, 30.585514));
        $arr = U::getMobileLocation('13871407676');
        if (!empty($arr['errcode'])) {
            U::W(['err', $arr]);
        } 
        else {
            U::W($arr);        
        }
        return;
        
        $clientOrganization = ClientOrganization::findOne(50);
        U::W($clientOrganization);
        
        $directSubordinateOrganizations = $clientOrganization->directSubordinateOrganizations;
        U::W($directSubordinateOrganizations);        
    }


    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-channel-qrs
    public function actionCreateChannelQrs()
    {        
        $gh_id = Yii::$app->wx->getGhid();
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'channel_names.txt';
        $fh = fopen($file, "r");
        $i = 0;
        $scene_ids = array();
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;

            $title = trim($line);
            $model = MChannel::findOne(['gh_id'=>$gh_id, 'title'=>$title]);    
            if ($model !== null)
                continue;
                
            $model = new MChannel;
            $model->gh_id = $gh_id;
            $model->title = $title;
            $url = $model->getQrImageUrl();
            
            $i++;
//            if ($i > 2) break;
        }
        fclose($fh);
    }    


    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/get-kf-status
    public function actionGetKfStatus()
    {
        $arr = Yii::$app->wx->WxGetOnlineKfList();
        U::W($arr);
        print_r($arr);
    } 


    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/create-wx-groups
    public function actionCreateWxGroups()
    {        
        $gh_id = Yii::$app->wx->getGhid();
        $offices = MOffice::find()->where("gh_id = :gh_id AND visable = :visable", [':gh_id'=>$gh_id, ':visable'=>1])->asArray()->all();        

        foreach($offices as $office)
        {
            $office_id = $office['office_id'];
            $gname = mb_substr($office['title'], 0, 10, 'utf-8');

            $arr = Yii::$app->wx->WxGroupCreate(['group'=>['name'=>$gname]]);
            //U::W("{$arr['group']['id']},{$arr['group']['name']}");        

            $tableName = MGroup::tableName();
            Yii::$app->db->createCommand("INSERT INTO $tableName (gh_id, gid, gname, office_id) VALUES (:gh_id, :gid, :gname, :office_id)", [':gh_id' => $gh_id, ':gid' => $arr['group']['id'],':gname' => $gname,':office_id' => $office_id])->execute();
        }

    }    
    
    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/get-ad-url
    public function actionGetAdUrl()
    {        
        $gh_id = Yii::$app->wx->getGhid();     
        //$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mobile:{$gh_id}:cid=324");
        //$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mobilelist:{$gh_id}");

        //new \app\models\ButtonView('5折流量包订购', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_FLOW_CARD)),
        //$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_FLOW_CARD);

        //$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showpage:{$gh_id}");
        $url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showdoubledaninfo:{$gh_id}");
        U::W($url);
        echo $url;
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
        $arr = Yii::$app->wx->WxGroupMoveMember(MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 103);
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
        //$msg = ['touser'=>MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 'msgtype'=>'text', 'text'=>['content'=>'您好, 何华斌']];
        //$msg = ['touser'=>MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 'msgtype'=>'image', 'image'=>['media_id'=>'id123456']];
        //$msg = ['touser'=>MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 'msgtype'=>'voice', 'voice'=>['media_id'=>'id123456']];        
        //$msg = ['touser'=>MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 'msgtype'=>'video', 'video'=>['media_id'=>'id123456','title'=>'a', 'description'=>'b']];                
        //$msg = ['touser'=>'oySODt2YXO_JMcFWpFO5wyuEYX-0', 'msgtype'=>'music', 'music'=>['musicurl '=>'http://baidu.com', 'hqmusicurl'=>'', 'thumb_media_id'=>'123', 'title'=>'a', 'description'=>'123']];
        $msg = [
            'touser'=>MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 
            'msgtype'=>'news', 
            'news'=> [
                'articles'=>[
                    ['title'=>'标题-A', 'description'=>'详情-A, Analyze UA. This tool was developed for user agent string analysis. Our analysis gives you information on client SW type (browser, webcrawler, anonymizer etc.)', 'url'=>'http://hoyatech.net/wx/web/index.php', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'],
                    ['title'=>'title-b', 'description'=>'description-b, welcome to wechat site', 'url'=>'http://hoyatech.net/wx/web/index.php', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'],
                ]                
            ]
        ];
        $msg = ['touser'=>MGh::GH_XIANGYANGUNICOM_OPENID_HBHE, 'msgtype'=>'text', 'text'=>['content'=>'how are you, huabin']];
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
        Yii::$app->wx->WxMediaDownload('ZpP2CgKGMCznB6AXaJEVdv3L53TpUB_IsUAsqDCE5GGTVAG7V6GHKSkyujT8fBsF', 'abcd.jpg');
        return;    
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/user-info
    public function actionUserInfo()
    {    
        Yii::$app->wx->setGhId(MGh::GH_XIANGYANGUNICOM);
//        $arr = Yii::$app->wx->WxGetUserInfo(MGh::GH_XIANGYANGUNICOM_OPENID_HBHE);    
//        $arr = Yii::$app->wx->WxGetUserInfo('oKgUduHLF-HAxvHYIwmm3qjfqNf0');  
        $arr = Yii::$app->wx->WxGetUserInfo('oKgUduOrAFvEKMFAOUbkGFdiWlGM');  

        

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


        /*
        else if ($gh_id == MGh::GH_XIANGYANGUNICOM)
        {
            $menu = new \app\models\WxMenu([
                new \app\models\ButtonComplex('沃商城', [
                    //new \app\models\ButtonView('沃派校园套餐', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardxiaoyuan:{$gh_id}")),
                    

                    new \app\models\ButtonView('特惠合约机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mobilelist:{$gh_id}")),
                    new \app\models\ButtonView('单卡产品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_CARD)),   

                    new \app\models\ButtonView('5折流量包', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_FLOW_CARD)),
                    new \app\models\ButtonView('8折上网卡', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_INTERNET_CARD)),
                 
                    new \app\models\ButtonView('官网直通车', 'http://m.10010.com/'),
                    //new \app\models\ButtonView('iPhone6火热预订', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=204243902&idx=1&sn=37207b6183533131e661c22ec43a083b#rd'),
                    //new \app\models\ButtonView('小米4预订', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=204274384&idx=1&sn=ae4d0925e811da0c652209d42e7ac04e#rd'),
                ]),
                new \app\models\ButtonComplex('沃服务', [
                    new \app\models\ButtonView('我的订单', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/order:{$gh_id}")),
                    new \app\models\ButtonLocationSelect('最近营业厅', 'FuncNearestOffice'),
                    //new \app\models\ButtonView('账单查询', 'http://wap.10010.com/t/siteMap.htm?menuId=query'),
                    //new \app\models\ButtonView('流量包订购', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd'),
                    //new \app\models\ButtonView('用户吐槽', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/suggest:{$gh_id}")),
                    new \app\models\ButtonView('用户吐槽', 'http://wsq.qq.com/reflow/263163652-1044?_wv=1&source='),
                    new \app\models\ButtonView('襄阳沃社区', 'http://m.wsq.qq.com/263163652 '),
                    new \app\models\ButtonView('游戏2048', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/g2048:{$gh_id}")),
                ]),
                new \app\models\ButtonComplex('沃联盟', [
                    //new \app\models\ButtonView('最近营业厅', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/xxxxxx:{$gh_id}")),
                    //new \app\models\ButtonClick('最近营业厅', 'FuncNearestOffice'),
                    //new \app\models\ButtonLocationSelect('最近营业厅.', 'FuncNearestOffice'),
                    new \app\models\ButtonView('沃联盟介绍', 'http://lm.10010.com/wolm/ot/guideDetail.html'),
                    new \app\models\ButtonView('登录沃联盟', 'http://lm.10010.com/wolm/ot/index.html'),
                    new \app\models\ButtonView('新手指南', 'http://lm.10010.com/wolm/ot/newComer.html'),
                    new \app\models\ButtonView('财富手册', 'http://lm.10010.com/wolm/ot/earnStep.html'),
                    new \app\models\ButtonView('收益说明', 'http://lm.10010.com/wolm/ot/incomeDeclr.html'),

                ]),
            ]);
        }
        */
        /*
        else if ($gh_id == MGh::GH_XIANGYANGUNICOM)
        {
            $menu = new \app\models\WxMenu([

                new \app\models\ButtonComplex('沃资讯', [
                    new \app\models\ButtonView('4G业务', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/show4ginfo:{$gh_id}")),
                    new \app\models\ButtonView('短信订购流量包', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd'),
                    new \app\models\ButtonView('数信业务', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showpage:{$gh_id}")),
                    new \app\models\ButtonView('用户吐槽', 'http://wsq.qq.com/reflow/263163652-1044?_wv=1&source='),
                    new \app\models\ButtonView('加入我们', 'http://lm.10010.com/wolm/ot/newComer.html'),
                ]),

                new \app\models\ButtonComplex('沃商城', [
                    new \app\models\ButtonView('老友季焕新机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showk1info:{$gh_id}")),
                    new \app\models\ButtonView('沃联盟店铺', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/wlmshop:{$gh_id}")),
                    //new \app\models\ButtonView('特惠合约机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/mobilelist:{$gh_id}")),
                    //new \app\models\ButtonView('单卡产品', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_CARD)),      
                    ////new \app\models\ButtonView('8折上网卡', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_INTERNET_CARD)),
                ]),

                new \app\models\ButtonComplex('沃业务', [
                    new \app\models\ButtonView('话费充值', 'http://upay.10010.com/npfwap/npfMobWap/bankcharge/index.html?version=null&desmobile=8E2104B024B5116C9EA24F8EE55A29A8#/bankcharge'),
                    new \app\models\ButtonView('流量包订购', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_FLOW_CARD)),
                    new \app\models\ButtonView('手机营业厅', 'http://wap.10010.com/t/home.htm'),
                    new \app\models\ButtonView('手机商城', 'http://m.10010.com/'),
                    //new \app\models\ButtonView('话费查询', 'http://wap.10010.com/t/operationservice/queryOcsPackageFlowLeft.htm?menuId=000200020004'),
                    //new \app\models\ButtonView('流量查询', 'https://uac.10010.com/oauth2/new_auth?display=wap&page_type=05&app_code=ECS-YH-WAP&redirect_uri=http://wap.10010.com/t/loginCallBack.htm&state=http://wap.10010.com/t/home.htm&channel_code=113000001&real_ip=119.98.143.119'),
                ]),
            ]);
        }
        */
        /*
       else if ($gh_id == MGh::GH_XIANGYANGUNICOM)
        {
            $menu = new \app\models\WxMenu([
                new \app\models\ButtonComplex('沃资讯', [
                    new \app\models\ButtonView('加入沃联盟', 'http://lm.10010.com/wolm/ot/newComer.html'),
                    new \app\models\ButtonView('短信订购流量包', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd'),
                    new \app\models\ButtonView('老友季焕新机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showk1info:{$gh_id}")),
                ]),
                new \app\models\ButtonComplex('沃业务', [
                    new \app\models\ButtonView('手机商城', 'http://m.10010.com/'),
                    new \app\models\ButtonView('微信店铺', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/wlmshop:{$gh_id}")),
                    new \app\models\ButtonView('数信业务', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showpage:{$gh_id}")),
                    new \app\models\ButtonView('4G业务', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/show4ginfo:{$gh_id}")),
                ]),
                new \app\models\ButtonComplex('沃服务', [
                    new \app\models\ButtonView('手机营业厅', 'http://wap.10010.com/t/home.htm'),
                    new \app\models\ButtonView('5折流量包订购', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_FLOW_CARD)),
                    new \app\models\ButtonView('话费充值', 'http://upay.10010.com/npfwap/npfMobWap/bankcharge/index.html?version=null&desmobile=8E2104B024B5116C9EA24F8EE55A29A8#/bankcharge'),
                    new \app\models\ButtonView('流量抽奖', 'http://hb.kk3g.net/active/online/0521/pre.html?tag=weixin'),
                    new \app\models\ButtonView('用户吐槽', 'http://wsq.qq.com/reflow/263163652-1044?_wv=1&source='),
                ]),
            ]);
        }   
        */
       else if ($gh_id == MGh::GH_XIANGYANGUNICOM)
        {
            $menu = new \app\models\WxMenu([
                new \app\models\ButtonComplex('沃资讯', [
                    //new \app\models\ButtonView('快速赚钱只需4步', 'http://lm.10010.com/wolm/topicHtml/71d971438b5e4a2bb2b45768b59a9805.html'),
                    
                    new \app\models\ButtonView('新年喜乐惠', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=207197445&idx=1&sn=aee84b19e349c436bd30fe9ac6f488d7#rd'),
                    new \app\models\ButtonView('1折流量包抢购', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=207197175&idx=1&sn=7fc569fb57c99db9be6abc973374aed3#rd'),

                    new \app\models\ButtonView('玩转流量', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showpage:{$gh_id}")),
                    new \app\models\ButtonView('玩转4G', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/show4ginfo:{$gh_id}")),
                    ////new \app\models\ButtonView('5折流量包订购', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/cardlist:{$gh_id}:kind=".MItem::ITEM_KIND_FLOW_CARD)),
                    /////////////////////////////////////////////////
                    //new \app\models\ButtonView('短信订购流量包', 'http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd'),
                ]),
                new \app\models\ButtonComplex('沃业务', [
                    //new \app\models\ButtonView('1212万能盛典', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showdouble12info:{$gh_id}")),
                    //new \app\models\ButtonView('双旦狂欢季', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showdoubledaninfo:{$gh_id}")),
                    new \app\models\ButtonView('你好,2015', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showdoubledaninfo:{$gh_id}")),
                    
                    //new \app\models\ButtonView('双旦秒杀', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showdoubledanmiaoshainfo:{$gh_id}")),
                    new \app\models\ButtonView('老友季焕新机', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/showk1info:{$gh_id}")),
                    new \app\models\ButtonView('微信店铺', Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/wlmshop:{$gh_id}")),
                    /////////////////////////////////////////////////
                    //new \app\models\ButtonView('手机商城', 'http://m.10010.com/'),
                ]),
                new \app\models\ButtonComplex('沃服务', [
                    new \app\models\ButtonView('话费查询', 'http://wap.10010.com/t/query/queryRealTimeFeeInfo.htm?menuId=000200010001'),
                    new \app\models\ButtonView('话费充值', 'http://upay.10010.com/npfwap/npfMobWap/bankcharge/index.html?version=null&desmobile=8E2104B024B5116C9EA24F8EE55A29A8#/bankcharge'),
                    new \app\models\ButtonView('流量查询', 'http://wap.10010.com/t/operationservice/queryRunoff.htm?menuId=000200020001'),
                    new \app\models\ButtonView('流量抽奖第3季', 'http://wap.hb165.com/llphb3/#rd'),
                    new \app\models\ButtonView('用户吐槽', 'http://wsq.qq.com/reflow/263163652-1044?_wv=1&source='),
                ]),
            ]);
        }
        else if ($gh_id == MGh::GH_HOYA)
        {
            $menu = new \app\models\WxMenu([
                new \app\models\ButtonComplex('走进爱迪', [
                    new \app\models\ButtonView('关于爱迪', 'http://wosotech.com/wx/web/index.php?r=yss/adabout'),
                    new \app\models\ButtonView('校区查询', 'http://baidu.com'),
                    new \app\models\ButtonView('教师风采', 'http://wosotech.com/wx/web/index.php?r=yss/teacher'),
                    new \app\models\ButtonView('爱迪宝贝秀', 'http://baidu.com'),
                    new \app\models\ButtonView('走进爱迪', 'http://baidu.com'),
                ]),
                new \app\models\ButtonComplex('预约优惠', [
                    new \app\models\ButtonView('我要预约', 'http://baidu.com'),
                    new \app\models\ButtonView('课程介绍', 'http://baidu.com'),
                    new \app\models\ButtonView('近期活动', 'http://baidu.com'),
                    new \app\models\ButtonView('教师风采x', 'http://wosotech.com/wx/web/index.php?r=yss/teacherx'),
                    new \app\models\ButtonView('教师风采y', 'http://wosotech.com/wx/web/index.php?r=yss/teachery'),
                ]),
                new \app\models\ButtonComplex('宝贝查询', [
                    new \app\models\ButtonView('签到记录', 'http://baidu.com'),
                    new \app\models\ButtonView('宝贝相册', 'http://baidu.com'),
                    new \app\models\ButtonView('宝贝课表', 'http://baidu.com'),
                    new \app\models\ButtonView('推荐有礼', 'http://baidu.com'),
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

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/set-liantong-flag
    // /usr/bin/php /mnt/wwwroot/wx/yii cmd/set-liantong-flag
    public function actionSetLiantongFlag()
    {        
        $gh_id = Yii::$app->wx->getGhid();
        $models = MStaff::find()->where("gh_id = :gh_id AND openid != '' ", [':gh_id'=>$gh_id])->asArray()->all();        
        foreach($models as $model)
        {
            $gh_id = $model['gh_id'];
            $openid = $model['openid'];
            $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
            if ($user !== null && $user->is_liantongstaff == 0)
            {
                $user->is_liantongstaff = 1;
                $user->save(false);
            }
        }
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/sm-balance
    public function actionSmBalance()
    {        
        echo "guodu:".ESmsGuodu::B(false);
        \app\commands\NightController::checkSmBalance();
        return;
    }

    //first convert into txt file
    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/t1
    //C:\xampp\php\php.exe D:\htdocs\wx\yii cmd/t1
    public function actionT1()
    {
        $tableName = 'wx_t1';                
        $n = Yii::$app->db->createCommand("TRUNCATE TABLE {$tableName}")->execute();    
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'t1.txt';
        $fh = fopen($file, "r");
        $i = 0;
        $sm_valid_cids = array();
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $arr = explode("\t", $line);
            $cat = iconv('GBK','UTF-8//IGNORE', $arr[0]);
            $mobile = iconv('GBK','UTF-8//IGNORE', $arr[1]);
            $product_name = iconv('GBK','UTF-8//IGNORE', $arr[2]);
            $in_date = iconv('GBK','UTF-8//IGNORE', $arr[3]);
            $n = Yii::$app->db->createCommand("INSERT INTO $tableName (cat, mobile, product_name, in_date) VALUES (:cat, :mobile, :product_name, :in_date)", [':cat' => $cat,':mobile' => $mobile, ':product_name' => $product_name, ':in_date' => $in_date])->execute();
            $i++;
        }
        fclose($fh);    
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/t2
    public function actionT2()
    {
        $tableName = 'wx_t2';                
        $n = Yii::$app->db->createCommand("TRUNCATE TABLE {$tableName}")->execute();        
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'t2.txt';        
        $fh = fopen($file, "r");
        $i = 0;
        $sm_valid_cids = array();
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $arr = explode("\t", $line);
            $cat = iconv('GBK','UTF-8//IGNORE', $arr[0]);
            $mobile = iconv('GBK','UTF-8//IGNORE', $arr[1]);
            $product_name = iconv('GBK','UTF-8//IGNORE', $arr[2]);
            $in_date = iconv('GBK','UTF-8//IGNORE', $arr[3]);
            //U::W([$cat, $mobile, $product_name, $in_date]);            
            $n = Yii::$app->db->createCommand("INSERT INTO $tableName (cat, mobile, product_name, in_date) VALUES (:cat, :mobile, :product_name, :in_date)", [':cat' => $cat,':mobile' => $mobile, ':product_name' => $product_name, ':in_date' => $in_date])->execute();
            $i++;
        }
        fclose($fh);    
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/t3
    public function actionT3old()
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'t3.txt';        
        $fh = fopen($file, "r");
        $mobiles = [];
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $mobile = trim($line);
            $mobiles[] = $mobile;
        }
		error_log(json_encode($mobiles), 3, Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'t3.json');																	                
        fclose($fh);    
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/t3
    public function actionT3()
    {
        $tableName = 'wx_t3';                
        $n = Yii::$app->db->createCommand("TRUNCATE TABLE {$tableName}")->execute();        
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'t3.txt';        
        $fh = fopen($file, "r");
        $i = 0;
        $sm_valid_cids = array();
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $mobile = trim($line);
            $n = Yii::$app->db->createCommand("INSERT INTO $tableName (mobile) VALUES (:mobile)", [':mobile' => $mobile])->execute();
            $i++;
        }
        fclose($fh);    
    }


    public function actionTcustomers($filename = 't.txt')
    {

        $tableName = 'wx_oldcustomers';      
        $n = Yii::$app->db->createCommand("TRUNCATE TABLE {$tableName}")->execute();        
        
        //$file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'t3.txt';        
        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR  . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($file, "r");

        $i = 0;
        $sm_valid_cids = array();
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $mobile = trim($line);
            $n = Yii::$app->db->createCommand("INSERT INTO $tableName (mobile) VALUES (:mobile)", [':mobile' => $mobile])->execute();
            $i++;
        }
        fclose($fh);    
    }





    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/wxmanager
     public function actionWxmanager()
    {
        $tableName = 'wx_manager';                
        $n = Yii::$app->db->createCommand("TRUNCATE TABLE {$tableName}")->execute();    
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'vipmanager.txt';
        $fh = fopen($file, "r");
        $i = 0;
        $sm_valid_cids = array();
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $arr = explode("\t", $line);
            $name = iconv('GBK','UTF-8//IGNORE', $arr[1]);
            $mobile = iconv('GBK','UTF-8//IGNORE', $arr[2]);
            $n = Yii::$app->db->createCommand("INSERT INTO $tableName (name, mobile) VALUES (:name, :mobile)", [':name' => $name,':mobile' => $mobile])->execute();
            $i++;
        }
        fclose($fh);    
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/importvip
    //generate 4 tables: Custom, Manager, CustomManager, VipLevel
    public function actionImportvip()
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'vipmanager.txt';
        $fh = fopen($file, "r");
        $i=0;
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $arr = explode("\t", $line);            
            $arr[1] = iconv('GBK','UTF-8//IGNORE', $arr[1]);
            $arr[3] = iconv('GBK','UTF-8//IGNORE', $arr[3]);
            $custom_mobile = trim($arr[0]);
            $manager_name = trim($arr[1]);
            $manager_mobile = trim($arr[2]);            
            $vip_level_title = trim($arr[3]);                        
            $vip_join_time = trim($arr[4]);   
            $vip_join_time = str_replace("/", "-", $vip_join_time);
            $vip_start_time = trim($arr[5]);   
            $vip_start_time = str_replace("/", "-", $vip_start_time);
            $vip_end_time = trim($arr[6]);   
            $vip_end_time = str_replace("/", "-", $vip_end_time);
            $vipLevel = VipLevel::findOne(['title'=>$vip_level_title]);
            if (empty($vipLevel)) {
                $vipLevel = new VipLevel;
                $vipLevel->title = $vip_level_title;
                if (!$vipLevel->save(false)) {
                    U::W('save vipLevel err');
                }
            }
            
            $custom = Custom::findOne(['mobile'=>$custom_mobile]);
            if (!empty($custom)) {
//                U::W("mobile=$custom_mobile already exists");                
//                U::W($arr);
//                continue;
            }
            else {
                $custom = new Custom;
            }
            $custom->mobile = $custom_mobile;
            $custom->is_vip = 1;
            $custom->vip_join_time = $vip_join_time;            
            $custom->vip_start_time = $vip_start_time;            
            $custom->vip_end_time = $vip_end_time;                        
            $custom->vip_level_id = $vipLevel->vip_level_id;  
            $custom->save(false);

            $manager = Manager::findOne(['mobile'=>$manager_mobile]);
            if (empty($manager)) {
                $manager = new Manager;
                $manager->mobile = $manager_mobile;
                $manager->name = $manager_name;
                $manager->save(false);
            }
            
            $customManager = CustomManager::findOne(['custom_id'=>$custom->custom_id, 'manager_id'=>$manager->manager_id]);
            if (!empty($customManager)) {
                //U::W('Impossible!!! CustomManager already exists');
                //U::W($arr);
            } else {
                $customManager = new CustomManager;
                $customManager->custom_id = $custom->custom_id;
                $customManager->manager_id = $manager->manager_id;
                if (!$customManager->save(false)) {
                    U::W('customManager SAVE ERR');
                }
            }
            $i++;
            if ($i % 1000 == 1)
                U::W($i);
            
        }
        fclose($fh);    
    }


    public function actionImportvipnew()
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'vip.txt';
        $fh = fopen($file, "r");
        $i=0;
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $line = iconv('GBK','UTF-8//IGNORE', $line);            
            $arr = explode("\t", $line);            
            //$arr[1] = iconv('GBK','UTF-8//IGNORE', $arr[1]);
            //$arr[2] = iconv('GBK','UTF-8//IGNORE', $arr[2]);
            //$arr[3] = iconv('GBK','UTF-8//IGNORE', $arr[3]);
            $custom_mobile = trim($arr[0]);
            $manager_name = trim($arr[1]);
            $manager_mobile = trim($arr[2]);            
            $vip_level_title = trim($arr[3]);    
            $office_title = trim($arr[4]);                  
            
            //$vip_join_time = trim($arr[4]);   
            //$vip_join_time = str_replace("/", "-", $vip_join_time);
            //$vip_start_time = trim($arr[5]);   
            //$vip_start_time = str_replace("/", "-", $vip_start_time);
            //$vip_end_time = trim($arr[6]);   
            //$vip_end_time = str_replace("/", "-", $vip_end_time);
            $vipLevel = VipLevel::findOne(['title'=>$vip_level_title]);
            if (empty($vipLevel)) {
                $vipLevel = new VipLevel;
                $vipLevel->title = $vip_level_title;
                if (!$vipLevel->save(false)) {
                    U::W('save vipLevel err');
                }
            }

            $office = MOffice::findOne(['title'=>$office_title]);
             

            $custom = Custom::findOne(['mobile'=>$custom_mobile]);
            if (!empty($custom)) {
                U::W("mobile=$custom_mobile already exists");                
                U::W($arr);
//                continue;
            }
            else {
                $custom = new Custom;
                $custom->vip_join_time = '0000-00-00 00:00:00';
            }
            $custom->mobile = $custom_mobile;
            $custom->is_vip = 1;
            //$custom->vip_join_time = $vip_join_time;            
            //$custom->vip_start_time = $vip_start_time;            
            //$custom->vip_end_time = $vip_end_time;                        
            $custom->vip_level_id = $vipLevel->vip_level_id;  

            $custom->office_id = empty($office) ? 0 : $office->office_id;

 
            $custom->save(false);

            $manager = Manager::findOne(['mobile'=>$manager_mobile]);
            if (empty($manager)) {
                $manager = new Manager;
                //$manager->mobile = $manager_mobile;
                $manager->name = $manager_name;
                $manager->save(false);
            }
            
            $customManager = CustomManager::findOne(['custom_id'=>$custom->custom_id, 'manager_id'=>$manager->manager_id]);
            if (!empty($customManager)) {
                //U::W('Impossible!!! CustomManager already exists');
                //U::W($arr);
            } else {
                $customManager = new CustomManager;
                $customManager->custom_id = $custom->custom_id;
                $customManager->manager_id = $manager->manager_id;
                if (!$customManager->save(false)) {
                    U::W('customManager SAVE ERR');
                }
            }
            $i++;
            //if($i > 5) break;

            if ($i % 1000 == 1)
                U::W($i);
            
        }
        fclose($fh);    
    }

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/importcustom
    public function actionImportcustom()
    {
        $file = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'custom.txt';
        $fh = fopen($file, "r");
        $i=0;
        while (!feof($fh)) 
        {
            $line = fgets($fh);
            if (empty($line))
                continue;
            $arr = explode("\t", $line);            
            $arr[1] = iconv('GBK','UTF-8//IGNORE', $arr[1]);
            $arr[2] = iconv('GBK','UTF-8//IGNORE', $arr[2]);
            $mobile = trim($arr[0]);
            $name = trim($arr[1]);
            $office_title = trim($arr[2]);
            $office = MOffice::findOne(['gh_id'=>'gh_03a74ac96138', 'title'=>$office_title]);            
            if (empty($office)) {
                U::W(['office_title is invalid', $arr]);                
                exit;
            }
            
            $custom = Custom::findOne(['mobile'=>$mobile]);
            if (!empty($custom)) {
                //U::W("mobile=$mobile already exists");                
                //U::W($arr);
            } else {
                $custom = new Custom;
            }
            $custom->mobile = $mobile;
            $custom->name = $name;            
            $custom->office_id = $office->office_id;                        
            $custom->save(false);

            $i++;
            if ($i % 1000 == 1)
                U::W($i);
        }
        fclose($fh);    

    }    

    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/refresh-fan-headimgurl 10000
    public function actionRefreshFanHeadimgurl($id = null)
    {        
        $id = empty($id) ? 0: $id;    
        $gh_id = Yii::$app->wx->getGhid();
        $db = \Yii::$app->db;
        $query = new Query();
        $tableName = MUser::tableName();
        $query->from($tableName)->where('id > :id', [':id'=>$id])->orderBy(['id'=>SORT_ASC]);
        $i = 0;
        foreach ($query->each() as $user)
        {
            //$size = U::getRemoteFileSize($user['headimgurl']);
            //if ($size == 5093) 
            {
                if (empty($user['subscribe'])) {
                    continue;
                }
                U::W(["refresh", $user]);                
                Yii::$app->wx->setGhId($user['gh_id']);            
                $arr = Yii::$app->wx->WxGetUserInfo($user['openid']);                                  
                U::W($arr);
                if ($arr['subscribe'] == 0) {
                    $n = $db->createCommand()->update($tableName, 
                        [
                            'subscribe' => 0,
                        ], 
                        'id = :id', [':id'=>$user['id']])->execute();                
                    
                } else {
                    $n = $db->createCommand()->update($tableName, 
                        [
                            'nickname' => $arr['nickname'],                     
                            'headimgurl' => $arr['headimgurl'], 
                            'city' => empty($arr['city']) ? '' : $arr['city'],
                            'province' => empty($arr['province']) ? '' : $arr['province'],
                            'country' => empty($arr['country']) ? '' : $arr['country'],
                            'sex' => empty($arr['sex']) ? '' : $arr['sex'],
                            'subscribe' => empty($arr['subscribe']) ? '' : $arr['subscribe'],                    
                            //'unionid' => empty($arr['unionid']) ? '' : $arr['unionid'],
                        ], 
                        'id = :id', [':id'=>$user['id']])->execute();                
                }
                U::W("id={$user['id']}");
            }
            $i++;
            if ($i % 1000 == 1)
                U::W($i);
        }

    }




    //刷新粉丝昵称和头像
    public function actionShowFanHead()
    {        
        $gh_id = MGh::GH_XIANGYANGUNICOM;
       
        $total_count = MUser::find()->where(['gh_id' => $gh_id, 'subscribe' => 1])->count();

        $step = 500;
        $start = 0;

        while ($start < $total_count) {

            $users = MUser::find()->offset($start)->limit($step)->where(['gh_id' => $gh_id, 'subscribe' => 1])->orderBy(['id' => SORT_ASC])->all();

            foreach ($users as $user)
            {
                    if (empty($user->headimgurl)) continue;
        
                    //if($user->id < 6143)  continue;

                    $arr = Yii::$app->wx->WxGetUserInfo($user->openid); 

                    if(empty($arr['headimgurl']))
                        continue;

                    echo "Fan #ID\t".$user->id."\t".$arr['headimgurl']."\n";

                    $user->nickname = $arr['nickname'];
                    $user->headimgurl = $arr['headimgurl'];
                    $user->save(false);
            }

            $start += $step;
        }

    } 

    //更新18家自营厅员工信息
    //php yii export/selfop-staff-update 
    public function actionSelfopStaffUpdate($filename = 'staff_20150819.csv') {

        $file = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'imported_data' . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($file, "r");
        $i = 1;
        while (!feof($fh)) {
            $line = fgets($fh);
            $i++;
            if (empty($line))
                continue;
            $fields = explode(",", $line);  
    
            $office_title = trim($fields[3]);
            $office_title_utf8 = iconv('GBK', 'UTF-8//IGNORE', $office_title);

            $staff_name = trim($fields[4]);
            $staff_name_utf8 = iconv('GBK', 'UTF-8//IGNORE', $staff_name);

            $staff_role = trim($fields[5]);
            $staff_role_utf8 = iconv('GBK', 'UTF-8//IGNORE', $staff_role);
            if($staff_role_utf8 == '营业厅经理')
                $is_manager = 1;
            else
                $is_manager = 0;

            $office = MOffice::findOne(['title'=>$office_title_utf8]);
            
            echo $office->office_id.",".$office->title.",".$office_title_utf8.",".$staff_name_utf8.",".$staff_role_utf8.",".$is_manager."\n";           
            
            $staff = MStaff::findOne(['name'=>$staff_name_utf8]);
            if(!empty($staff))
            {
                $staff->office_id = $office->office_id;
                $staff->is_manager = $is_manager;
                $staff->cat = 0;
                $staff->save(false); 
            }
        }
        
        fclose($fh);
       
       echo "staff data(20150819) update ok\n";
    }






    //http://www.juhe.cn/my/info
    //C:\xampp\php\php.exe C:\htdocs\wx\yii cmd/show-mobile-info
    public function actionShowMobileInfo($id = null)
    {        
        $postFields = null;
        $appkey = '5d4a589b32d70ad6378c8c69cba63524';
        //$appkey = ' -H apikey:3d9a61582849efccd65f77f34db064a8';
        $mobilenumber = '15071087608';

        $requestUrl = 'http://apis.juhe.cn/mobile/get?phone='.$mobilenumber.'&key='.$appkey;
        //$requestUrl = 'http://appyun.sinaapp.com/index.php?app=mobile&controller=index&action=api&outfmt=json&mobile='.$mobilenumber;

        try
        {
            //U::W($requestUrl);
            $resp = U::curl($requestUrl, $postFields);
            //U::W($resp);
        }
        catch (Exception $e)
        {
            U::W($e->getCode().':'.$e->getMessage());
            return ['errcode'=>$e->getCode(), 'errmsg'=>$e->getMessage()];
        }

        $arr = json_decode($resp, true);
        if (null !== $arr)
        {
            U::W("--------------actionShowMobileInfo----------------");
            U::W($arr);
            //return $arr;
        }

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
//        new \app\models\ButtonView('网上营业厅', Yii::$app->wx->WxGetOauth2Url('snsapi_base', urlencode(json_encode(['wap/mall','gh_id'=>Yii::$app->wx->getGhid()])))),

        new \app\models\ButtonClick('沃竞猜，猜胜负', 'FuncCustomService'),

        //$menu = new \app\models\WxMenu([
        //    new \app\models\ButtonComplex('沃4G专柜', [
        //        new \app\models\ButtonView('自由套餐', 'http://m.10010.com/mobilegoodsdetail/981405149472.html'),
        //        new \app\models\ButtonView('4G套餐', 'http://m.10010.com/mobilegoodsdetail/981403121719.html'),
        //        new \app\models\ButtonView('4G手机', 'http://m.10010.com/MobileList'),
        //    ]),
        //    new \app\models\ButtonView('网上营业厅', Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mall:'.Yii::$app->wx->getGhid())),
        //    new \app\models\ButtonComplex('我的服务', [
        //        new \app\models\ButtonView('自助查询', Url::to(['site/about', 'id'=>1],true)),
        //        new \app\models\ButtonClick('天天抽话费', 'FuncQueryFee'),
        //        new \app\models\ButtonClick('签到送积分', 'FuncSignon'),
        //        new \app\models\ButtonClick('客服小沃', 'FuncCustomService'),
        //        new \app\models\ButtonView('我要维权', Url::to(['site/index'],true)),
        //    ]),
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
//        $filename =  Yii::$app->getRuntimePath()."/a.txt";
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
            
//            $i++;
//            if ($i>4) break;
            

        }
        fclose($handle);

    }
$model = MUser::findOne(['gh_id' => MGh::GH_XIANGYANGUNICOM, 'openid' => MGh::GH_XIANGYANGUNICOM_OPENID_HBHE]);
$model->sendTemplateDonateMobileBill('13871000002', 18900);
$model->sendTemplateCharge(19900);            
        
*/

