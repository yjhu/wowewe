<?php

namespace app\controllers;

use Yii;
use app\models\MGoods;
use app\models\MGoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Imagine\Image\ImagineInterface;
use Imagine\Image\ManipulatorInterface;

use yii\imagine\Image;
use app\models\U;
use  yii\web\UploadedFile;

/**
 * GoodsController implements the CRUD actions for MGoods model.
 */
class GoodsController extends Controller
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
     * Lists all MGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MGoods model.
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
     * Creates a new MGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MGoods();

        if ($model->load(Yii::$app->request->post())) {
            //上传列表小图片， 单文件上传
            $model->file = UploadedFile::getInstance($model, 'file');
            $targetFileId = date("YmdHis").'-'.uniqid();
            $ext = pathinfo($model->file->name, PATHINFO_EXTENSION);

            $targetFileName = "{$targetFileId}.{$ext}";
            $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
            $model->file->saveAs($targetFile);

            $model->list_img_url = "/wx/web/goods/photo/{$targetFileName}";

           
            //上传产品大图片图片， 多文件上传， 最多3张图
            $tmpStr="";
            $model->files = UploadedFile::getInstances($model, 'files');
            foreach ($model->files as $file) 
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";

                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                $file->saveAs($targetFile);

                $tmpStr =  $tmpStr . "/wx/web/goods/photo/{$targetFileName};";
            }
            $model->body_img_url = $tmpStr;


            $model->save();

            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            //上传列表小图片， 单文件上传
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($model->file->name, PATHINFO_EXTENSION);

                $targetFileName = "{$targetFileId}.{$ext}";

                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;

                $model->file->saveAs($targetFile);

                $model->list_img_url = "/wx/web/goods/photo/{$targetFileName}";
            }

            //上传产品大图片图片， 多文件上传， 最多3张图
            $tmpStr="";
            $model->files = UploadedFile::getInstances($model, 'files');

            if(!empty($model->files))
            {
                foreach ($model->files as $file) 
                {
                    $targetFileId = date("YmdHis").'-'.uniqid();
                    $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                    $targetFileName = "{$targetFileId}.{$ext}";

                    $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                    $file->saveAs($targetFile);

                    $tmpStr =  $tmpStr . "/wx/web/goods/photo/{$targetFileName};";
                }
                 $model->body_img_url = $tmpStr;
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->goods_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MGoods model.
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
     * Finds the MGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
