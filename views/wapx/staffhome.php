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

		<div class="ui-grid-a">
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">我的推广人数</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px">12人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">我的推广二维码</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px">img</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">所属部门员工的推广人数</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px">120人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">所属部门的推广人数</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px">120人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">所属部门的推广二维码</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px">img</div></div>

		</div>

		<div><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-gear">修改设置</a></div>
		<div><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid">成绩排行</a></div>
		<div><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-delete">解绑</a></div>

	</div>

	<?php echo $this->render('footer', ['title' => "&copy; 襄阳联通 ".date('Y')]); ?>

</div>


<?php
/*
		<div class="ui-grid-a">
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">我的推广成绩</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px">12人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">我的推广二维码</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">img</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">部门推广成绩</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">120人</div></div>

		</div>

		<div class="ui-grid-b ui-responsive">
			<div class="ui-block-a"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-gear">修改设置</a></div>
			<div class="ui-block-b"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid">成绩排行</a></div>
			<div class="ui-block-c"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-delete">解绑</a></div>
		<!--
			<div class="ui-block-c"><input data-icon="delete" data-iconpos="right" value="解绑" type="submit"></div>
		-->
		</div>

		<h1>输入手机号：</h1>
		<p>输入手机号：</p>

*/

