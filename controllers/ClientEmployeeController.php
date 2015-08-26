<?php

namespace app\controllers;

use Yii;
use app\models\ClientEmployee;
use app\models\ClientEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientEmployeeController implements the CRUD actions for ClientEmployee model.
 */
class ClientEmployeeController extends Controller
{
    public $layout='metronic';
    
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
     * Lists all ClientEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if (isset($_GET['download'])){
            $datetime_start = str_replace('\'', '', $_GET['datetime_start']);
            $datetime_end = str_replace('\'', '', $_GET['datetime_end']);
                       
            $filename = Yii::$app->getRuntimePath().
                    "/员工会员推广排行榜-".
                    $datetime_start .'到'. $datetime_end.
                    '.csv';
            $fh = fopen($filename, 'w');
            fprintf($fh, "排名,会员推广数量,员工姓名,电话,营业厅".PHP_EOL);
            $i = 1;
            \Yii::warning('yjhu:' . $datetime_start);
            $rows = \app\models\MUser::getMemberPromotionTopList(0, 5000, $datetime_start . ' 00:00:00', $datetime_end. ' 23:59:59');
            foreach ($rows as $row) {
                $staff = \app\models\MStaff::findOne(['scene_id' => $row['scene_pid']]);
                fprintf($fh, $i++ . ',');
                fprintf($fh, $row['members'] . ',');
                fprintf($fh, $staff->name . ',');
                fprintf($fh, $staff->mobile . ',');
                fprintf($fh, (empty($staff->office) ? '' : $staff->office->title) . PHP_EOL);
            }
            fclose($fh);
            Yii::$app->response->sendFile($filename);
            return;        
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientEmployee model.
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
     * Creates a new ClientEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClientEmployee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->employee_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ClientEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->employee_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ClientEmployee model.
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
     * Finds the ClientEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientEmployee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
