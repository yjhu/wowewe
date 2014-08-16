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

	<?php $form = ActiveForm::begin([
		'id' => "{$basename}_form",
		//'method' => 'get',
		//'options'=>['class'=>'ui-corner-all'],
		//'action' => ['wapx/staffscore'],
		'method' => 'post',
		'options'=>['class'=>'ui-corner-all', 'data-ajax'=>'false'],
		'fieldConfig' => [
			'options' => ['class' => 'ui-field-contain'],
			'inputOptions' => [],
			'labelOptions' => [],
		]               
	]); ?>

	<div role="main" class="ui-content">
		<div class="ui-grid-a">
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px"><?= $model->name ?>的推广人数</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><?= $model->score ?>人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px"><?= $model->name ?>的推广二维码</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><a href="#dialog_staff_qr" class="ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-notext">员工二维码图片</a></div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">所属部门</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><?= $office->title ?></div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">部门员工的推广人数</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><?= $office->getScoreOfAllStaffs() ?>人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">部门的推广人数</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><?= $office->score ?>人</div></div>
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px">部门的推广二维码</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><a href="#dialog_office_qr" class="ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-notext">部门二维码图片</a></div></div>
		</div>
	</div>

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
            <li><a href="<?php echo Url::to(['staffbind', 'mobile'=>$model->mobile]) ?>" data-icon="gear" data-ajax="false">修改设置</a></li>
            <li><a href="<?php echo Url::to(['stafftop']) ?>" data-icon="bullets">推广明星</a></li>
<!--
            <li><input name="Manage" data-corners="false" data-icon="user" data-iconpos="top" value="我是主管" type="submit" onclick="return confirm('营业厅相关的微信信息将会发给主管,您确认是主管?');"></li>
-->
            <li><input name="Unbind" data-corners="false" data-icon="delete" data-iconpos="top" value="解绑" type="submit" onclick="return confirm('将微信号与员工信息解绑,确定?');"></li>
			</ul>
	    </div>

	</div>
	<?php ActiveForm::end(); ?>

	<?php //echo $this->render('footer', ['title' => "&copy; 襄阳联通 ".date('Y')]); ?>

</div>


<div data-role="page" id="dialog_staff_qr" data-dialog="true">
	<div data-role="header"><h1>我的推广二维码</h1></div>
	<div role="main" class="ui-content ui-responsive">
	<?php //echo Html::img($user->getQrImageUrl(), ['class'=>'ui-responsive', 'style'=>'width:240px;']); ?>
	<?php echo Html::img($user->getQrImageUrl(), ['class'=>'ui-responsive']); ?>
	</div>
</div>

<div data-role="page" id="dialog_office_qr" data-dialog="true">
	<div data-role="header"><h1>部门的推广二维码</h1></div>
	<div role="main" class="ui-content ui-responsive">
	<?php echo Html::img($office->getQrImageUrl(), ['class'=>'img-responsive center-block']); ?>
	</div>
</div>

<?php
/*
	<img src="<?php echo $qrurl; ?> " />

    <div data-role="controlgroup" data-type="horizontal">
        <a href="#" class="ui-btn ui-btn-icon-right ui-icon-plus">Add</a>
        <a href="#" class="ui-btn ui-btn-icon-right ui-icon-arrow-u">Up</a>
        <a href="#" class="ui-btn ui-btn-icon-right ui-icon-arrow-d">Down</a>
    </div>

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
			<div><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-delete">解绑</a></div>

			<div class="ui-block-c"><input data-icon="delete" data-iconpos="right" value="解绑" type="submit"></div>
		</div>

		<h1>输入手机号：</h1>
		<p>输入手机号：</p>
		<div><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid" data-prefetch>成绩排行</a></div>
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar" data-iconpos="left">
			<ul>
				<li><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid">成绩排行</a></li>
				<li><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid">成绩排行</a></li>
				<li><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid">成绩排行</a></li>
			</ul>
		</div>
	</div>

		<div data-role="navbar" data-iconpos="right">
        <ul>
            <li><a href="#" data-icon="gear">修改设置</a></li>
            <li><a href="#" data-icon="grid">成绩排行</a></li>
            <li><a href="#" data-icon="delete">解绑</a></li>
        </ul>
	    </div>

		<div class="ui-grid-a ui-responsive">
			<div class="ui-block-a"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-gear">修改设置</a></div>
			<div class="ui-block-b"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid">成绩排行</a></div>
		</div>

		<div><a href="<?php echo Url::to(['staffbind', 'mobile'=>$model->mobile]) ?>" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-gear">修改设置</a></div>
		<div><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-grid" data-prefetch>成绩排行</a></div>
		<input name="Unbind" data-icon="delete" data-iconpos="right" value="解绑" type="submit" onclick="return confirm('Are you sure to delete');">

		<div style="margin-top:20px"><input name="Manage" data-icon="delete" data-iconpos="right" value="我是营业厅主管" type="submit" onclick="return confirm('营业厅相关的微信信息将会发给主管，您确认是主管?');"></div>

			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><a href="<?php echo Url::to(['officeqr']) ?>" class="ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-notext">部门二维码图片</a></div></div>

*/

