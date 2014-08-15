<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

/*
$js_code=<<<EOD
$(document).on("pagecreate", "#page1", function() {
	$.mobile.ajaxEnabled = false; 
});
EOD;
$this->registerJs($js_code, yii\web\View::POS_END); 
*/

?>


<div data-role="page" id="<?= $basename ?>_page_1" data-quicklinks="true" data-title="襄阳联通">

	<?php echo $this->render('header', ['title' => '襄阳联通']); ?>

	<div role="main" class="ui-content">

		<?php $form = ActiveForm::begin([
			'id' => "{$basename}_form",
			//'method' => 'get',
			//'options'=>['class'=>'ui-corner-all'],
			//'action' => ['wapx/staffscore'],
			'method' => 'post',
			'options'=>['class'=>'ui-corner-all', 'data-ajax'=>'false'],
			'fieldConfig' => [
				//'labelOptions' => ['class' => 'control-label col-sm-3'],
				//'inputOptions' => ['class' => 'form-control'],
				//'template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
				'options' => ['class' => 'ui-field-contain'],
				'inputOptions' => [],
				'labelOptions' => [],
			]               
		]); ?>

		<?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'data-clear-btn'=>'true', 'placeholder'=>'输入手机号', 'required'=>true])->label(false) ?>

		<div class="ui-field-contain">
			<button type="submit" id="<?= $basename ?>_submit_1" class="ui-shadow ui-btn ui-corner-all">确认</button>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

	<?php echo $this->render('footer', ['title' => "&copy; 襄阳联通 ".date('Y')]); ?>

</div>


<?php
/*

		<h1>输入手机号：</h1>
		<p>输入手机号：</p>

*/

