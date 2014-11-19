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
	<?php echo $this->render('header1', ['menuId'=>'menu1','title' => '会员俱乐部']); ?>

	<div role="main" class="ui-content">
	
		<?php $form = ActiveForm::begin([
			'id' => "{$basename}_form",
			//'method' => 'get',
			//'options'=>['class'=>'ui-corner-all'],
			//'action' => ['wapx/staffscore'],
			'method' => 'post',
			'options'=>['class'=>'ui-corner-all', 'data' => ['ajax'=>'false']],
			'fieldConfig' => [
				//'labelOptions' => ['class' => 'control-label col-sm-3'],
				//'inputOptions' => ['class' => 'form-control'],
				//'template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
				'options' => ['class' => 'ui-field-contain'],
				'inputOptions' => [],
				'labelOptions' => [],
			]               
		]); ?>

		<?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'data' => ['clear-btn'=>'true'], 'placeholder'=>'输入手机号'])->label('手机号:') ?>


		<div class="ui-field-contain">
			<button type="submit" class="ui-shadow ui-btn ui-corner-all">立即绑定</button>
		</div>

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