<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\View;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

use app\models\U;
use app\models\MOrder;
use app\models\MOrderSearch;
use app\models\MMobnum;

use app\models\MGh;
use app\models\MUser;
use app\models\MUserSearch;
use app\models\MStaff;
use app\models\MStaffSearch;
use app\models\MOffice;
use app\models\MOfficeSearch;
use app\models\MChannel;
use app\models\MChannelSearch;
use app\models\MAccessLog;
use app\models\MAccessLogSearch;
use app\models\MAccessLogAll;

use app\models\MSceneDetail;
use app\models\MSceneDetailSearch;

class OrderController extends Controller
{
    public $layout = 'main';

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function init()
    {
        //U::W(['init....', $_GET,$_POST, $GLOBALS]);
        //U::W(['init....', $_GET,$_POST]);
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        //U::W("{$this->id}/{$this->action->id}:".Yii::getLogger()->getElapsedTime());    
        return parent::afterAction($action, $result);
    }

    public function actionIndex()
    {
        $searchModel = new MOrderSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        
        if (isset($_GET['orderdownload']))
        {
            //$dataProvider->query->select($attributes);
            $dataProvider->query->select(['*', '(feesum)/100 as gh_id', "CONCAT('\'',userid) as appid_recv", "(CASE status WHEN 0 THEN '等待付款' WHEN 3 THEN '交易成功' WHEN 7 THEN '用户取消订单' WHEN 9 THEN '超时自动取消订单' ELSE '' END) as partner", "(CASE pay_kind WHEN 0 THEN '自取' WHEN 1 THEN '支付宝' WHEN 2 THEN '微信支付' ELSE '' END) as openid_recv"]);
            $dataProvider->setPagination(false);
            $data = $dataProvider->getModels();

            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath()."/order-{$date}.csv";
            $csv = new \app\models\ECSVExport($data);
            //$attributes = ['oid', 'office_id', 'office.title', 'detail', 'gh_id', 'select_mobnum', 'create_time', 'appid_recv', 'username', 'usermobile', 'status', 'partner', 'pay_kind', 'memo', 'openid_recv'];        
            $attributes = ['oid', 'office_id', 'office.title', 'detail', 'gh_id', 'select_mobnum', 'create_time', 'appid_recv', 'username', 'usermobile', 'partner', 'memo', 'openid_recv'];        
            $csv->setInclude($attributes);                
            $csv->setHeaders(['Gh Id'=>'金额', 'Appid Recv'=>'身份证', 'Partner'=>'订单状态', 'Openid Recv'=>'支付方式']);
            $csv->toCSV($filename); 
            Yii::$app->response->sendFile($filename);
            return;        
        }
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new MOrder;
        if (\Yii::$app->request->isPost) 
        {
                   $model->load(\Yii::$app->request->post());
            if ($model->save()) {
                return $this->redirect(['index']);            
            }
            else
            {
                U::W($model->getErrors());
            }
        }
        return $this->render('create', ['model' => $model]);                
    }

