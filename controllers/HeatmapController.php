<?php

namespace app\controllers;

use Yii;
use app\models\HeatMap;
use app\models\search\HeatMapSearch;
use app\models\MStaff;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HeatmapController implements the CRUD actions for HeatMap model.
 */
class HeatmapController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all HeatMap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HeatMapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HeatMap model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HeatMap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HeatMap();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HeatMap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HeatMap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionHeatmapstatus($heat_map_id)
    {
        $model = $this->findHeatMapModel($heat_map_id);

        $model->status =$model->status ? 0 : 1;
        $model->save();
        return $this->redirect(['index']);
    }

    protected function findHeatMapModel($id)
    {
        if (($model = HeatMap::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionHeatmapsdownload()
    {
        $searchModel = new HeatMapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(false);
        $data = $dataProvider->getModels();
        $rows = [];
        foreach($data as $model) {
            $row['openid'] = $model->openid;
            $row['nickname'] = $model->user->nickname;

            $staff = MStaff::findOne(['gh_id'=>$model->gh_id, 'scene_id'=>$model->user->scene_pid]);
            if($staff->cat == 0) //内部员工
            {
                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
                $row['scene_pid_office'] = empty($staff->office->title) ? '' : $staff->office->title;
                $row['scene_pid_cat'] = '内部员工';
            }
            else
            {
                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
                $row['scene_pid_office'] = '-';
                $row['scene_pid_cat'] = '-';
            }

            //$row['user_account_charge_mobile'] = $model->user->user_account_charge_mobile;

            if (empty($model->user)) {
                //return '';
                 $row['user_account_charge_mobile'] = '';  
            }
            else
            {
                $mobiles = $model->user->getBindMobileNumbers();
                //return empty($mobiles) ? '' : implode(',', $mobiles); 
                $row['user_account_charge_mobile'] = empty($mobiles) ? '' : implode(',', $mobiles);  
            }

            $row['create_time'] = $model->create_time;

            if($model->status == 0)
                $row['status'] = '有效';
            else
                $row['status'] = '无效';
            
            $rows[] = $row;
        }
        $data = $rows;

        $filename = Yii::$app->getRuntimePath().'/heatmaps.csv';
        $csv = new \app\models\ECSVExport($data);

        $attributes = ['openid', 'nickname', 'scene_pid_name', 'scene_pid_office', 'scene_pid_cat', 'user_account_charge_mobile', 'create_time', 'status'];
        $csv->setInclude($attributes);                
        $csv->setHeaders(['openid'=>'openid', 'nickname'=>'昵称', 'scene_pid_name'=>'粉丝来源', 'scene_pid_office'=>'粉丝来源所属部门', 'scene_pid_cat'=>'粉丝来源类别', 'user_account_charge_mobile'=>'手机号码', 'create_time'=>'创建时间', 'status'=>'是否有效']);

        $csv->toCSV($filename); 
        Yii::$app->response->sendFile($filename);




        return;
    }


    /**
     * Finds the HeatMap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HeatMap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HeatMap::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
