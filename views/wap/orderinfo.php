<?php
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
	use app\models\MItem;

?>

<style type="text/CSS">
.tabSumm 
{
	color:#00C;
}
.keyword
{
    color: red;
    background-color: yellow;
}
.highlight
{
    color: red;
    background-color: yellow;
}


.fee
{
    font-size: 18px;
    color:#ff8600;
    font-weight:  bolder;
}

.title_hint
{
    color:red;
    font-size: 9pt;
}

.ui-content {
    padding: 0.5em !important;
}

</style>
	

<div data-role="page" id="page1" data-theme="c">

	<?php echo $this->render('header1', ['menuId'=>'menu3','title' => '订单支付']); ?>
	
	<div data-role="content">


		<h2>订单详情</h2>

			<p id="oid">订单号: <?= $model->oid; ?></p>
	        <p id="title">商品名称: <?= MItem::getItemCatName($model->cid); ?></p>
	        <p id="selectNum">所选号码: <?= $model->select_mobnum; ?></p>
	        <p id="office">营业厅: <?= empty($model->office->title)?'':$model->office->title; ?> <?= empty($model->office->address)?'':'('.$model->office->address.')'; ?></p>
	        <hr color="#F7C708">
			<p id="contact">
				用户信息<br>姓名: <?= $model->username; ?> <br>
				手机: <?= $model->usermobile; ?><br>
				身份证: <?= $model->userid; ?>
			</p>

			<p align="right" >
	         合计
			<span  id="total" style="font-size: 18px; color:#ff8600; font-weight:  bolder">
			 ￥ <?= sprintf("%0.2f",$model->feesum/100); ?>
			</span>
			</p>

			<?php $form = ActiveForm::begin(['id' => 'contact-form','class'=>'ui-field-contain']); ?>
			<div style="display:none">
	         <?= $form->field($model, 'oid')->textinput(['maxlength' => '64', 'placeholder'=>'oid'])->label(false); ?>
	         <?= $form->field($model, 'detail')->textinput(['maxlength' => '64', 'placeholder'=>'detail'])->label(false); ?>
	         <?= $form->field($model, 'feesum')->textinput(['maxlength' => '64', 'placeholder'=>'price', 'value'=>sprintf("%0.2f",$model->feesum/100)])->label(false); ?>
			</div>

			<fieldset data-role="controlgroup" data-type="horizontal" data-mini="false" data-theme="c">
				<legend>支付方式</legend>
				<input type="radio" name="paykind" id="paykind_0" value="0" checked="checked">
				<label for="paykind_0">自取</label>
				<input type="radio" name="paykind" id="paykind_1" value="1">
				<label for="paykind_1">支付宝</label>
				<input type="radio" name="paykind" id="paykind_2" value="2">
				<label for="paykind_2">微信支付</label>
			</fieldset>

	        <?= Html::submitButton('立即支付', ['class' => 'ui-shadow ui-btn ui-corner-all', 'name' => 'contact-button', 'style' => 'background-color: #44B549']) ?>

	    <?php ActiveForm::end(); ?>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu3','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	<!-- page3 end -->

	
<?php
/*

*/
?>
