<?php

namespace app\controllers;

use app\models\U;
use app\models\MOrder;
use app\models\MOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\View;

use app\models\MOrder;
use app\models\MOrderSearch;

class OrderController extends Controller
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
		$searchModel = new MOrderSearch;
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
		$model = new MOrder;
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
		$model = MOrder::findOne($id);
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
		if (($model = MOrder::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}

/*
	public function actionDisp()
	{
	
//		$this->view->registerCssFile('http://www.yiibook.com/themes/classic/css/yiibook.css');	
//		return $this->render('VUserList');

		$searchModel = new MOrderSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('VUserList', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
		
	}
*/

