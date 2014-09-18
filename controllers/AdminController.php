<?php

namespace app\controllers;

use app\models\U;
use app\models\MUser;
use app\models\MUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\View;

use app\models\MItem;
use app\models\MItemSearch;

use app\models\MPkg;
use app\models\MPkgSearch;

class AdminController extends Controller
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

	public function beforeAction($action)
	{
		return parent::beforeAction($action);
	}

	public function actionIndex()
	{
		$searchModel = new MUserSearch;
		$dataProvider = $searchModel->search($_GET);

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
		$model = new MUser;
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
		$model = MUser::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException();
		}
		if (\Yii::$app->request->isPost) 
		{
			$model->load(\Yii::$app->request->post());
			if ($model->save()) {
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
		if (($model = MUser::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionItemlist()
	{
		$searchModel = new MItemSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('itemlist', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	public function actionItemupdate($id)
	{
		$model = MItem::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException();
		}
		if (\Yii::$app->request->isPost) 
		{
			$model->load(\Yii::$app->request->post());
			if ($model->save(false)) {
				return $this->redirect(['itemlist']);			
			}
		}
		return $this->render('itemupdate', ['model' => $model]);		
	}

	public function actionItemcreate()
	{
		$model = new MItem;
		if (\Yii::$app->request->isPost) 
		{
	               $model->load(\Yii::$app->request->post());
			if ($model->save()) {
				return $this->redirect(['itemlist']);			
			}
			else
			{
				U::W($model->getErrors());
			}
		}
		return $this->render('itemcreate', ['model' => $model]);				
	}

	public function actionItemdelete($id)
	{
		$model = MItem::findOne($id);	
		$model->delete();
		return $this->redirect(['itemlist']);
	}
	
	

	public function actionPkglist()
	{
		$searchModel = new MPkgSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('pkglist', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	public function actionPkgupdate($id)
	{
		$model = MPkg::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException();
		}
		if (\Yii::$app->request->isPost) 
		{
			$model->load(\Yii::$app->request->post());
			if ($model->save(false)) {
				return $this->redirect(['pkglist']);			
			}
		}
		return $this->render('pkgupdate', ['model' => $model]);		
	}

	public function actionPkgcreate()
	{
		$model = new MPkg;
		if (\Yii::$app->request->isPost) 
		{
	               $model->load(\Yii::$app->request->post());
			if ($model->save()) {
				return $this->redirect(['pkglist']);			
			}
			else
			{
				U::W($model->getErrors());
			}
		}
		return $this->render('pkgcreate', ['model' => $model]);				
	}

	public function actionPkgdelete($id)
	{
		$model = MPkg::findOne($id);	
		$model->delete();
		return $this->redirect(['pkglist']);
	}	
}

/*
	public function actionDisp()
	{
	
//		$this->view->registerCssFile('http://www.yiibook.com/themes/classic/css/yiibook.css');	
//		return $this->render('VUserList');

		$searchModel = new MUserSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('VUserList', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
		
	}
*/

