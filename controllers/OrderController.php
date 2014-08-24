<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\View;
use yii\data\ArrayDataProvider;

use app\models\U;
use app\models\MOrder;
use app\models\MOrderSearch;
use app\models\MMobnum;

use app\models\MGh;
use app\models\MUser;
use app\models\MStaff;
use app\models\MStaffSearch;

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

	public function init()
	{
		//U::W(['init....', $_GET,$_POST, $GLOBALS]);
		//U::W(['init....', $_GET,$_POST]);
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
			if ($model->save(true, ['status'])) 
			{				
				$mobnum = MMobnum::findOne($model->select_mobnum);
				if ($mobnum !== null)
				{
					if ($model->status == MOrder::STATUS_OK)
						$mobnum->status = MMobnum::STATUS_USED;
					else if ($model->status == MOrder::STATUS_AUTION)
						$mobnum->status = MMobnum::STATUS_LOCKED;
					$mobnum->save(false);				
				}
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

	public function actionStafflist()
	{
		$searchModel = new MStaffSearch;
		$dataProvider = $searchModel->search($_GET);
		return $this->render('stafflist', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	public function actionStaffView($id)
	{
		return $this->render('staffview', [
			'model' => $this->findStaffModel($id),
		]);
	}

	public function actionStaffcreate()
	{
		$model = new MStaff;
		if (Yii::$app->request->isPost) 
		{
			$model->load(Yii::$app->request->post());
			$model->gh_id = Yii::$app->user->getGhid();
			if ($model->save()) 
			{
				return $this->redirect(['stafflist']);			
			}
			else
			{
				U::W($model->getErrors());
			}
		}
		return $this->render('staffcreate', ['model' => $model]);				
	}

	public function actionStaffupdate($id)
	{
		$model = MStaff::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException();
		}
		if (\Yii::$app->request->isPost) 
		{
			$model->load(\Yii::$app->request->post());
			if ($model->save()) 
			{				
				return $this->redirect(['stafflist']);			
			}
			else
			{
				U::W($model->getErrors());
			}			
		}
		return $this->render('staffupdate', ['model' => $model]);		
	}

	public function actionStaffdelete($id)
	{
		//if (!Yii::$app->request->getIsPjax())
		//	return;
		$this->findStaffModel($id)->delete();
		return $this->redirect(['stafflist']);
	}

	protected function findStaffModel($id)
	{
		if (($model = MStaff::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionStafftop()
	{
		$rows = MStaff::getStaffScoreTop(MGh::GH_XIANGYANGUNICOM);
		$dataProvider = new ArrayDataProvider([
			'allModels' => $rows,
			'sort' => [
				'attributes' => ['score', 'name'],
			],
			'pagination' => [
				'pageSize' => 50,
			],
		]);
		return $this->render('stafftop', [
			'dataProvider' => $dataProvider,
		]);
		
	}

	public function actionStafftogglemanager($id)
	{
		$model = $this->findStaffModel($id);
		$model->is_manager =$model->is_manager ? 0 : 1;
		$model->save();
		return $this->redirect(['stafflist']);
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

		$sql = <<<EOD
select t1.score, t3.name, t3.office_id, t4.title, t2.scene_id  from (select scene_pid, count(*) as score from wx_user 
where gh_id='gh_03a74ac96138' and scene_pid != 0 group by scene_pid order by score desc) t1 
left join wx_user t2 on t1.scene_pid = t2.scene_id and t2.scene_id != 0 
left join wx_staff t3 on t2.openid = t3.openid 
left join wx_office t4 on t3.office_id = t4.office_id
EOD;
		$rows = Yii::$app->db->createCommand($sql)->queryAll();
		foreach($rows as $key => $row)
		{
			if (empty($row['name']))
				unset($rows[$key]);
		}
		//$rows = MStaff::getStaffScoreTop(MGh::GH_WOSO);
		
*/

