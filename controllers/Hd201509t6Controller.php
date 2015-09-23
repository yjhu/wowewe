<?php

namespace app\controllers;

use Yii;
use app\models\MHd201509t6;
use app\models\MHd201509t6Search;
use app\models\MQdbm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Hd201509t6Controller implements the CRUD actions for MHd201509t6 model.
 */
class Hd201509t6Controller extends Controller
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
     * Lists all MHd201509t6 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MHd201509t6Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_GET['download'])) {
            $dataProvider->setPagination(false);
            $data = $dataProvider->getModels();
            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'zqshfhd'."-{$date}.csv";

            $rowsx = [];

            foreach ($data as $row) {
                $rows = [];
                $rows["mobile"] = $row->mobile;
                $rows["yfzx"] = $row->yfzx;
                $rows["fsc"] = $row->fsc;
                $rows["create_time"] = $row->create_time;

                //$rows["status"] = $row->status;
                if($row->status == 0)
                    $rows["status"] = "未领";
                else
                    $rows["status"] = "已领";

                $rows["qdbm"] = $row->qdbm;

                $qd = MQdbm::findOne(["qdbm" => $row->qdbm]);
                if(empty($qd))
                {
                   $rows["gsyf"] = "--"; 
                   $rows["qdmc"] = "--"; 
                }
                else
                {
                   $rows["gsyf"] = $qd->gsyf; 
                   $rows["qdmc"] = $qd->qdmc; 
                }

                $rowsx[] = $rows;
            }
            //$csv = new \app\models\ECSVExport($data);
            $csv = new \app\models\ECSVExport($rowsx);
            $attributes = ['mobile', 'yfzx', 'fsc', 'hbme', 'create_time', 'status', 'qdbm', 'gsyf', 'qdmc'];
            $csv->setInclude($attributes);                
            //$csv->setHeaders(['Score'=>'成绩']);
            //mobile  yfzx    fsc create_time status  qdbm    gsyf    qdmc

              $csv->setHeaders(['mobile'=>'手机', 'yfzx'=>'营服中心', 'fsc'=>'分市场', 'create_time'=>'时间', 'status'=>'领取状态', 'qdbm'=>'渠道编码', 'gsyf'=>'归属营服', 'qdmc'=>'渠道名称']);
            $csv->toCSV($filename);
            Yii::$app->response->sendFile($filename);
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MHd201509t6 model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MHd201509t6 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MHd201509t6();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->hd201509t6_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MHd201509t6 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->hd201509t6_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MHd201509t6 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MHd201509t6 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MHd201509t6 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MHd201509t6::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
