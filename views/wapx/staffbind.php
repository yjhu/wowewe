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

		<h1></h1>
		<p></p>

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

		<?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'data-clear-btn'=>'true', 'placeholder'=>'输入手机号', 'readonly'=>true])->label(false) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 24, 'data-clear-btn'=>'true', 'placeholder'=>'员工姓名', 'required'=>true])->label(false) ?>

		<?= $form->field($model, 'office_id')->dropDownList(MOffice::getOfficeNameOptionSimple1($model->gh_id, false, false), ['prompt'=>'选择营业厅', 'data-native-menu'=>'false'])->label(false) ?>

		<div class="ui-field-contain">
			<button type="submit" class="ui-shadow ui-btn ui-corner-all">确认绑定</button>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

	<?php echo $this->render('footer', ['title' => "&copy; 襄阳联通 ".date('Y')]); ?>

</div>


<?php
/*


	<link rel="stylesheet" href="../css/themes/default/jquery.mobile-1.4.3.min.css">
	<link rel="stylesheet" href="../_assets/css/jqm-demos.css">
	<script src="../js/jquery.js"></script>
	<script src="../_assets/js/index.js"></script>
	<script src="../js/jquery.mobile-1.4.3.min.js"></script>

	<script src="http://libs.baidu.com/jquery/2.0.3/jquery.min.js"></script>

				<label for="textinput-1" class="ui-hidden-accessible">Text Input:</label>
				<label for="select-native-1" class="ui-hidden-accessible">Basic:</label>
				<label for="submit-1" class="ui-hidden-accessible">Save</label>

			<a rel="external" href="<?php echo Url::to(['wapx/staffscore'], true); ?>" class="ui-btn ui-alt-icon ui-nodisc-icon ui-corner-all ui-btn-icon-notext ui-icon-carat-l">go to my score</a>

<script>
var o = $('#submitBtn');
var a =  $.mobile.getAttribute(o, 'role');
alert(a);
</script>

<script>
$(document).on('pagecreate', '#page2', function(event) {
     alert('1');
});
</script>

<form>
		<div class="ui-field-contain">
			<input data-clear-btn="true" name="textinput-1" id="textinput-1" placeholder="Mobile number" value="" type="text">
		</div>

		<div class="ui-field-contain">
			<select name="select-native-1" id="select-native-1" data-native-menu="false">
				<option>选择营业厅</option>
				<option value="1">The 1st Option</option>
				<option value="2">The 2nd Option</option>
				<option value="3">The 3rd Option</option>
				<option value="4">The 4th Option</option>
			</select>
		</div>
</form>

*/

