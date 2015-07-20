<?php

namespace app\controllers;

use Yii;
use app\models\MPhoto;
use app\models\search\MPhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\ImagineInterface;
use Imagine\Image\ManipulatorInterface;

use yii\imagine\Image;

use app\models\U;

class PhotoController extends Controller
{
    public $layout = 'metronic';
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

    public function actionIndex()
    {
        $searchModel = new MPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    public function actionCreate()
    {
        $model = new MPhoto();		
        if($model->load(Yii::$app->request->post()))
        {
	        if($file = UploadedFile::getInstance($model, 'pic_url'))
			{
				if(!$file->error)
				{
					$targetFileId = date("YmdHis").'-'.uniqid();
					$ext = pathinfo($file->name, PATHINFO_EXTENSION);
					$targetFileName = "{$targetFileId}.{$ext}";
					$targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MPhoto::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
					if ($file->saveAs($targetFile))
					{
						$model->pic_url = $targetFileName;
						$model->size = $file->size;						
						if ($model->save()) {
							return $this->redirect(['index']);
						}
					}
					else
					{
						$model->addError('pic_url', 'save as error!');					
					}
					
				} else {
					$model->addError('pic_url', $file->error);
				}
			
	        }			
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    public function actionDelete($id)
    {    
	    $model = $this->findModel($id);
		$model->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = MPhoto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

/*
//					$targetFilePath = "/".MPhoto::PHOTO_PATH."/".$targetFileName;
//					$targetFile = Yii::getAlias('@storage').$targetFilePath;
//$model->pic_url = $targetFilePath;

*/
