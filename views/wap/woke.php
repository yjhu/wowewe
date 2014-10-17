<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MOrder;

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>

<style>

</style>


<div data-role="page" id="woke" data-theme="c">

	<?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>	
	<?php echo $this->render('header1', ['menuId'=>'menu1','title' => '沃客计划']); ?>

	<div role="main" class="ui-content">
	
 
		<?php $form = ActiveForm::begin([
				'id' => "{$basename}_form",
				'method' => 'post',
				'options'=>['class'=>'ui-corner-all', 'data-ajax'=>'false'],
				'fieldConfig' => [
					'options' => ['class' => 'ui-field-contain'],
					//'inputOptions' => [],
					//'labelOptions' => [],
				]               
			]); ?>

		 <?= Html::submitButton('立即注册', ['class' => 'ui-shadow ui-btn ui-corner-all', 'id' => 'regBtn', 'name' => 'contact-button', 'style' => 'background-color: #44B549']) ?>


	    <?php ActiveForm::end(); ?>


	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>

</div>




<script>

</script>

<?php
/*

*/