    public function actionUpdate($id)
    {
        $model = MOrder::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('no this order');
        }
        if (\Yii::$app->request->isPost) 
        {
            $model->load(\Yii::$app->request->post());
            if ($model->save(true, ['status', 'select_mobnum', 'memo_reply', 'wlgs', 'wldh'])) 
            {                
                $mobnum = MMobnum::findOne($model->select_mobnum);
                if ($mobnum !== null)
                {
                    if ($model->status == MOrder::STATUS_OK)
                        $mobnum->status = MMobnum::STATUS_USED;
                    else if ($model->status == MOrder::STATUS_AUTION)
                        $mobnum->status = MMobnum::STATUS_LOCKED;
                    else if ($model->status == MOrder::STATUS_CLOSED_USER)
                        $mobnum->status = MMobnum::STATUS_UNUSED;                        
                    $mobnum->save(false);                
                }
                return $this->redirect(['index']);            
            }
        }
        return $this->render('update', ['model' => $model]);        
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = MOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStafflist()
    {
        $searchModel = new MStaffSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('stafflist', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionStaffView($id)
    {
        return $this->render('staffview', [
            'model' => $this->findStaffModel($id),
        ]);
    }

    public function actionStaffcreate()
    {
        $model = new MStaff;
        if (Yii::$app->request->isPost) 
        {
            $model->load(Yii::$app->request->post());
            $model->gh_id = Yii::$app->user->getGhid();
            if ($model->save()) 
            {
                return $this->redirect(['stafflist']);            
            }
            else
            {
                U::W($model->getErrors());
            }
        }
        return $this->render('staffcreate', ['model' => $model]);                
    }

    public function actionStaffupdate($id)
    {
        $model = MStaff::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('no this staff');
        }
        if (\Yii::$app->request->isPost) 
        {
            $model->load(\Yii::$app->request->post());
            if ($model->save()) 
            {                
                return $this->redirect(['stafflist']);            
            }
            else
            {
                U::W($model->getErrors());
            }            
        }
        return $this->render('staffupdate', ['model' => $model]);        
    }

    public function actionStaffdelete($id)
    {
        //if (!Yii::$app->request->getIsPjax())
        //    return;
        $this->findStaffModel($id)->delete();
        return $this->redirect(['stafflist']);
    }

    protected function findStaffModel($id)
    {
        if (($model = MStaff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStafftop()
    {
        //$rows = MStaff::getStaffScoreTop(MGh::GH_XIANGYANGUNICOM);
        $rows = MStaff::getStaffScoreTop(Yii::$app->user->getGhid());
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['score', 'name', 'mobile'],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->render('stafftop', [
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionStafftogglemanager($id)
    {
        $model = $this->findStaffModel($id);
        $model->is_manager =$model->is_manager ? 0 : 1;
        $model->save();
        return $this->redirect(['stafflist']);
    }

    public function actionStaffscoredetail($gh_id, $openid)
    {
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);            
        $searchModel = new MUserSearch;
        $_GET['MUserSearch']['scene_pid'] = $user->scene_id;
        //$searchModel->scene_pid = $user->scene_id;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('staffscoredetail', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionOfficetop()
    {
        $rows = MOffice::getOfficeScoreTop(MGh::GH_XIANGYANGUNICOM);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['cnt_office', 'cnt_staffs', 'cnt_sum'],
                'defaultOrder'=>[
                    'cnt_office' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->render('officetop', [
            'dataProvider' => $dataProvider,
        ]);        
    }

    public function actionIphone6sub()
    {
        $searchModel = new \app\models\MIphone6SubSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('iphone6sub', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionIphone6delete($id)
    {
        $model = \app\models\MIphone6Sub::findOne($id);
        $model->delete();
        return $this->redirect(['iphone6sub']);
    }

    public function actionIphone6subdownload()
    {
        $searchModel = new \app\models\MIphone6SubSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->setPagination(false);
        $data = $dataProvider->getModels();
        //$query = clone $dataProvider->query;
        //$data = $query->asArray()->all($dataProvider->db);
        //U::W($data);
        $filename = Yii::$app->getRuntimePath().'/iphone6.csv';
        $csv = new \app\models\ECSVExport($data);
        $csv->toCSV($filename); 
        Yii::$app->response->sendFile($filename);
        return;
    }

    public function actionOfficelist()
    {
        $searchModel = new MOfficeSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('officelist', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionOfficeView($id)
    {
        return $this->render('officeview', [
            'model' => $this->findOfficeModel($id),
        ]);
    }

    public function actionOfficecreate()
    {
        $model = new MOffice;
        if (Yii::$app->request->isPost) 
        {
            $model->load(Yii::$app->request->post());
            $model->gh_id = Yii::$app->user->getGhid();
            if ($model->save()) 
            {            
                $officeId = Yii::$app->db->getLastInsertID();
                $user = new MUser;
                $user->gh_id = $model->gh_id;
                $user->openid = $officeId;
                $user->nickname = "office#{$officeId}";
                $user->password = '1';
                $user->role = MUser::ROLE_OFFICE;
                $user->save(false);
                return $this->redirect(['officelist']);            
            }
            else
            {
                U::W($model->getErrors());
            }
        }
        return $this->render('officecreateupdate', ['model' => $model]);                
    }

    public function actionOfficeupdate($id)
    {
        $model = $this->findOfficeModel($id);
        if (\Yii::$app->request->isPost) 
        {
            $model->load(\Yii::$app->request->post());
            if ($model->save()) 
            {                
                return $this->redirect(['officelist']);            
            }
            else
            {
                U::W($model->getErrors());
            }            
        }
        return $this->render('officecreateupdate', ['model' => $model]);        
    }

    public function actionOfficedelete($id)
    {
        $this->findOfficeModel($id)->delete();
        return $this->redirect(['officelist']);
    }

    protected function findOfficeModel($id)
    {
        if (($model = MOffice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChannellist()
    {
        $gh_id = Yii::$app->user->getGhid();
        $searchModel = new MChannelSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        
        if (isset($_GET['channelscoretopsumdownload']))
        {
            $sql = "select t1.c, t2.title, t2.mobile, t2.scene_id from (select scene_pid, count(*) as c from wx_user where gh_id='{$gh_id}' and scene_pid != 0 AND subscribe=1 group by scene_pid) t1 inner join wx_channel t2 on t1.scene_pid = t2.scene_id and t2.scene_id != 0 order by c desc";            
            $data = Yii::$app->db->createCommand($sql)->queryAll();                        
            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath()."/channelscoretopsumdownload-{$date}.csv";
            $csv = new \app\models\ECSVExport($data);
            $csv->setExclude(['scene_id']);
            $csv->setHeaders(['c'=>'推广成绩', 'title'=>'营业厅', 'mobile'=>'负责人电话']);
            $csv->toCSV($filename); 
            Yii::$app->response->sendFile($filename);
            return;        
        }
        
        return $this->render('channellist', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionChannelcreate()
    {
        $model = new MChannel;
        if (Yii::$app->request->isPost) 
        {
            $model->load(Yii::$app->request->post());
            $model->gh_id = Yii::$app->user->getGhid();
            if ($model->save()) 
            {
                return $this->redirect(['channellist']);            
            }
            else
            {
                U::W($model->getErrors());
            }
        }
        return $this->render('channelcreateupdate', ['model' => $model]);                
    }

    public function actionChannelupdate($id)
    {
        $model = $this->findChannelModel($id);        
        if (\Yii::$app->request->isPost) 
        {
            $model->load(\Yii::$app->request->post());
            if ($model->save()) 
            {                
                return $this->redirect(['channellist']);            
            }
            else
            {
                U::W($model->getErrors());
            }            
        }
        return $this->render('channelcreateupdate', ['model' => $model]);        
    }

    public function actionChanneldelete($id)
    {
        $this->findChannelModel($id)->delete();        
        return $this->redirect(['channellist']);
    }

    protected function findChannelModel($id)
    {
        if (($model = MChannel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChannelscoredetail($gh_id, $scene_pid)
    {
        $searchModel = new MAccessLogSearch;
        $_GET['MAccessLogSearch']['ToUserName'] = $gh_id;    
        $_GET['MAccessLogSearch']['scene_pid'] = $scene_pid;        
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('channelscoredetail', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionChannelscoretop($month)
    {
        $rows = MChannel::getChannelScoreTop(Yii::$app->user->getGhid(), $month);
        $filter = new \app\models\FiltersForm;
        $filter->unsetAttributes();
        if(isset($_GET['FiltersForm'])) {		
            $filter->setAttributes($_GET['FiltersForm'], false);
        }
        $rows = $filter->filterArrayData($rows);		
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['id', 'title', 'cnt_sum'],
                'defaultOrder'=>[
                    'cnt_sum' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (isset($_GET['channelscoretopdownload']))
        {
            //U::W("+++++++++++++channelscoretopdownload++++++++++++");
            //$dataProvider->query->select(['*']);
            //$dataProvider->setPagination(false);
            //$data = $dataProvider->getModels();
            $data = $rows;
            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath()."/channelscoretop-{$date}.csv";
            $csv = new \app\models\ECSVExport($data);            
            $attributes = ['id', 'title', 'cnt_sum'];        
            $csv->setInclude($attributes);
            $csv->setHeaders(['id'=>'渠道编号', 'title'=>'渠道名称', 'cnt_sum'=>'渠道推广数量']);
            $csv->toCSV($filename); 
            Yii::$app->response->sendFile($filename);
            return;        
        }

        $cur_date = date("Y-m-d");
        return $this->render('channelscoretop', [
            'dataProvider' => $dataProvider,
            'month'=>$month,
            'cur_date'=>$cur_date,
            'filter'=>$filter,            
        ]);  

    }

    public function actionChannelscoretopx()
    {
        $cur_date = Yii::$app->request->get('cur_date');
        if(empty($cur_date))
        {
            $date_start = Yii::$app->request->get('date_start', date("Y-m-d"));
            $date_end = Yii::$app->request->get('date_end', date("Y-m-d"));
        }
        else
        {
            $date_start = $cur_date;
            $date_end = $cur_date; 
        }
        $rows = MChannel::getChannelScoreTopx(Yii::$app->user->getGhid(), $date_start, $date_end);
        $filter = new \app\models\FiltersForm;
        $filter->unsetAttributes();
        if(isset($_GET['FiltersForm'])) {		
            $filter->setAttributes($_GET['FiltersForm'], false);
        }
        $rows = $filter->filterArrayData($rows);		
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['id', 'title', 'cnt_sum'],
                'defaultOrder'=>[
                    'cnt_sum' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (isset($_GET['channelscoretopxdownload']))
        {
            $data = $rows;
            \yii\helpers\ArrayHelper::multisort($data, 'cnt_sum', SORT_DESC);            
            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath()."/channelscoretopx-{$date}.csv";
            $csv = new \app\models\ECSVExport($data);            
            $attributes = ['id', 'title', 'cnt_sum'];        
            $csv->setInclude($attributes);
            $csv->setHeaders(['id'=>'渠道编号', 'title'=>'渠道名称', 'cnt_sum'=>'渠道推广数量']);
            $csv->toCSV($filename); 
            Yii::$app->response->sendFile($filename);
            return;        
        }

        return $this->render('channelscoretopx', [
            'dataProvider' => $dataProvider,
            'date_start' => $date_start,
            'date_end' => $date_end,  
            //'cur_date' => $cur_date,          
            'filter'=>$filter,            
        ]);  

    }

    public function actionStatvisit()
    {
 
        //$date_start = Yii::$app->request->get('date_start', date("Y-m-d")-24*3600);
        //$date_end = Yii::$app->request->get('date_end', date("Y-m-d", time()));
   
       
        $cur_date = Yii::$app->request->get('cur_date');
        if(empty($cur_date))
        {
            $date_start = Yii::$app->request->get('date_start', date("Y-m-d"));
            $date_end = Yii::$app->request->get('date_end', date("Y-m-d"));
        }
        else
        {
            $date_start = $cur_date;
            $date_end = $cur_date; 
        }
   
        //$date_start = Yii::$app->request->get('date_start', date("Y-m-d", time() - 6*24*3600));
        //$date_end = Yii::$app->request->get('date_end', date("Y-m-d", time() - 5*24*3600));
        
        U::W([$date_start, $date_end]);        
        $rows = MAccessLogAll::find()->select('*, count(*) as c')->where('ToUserName=:gh_id AND create_time>=:date_start AND create_time<:date_end', [':gh_id'=>Yii::$app->user->getGhid(), ':date_start'=>$date_start, ':date_end'=>$date_end])->groupBy(['ToUserName', 'EventKeyCRC'])->orderBy('c DESC')->asArray()->all();   
//        U::W($rows);        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
/*            
            'sort' => [
                'attributes' => ['MsgType', 'Event', 'EventKey'],
                'defaultOrder'=>[
                    'c' => SORT_DESC
                ]
            ],
*/            
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $data = null;

        foreach($rows as $row)
        {            
            //$data[] = [$row['EventKey'], (int)$row['c']];
            $pos = strpos($row['EventKey'],"&state=");
            $s = $pos === false ? 0 : $pos;
            $pos = strpos($row['EventKey'],":gh_");
            $e = $pos === false ? 100 : $pos;            
            $title = substr($row['EventKey'], $s, $e-$s);
//            $data[] = ['View'.rand(), (int)$row['c']];

            if (preg_match("/wap\/mobilelist/i", $title)) 
            {
                $title = "手机列表";
            }
            else if(preg_match("/wap\/cardlist/i", $title))
            {
                $title = "上网卡";
            }
            else if(preg_match("/wap\/g2048/i", $title))
            {
                $title = "游戏2048";
            }
            else if(preg_match("/wap\/order/i", $title))
            {
                $title = "我的订单";
            }
            else if(preg_match("/http:\/\/m.10010.com/i", $title))
            {
                $title = "联通官网";
            }
            else if(preg_match("/m.wsq.qq.com\/263163652/i", $title))
            {
                $title = "微社区";
            }
            else if(preg_match("/http:\/\/lm.10010.com\/wolm\/ot\/index.html/i", $title))
            {
                $title = "沃联盟";
            }
            else if(preg_match("/http:\/\/lm.10010.com\/wolm\/ot\/guideDetail.html/i", $title))
            {
                $title = "沃联盟向导页";
            }
            else if(preg_match("/http:\/\/wsq.qq.com\/reflow\/263163652-1044/i", $title))
            {
                $title = "我要吐槽";
            }


            $data[] = [$title, (int)$row['c']];
        }
        
/*
        $rows = [
            ['Firefox',   45.0],
            ['IE',       26.8],
            ['Safari',    8.5],
            ['Opera',     6.2],
            ['Others',   0.7]
        ];        
        $data = $rows;
*/        

        U::W(Yii::$app->user->getGhid());
        U::W($data);
        return $this->render('statvisit', ['dataProvider'=>$dataProvider,'date_start' => $date_start, 'date_end' => $date_end, 'cur_date' => $cur_date, 'data'=>$data]);  
    }


    ////////////////////////////////////////////////
     public function actionMemberlist()
    {
        $searchModel = new MSceneDetailSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('memberlist', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionMemberupdate($id)
    {
        U::W("1111111111111111");
        $model = MSceneDetail::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('no this gh');
        }
        if (\Yii::$app->request->isPost) 
        {
             U::W("2222222222222222222222222");
            $model->load(\Yii::$app->request->post());
            if ($model->save())
            {               
                U::W("33333333333333333333"); 
                return $this->redirect(['memberlist']);            
            }
            else
            {
                U::W($model->getErrors());
            }       
        }
        return $this->render('memberupdate', ['model' => $model]);        
    }


}

/*
    public function actionDisp()
    {
    
//        $this->view->registerCssFile('http://www.yiibook.com/themes/classic/css/yiibook.css');    
//        return $this->render('VUserList');

        $searchModel = new MOrderSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('VUserList', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
        
    }

        $sql = <<<EOD
select t1.score, t3.name, t3.office_id, t4.title, t2.scene_id  from (select scene_pid, count(*) as score from wx_user 
where gh_id='gh_03a74ac96138' and scene_pid != 0 group by scene_pid order by score desc) t1 
left join wx_user t2 on t1.scene_pid = t2.scene_id and t2.scene_id != 0 
left join wx_staff t3 on t2.openid = t3.openid 
left join wx_office t4 on t3.office_id = t4.office_id
EOD;
        $rows = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($rows as $key => $row)
        {
            if (empty($row['name']))
                unset($rows[$key]);
        }
        //$rows = MStaff::getStaffScoreTop(MGh::GH_WOSO);
        
    public function actionChannelscoretop($month)
    {
        $rows = MChannel::getChannelScoreTop(Yii::$app->user->getGhid(), $month);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['id', 'title', 'cnt_sum'],
                'defaultOrder'=>[
                    'cnt_sum' => SORT_DESC
                ]
            ],            
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        if (isset($_GET['channelscoretopdownload']))
        {
            U::W("+++++++++++++channelscoretopdownload++++++++++++");
            //$dataProvider->query->select(['*']);
            //$dataProvider->setPagination(false);
            //$data = $dataProvider->getModels();

            $data = $rows;
            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath()."/channelscoretop-{$date}.csv";
            $csv = new \app\models\ECSVExport($data);
            
            $attributes = ['id', 'title', 'cnt_sum'];        
            $csv->setInclude($attributes);
                
            $csv->setHeaders(['id'=>'渠道编号', 'title'=>'渠道名称', 'cnt_sum'=>'渠道推广数量']);
            $csv->toCSV($filename); 
            Yii::$app->response->sendFile($filename);
            return;        
        }
        
        return $this->render('channelscoretop', [
            'dataProvider' => $dataProvider,
        ]);

        
    }

    $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user WHERE status=:status', [':status' => 1])->queryScalar();
    $dataProvider = new SqlDataProvider([
        'sql' => 'SELECT FROM user WHERE status=:status',
        'params' => [':status' => 1],
        'totalCount' => $count,
        'sort' => [
            'attributes' => [
                'age',
                'name' => [
                    'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
                    'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Name',
                ],
            ],
        ],
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);

    public function actionOrderdownload()
    {
        $searchModel = new \app\models\MOrderSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->setPagination(false);
        $data = $dataProvider->getModels();
        //$query = clone $dataProvider->query;
        //$data = $query->asArray()->all($dataProvider->db);
        //U::W($data);
        $date = date('Y-m-d-His');
        $filename = Yii::$app->getRuntimePath()."/order-{$date}.csv";
        $csv = new \app\models\ECSVExport($data);
        $csv->toCSV($filename); 
        Yii::$app->response->sendFile($filename);
        return;
    }
    */

