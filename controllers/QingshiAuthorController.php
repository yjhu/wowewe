<?php

namespace app\controllers;

use Yii;
use app\models\MQingshiAuthor;
use app\models\MQingshiAuthorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\U;

/**
 * QingshiAuthorController implements the CRUD actions for MQingshiAuthor model.
 */
class QingshiAuthorController extends Controller
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
     * Lists all MQingshiAuthor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MQingshiAuthorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MQingshiAuthor model.
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
     * Creates a new MQingshiAuthor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MQingshiAuthor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MQingshiAuthor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);

            /*
            const AUDIT_NONE = 0;
            const AUDIT_FAIL = 1;
            const AUDIT_PASS = 2;
            */

            if($model->status == 1)
            {
                $msg = ":-( 你的投稿没有审核通过。没关系啦，还可以为小伙伴们拉票哟~";
                if (!$model->user->sendWxm($msg))                  
                {    
                    U::W("wx send failed");
                }
            }
            else if($model->status == 2)
            {
                $msg = "恭喜！您的投稿已通过审核，快号召小伙伴们来投票吧~";
                if (!$model->user->sendWxm($msg))                  
                {    
                    U::W("wx send failed");
                }
            }

            //return $this->redirect(['memberlist']);            
            return $this->redirect(['index', 'model' => $model]);
     

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MQingshiAuthor model.
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
     * Finds the MQingshiAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MQingshiAuthor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MQingshiAuthor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
