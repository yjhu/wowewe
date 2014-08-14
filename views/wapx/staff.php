<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;

$this->title = '修改';

//$this->registerJs('$(document).on("pagecreate", "#page1", function() {alert(1); $.mobile.ajaxEnabled = false; });', yii\web\View::POS_END); 
?>


<div data-role="page" id="page1" data-quicklinks="true" data-title="Multi-Page Template">

	<div data-role="header" data-position="fixed">
		<a href="../toolbar/" data-rel="back" class="ui-btn ui-btn-left ui-alt-icon ui-nodisc-icon ui-corner-all ui-btn-icon-notext ui-icon-carat-l">Back</a>
		<h1>襄阳联通</h1>
		<a data-rel="back" href="#">返回</a>
	</div>

	<div role="main" class="ui-content">

		<h1>Bind mobile number</h1>

		<p></p>

		<?php $form = ActiveForm::begin([
			'method' => 'get',
			'options'=>['class'=>'ui-corner-all'],
//			'action' => ['wapx/staffscore'],
//			'method' => 'post',
//			'options'=>['class'=>'ui-corner-all', 'data-ajax'=>'false'],
			'fieldConfig' => [
				//'labelOptions' => ['class' => 'control-label col-sm-3'],
				//'inputOptions' => ['class' => 'form-control'],
				//'template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
				'options' => ['class' => 'ui-field-contain'],
				'inputOptions' => [],
				'labelOptions' => [],
			]               
		]); ?>

		<?= $form->field($model, 'mobile')->textInput(['maxlength' => 24, 'data-clear-btn'=>'true', 'placeholder'=>'Mobile number'])->label(false) ?>

		<?= $form->field($model, 'office_id')->dropDownList(MOffice::getOfficeNameOptionSimple('gh_03a74ac96138', false, false), ['prompt'=>'选择营业厅', 'data-native-menu'=>'false'])->label(false) ?>

		<div class="ui-field-contain">
			<button type="submit" id="submit-1" class="ui-shadow ui-btn ui-corner-all">Save</button>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

	<div data-role="footer" data-position="fixed">
		<h1>Fixed footer</h1>
	</div>

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

