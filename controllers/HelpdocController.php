<?php

namespace app\controllers;

use Yii;
use app\models\MHelpdoc;
use app\models\MHelpdocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Imagine\Image\ImagineInterface;
use Imagine\Image\ManipulatorInterface;

use yii\imagine\Image;
use app\models\U;
use  yii\web\UploadedFile;
/**
 * HelpdocController implements the CRUD actions for MHelpdoc model.
 */
class HelpdocController extends Controller
{

    public function actions()
    {
        return [
            'imagesget' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::$app->request->getHostInfo(). Yii::getAlias('@web/wysiwyg/'),                
                'path' => '@webroot/wysiwyg',
                'type' => \vova07\imperavi\actions\GetAction::TYPE_IMAGES,
            ],
            'imageupload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::$app->request->getHostInfo(). Yii::getAlias('@web/wysiwyg/'),
                'path' => '@webroot/wysiwyg',
            ],            
        ];
    }


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
     * Lists all MHelpdoc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MHelpdocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MHelpdoc model.
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
     * Creates a new MHelpdoc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MHelpdoc();

        if ($model->load(Yii::$app->request->post())) {
            $model->sort = 0;
            $model->visual = 1;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->helpdoc_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MHelpdoc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->helpdoc_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MHelpdoc model.
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
     * Finds the MHelpdoc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MHelpdoc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MHelpdoc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
