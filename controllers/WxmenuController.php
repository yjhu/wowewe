<?php

namespace app\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

use app\models\MWxMenu;
use app\models\MSchool;

use app\models\U;
use app\models\WxException;
use app\models\Wechat;
use app\models\MUser;
use app\models\MGh;

class WxmenuController extends Controller
{
    public $layout = 'metronic';
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

    public function actionIndex()
    {
		$gh = Yii::$app->user->gh;    
		$modelsSort = [];  
		$models = MWxMenu::getSubModels($gh->gh_id);
		if (empty($models)) {
			MWxMenu::importFromWechat($gh->gh_id);
			$models = MWxMenu::getSubModels($gh->gh_id);			
		}		
		foreach ($models as $model) {
			$modelsSort[] = $model;
			if ($model->is_sub_button) {
				$subModels = MWxMenu::getSubModels($gh->gh_id, $model->wx_menu_id);
				$modelsSort = array_merge($modelsSort, $subModels);
			}
		}
		$dataProvider = new ArrayDataProvider([
			'allModels' => $modelsSort,
			'key'=>'wx_menu_id',
			'pagination' => [
				'pageSize' => 50,
			],
		]);
		return $this->render('index', [
			'dataProvider' => $dataProvider,
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
        $model = new MWxMenu();
        $gh = Yii::$app->user->gh;
        $model->gh_id = $gh->gh_id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->is_sub_button) {
                $model->type = '';
                $model->parent_id = 0;
                $model->url = '';
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->sort_order = MWxMenu::getNextSortOrder($model->gh_id);
            return $this->render('create', [
                'model' => $model,
                'gh'=>$gh,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $gh = Yii::$app->user->gh;
        $model->gh_id = $gh->gh_id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->is_sub_button) {
                $model->type = '';
                $model->parent_id = 0;
                $model->url = '';
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'gh'=>$gh,
            ]);
        }
    }

    /**
     * Deletes an existing MWxMenu model.
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
     * Finds the MWxMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MWxMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MWxMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionExport()
	{
        $gh = Yii::$app->user->gh;
		$done = MWxMenu::exportToWechat($gh->gh_id);
        Yii::$app->session->setFlash('success', $done ? '成功保存到微信服务器！' : '保存失败');
        return $this->redirect(['index']);
	}

    public function actionImport()
    {
        $gh = Yii::$app->user->gh;
        MWxMenu::importFromWechat($gh->gh_id);
        return $this->redirect(['index']);
    }

}

/*
*/

