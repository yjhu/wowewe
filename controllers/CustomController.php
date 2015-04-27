<?php

namespace app\controllers;

use Yii;
use app\models\Custom;
use app\models\CustomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;


/**
 * CustomController implements the CRUD actions for Custom model.
 */
class CustomController extends Controller
{
    public $enableCsrfValidation = false;

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
     * Lists all Custom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Custom model.
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
     * Creates a new Custom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Custom();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->custom_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Custom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->custom_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Custom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Custom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Custom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Custom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionVipbind()
    {
        $in_office = Yii::$app->request->get('in_office', 0);
        $rows = Custom::getBindVipCustoms($in_office);        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
//                'attributes' => ['score', 'name', 'mobile'],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (isset($_GET['download'])) {
            $data = $rows;
//            \yii\helpers\ArrayHelper::multisort($data, 'cnt_sum', SORT_DESC);                                    
            $date = date('Y-m-d-His');
            $filename = Yii::$app->getRuntimePath()."/vipbind-{$date}.csv";
            $csv = new \app\models\ECSVExport($data);            
/*
            $attributes = ['office_id', 'scene_id', 'title', 'is_jingxiaoshang', 'cnt_office', 'cnt_staffs', 'cnt_sum'];        
            $csv->setInclude($attributes);
            $csv->setHeaders(['office_id'=>'营业厅ID', 'scene_id'=>'推广码ID', 'title'=>'名称', 'is_jingxiaoshang'=>'类别', 'cnt_office'=>'部门推广人数', 'cnt_staffs'=>'部门员工推广人数', 'cnt_sum'=>'合计推广人数']);
*/
            $csv->toCSV($filename); 
            Yii::$app->response->sendFile($filename);
            return;        
        }
        
        return $this->render('vipbind', [
            'dataProvider' => $dataProvider,
        ]);        
        
    }
    
}
