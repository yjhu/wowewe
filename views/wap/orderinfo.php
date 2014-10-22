<?php
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
	use app\models\MItem;

	$basename = basename(__FILE__, '.php');
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
	        <p id="title">商品名称: <?= MItem::getItemCatName($model->cid); ?>&nbsp;&nbsp;
				<?php if($item->ctrl_package == 0 ) 
						echo '';
					else if($model->val_pkg_3g4g == '3g')
						echo '3G普通套餐'; 
					else if($model->val_pkg_3g4g == '4g')
						echo '4G/3G一体化套餐'; 
					else
						echo '';
				?>
	        </p>

			<?php if($model->select_mobnum!=''){?>
	        <p id="selectNum">所选号码: <?= $model->select_mobnum; ?></p>
	        <?php } ?>
	        
	        <p id="office">营业厅: <?= empty($model->office->title)?'':$model->office->title; ?> <?= empty($model->office->address)?'':'('.$model->office->address.')'; ?></p>
	        <hr color="#F7C708">
			<p id="contact">
				用户信息<br>姓名: <?= $model->username; ?> <br>
				身份证: <?= $model->userid; ?>
			</p>

			<?php if($model->address != null) { ?>
			<p id="address">
				联系方式<br>
				手机: <?= $model->usermobile; ?><br>
				收货地址: <?= $model->address; ?>
			</p>
			<?php } ?>

			<p align="right" >
	         合计
			<span  id="total" style="font-size: 18px; color:#ff8600; font-weight:  bolder">
			 ￥ <?= round(sprintf("%0.2f",$model->feesum/100)); ?>
			</span>
			</p>

			<?php //$form = ActiveForm::begin(['id' => 'contact-form','class'=>'ui-field-contain', 'data'=>['ajax']]); ?>

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


			<div style="display:none">
	         <?= $form->field($model, 'oid')->textinput(['maxlength' => '64', 'placeholder'=>'oid'])->label(false); ?>
	         <?= $form->field($model, 'detail')->textinput(['maxlength' => '64', 'placeholder'=>'detail'])->label(false); ?>
	         <?= $form->field($model, 'feesum')->textinput(['maxlength' => '64', 'placeholder'=>'price', 'value'=>sprintf("%0.2f",$model->feesum)])->label(false); ?>
			</div>

			<?php 
				$itemPayKindOption = $model->getItemPayKindOption();
				$supportpay_count = count($itemPayKindOption);
				U::W($itemPayKindOption);
			?>


 			<?= $form->field($model, 'memo')->textinput(['maxlength' => '256', 'placeholder'=>'给卖家留言'])->label(false); ?>
			<!--
			<fieldset id="paykind-field" data-role="controlgroup" data-type="horizontal" data-mini="false" data-theme="c">
				<legend>支付方式</legend>
				<?//= $form->field($model, 'pay_kind')->radioList($model->getItemPayKindOption(), ['id'=>'pay_kind_id', 'itemOptions'=>['name'=>'yyy', 'class'=>'radioItem']])->label(false); ?>
			</fieldset>
			-->

			<div>
			<fieldset data-role="controlgroup" data-type="horizontal" id="paykind-field">
			<legend>支付方式</legend>
				<?php $flag=1; foreach($itemPayKindOption as $value => $text) { ?>
				<?php if($flag==1){?>
					<input type="radio" name="paykind" id="paykind_<?= $value ?>" value="<?= $value ?>" checked />
				<?php }else{?>
					<input type="radio" name="paykind" id="paykind_<?= $value ?>" value="<?= $value ?>" />
				<?php } ?>
				<label for="paykind_<?= $value ?>"><?= $text ?></label>
				<?php $flag=0; } ?>	
			</fieldset>						
			</div>

			<script>
				url = localStorage.getItem("url");
				//alert(url);
				$("#btn-pay-weixin").attr('href',url);

				var supportpay_count = <?php echo $supportpay_count; ?>;
					if(supportpay_count == 1)
					$("#paykind-field").hide();

					$("#btn-pay-weixin").hide();

					<?php if($item->ctrl_supportpay == 0) {?>
						$("#btn-pay").html("我知道了");
					<?php } else {?>
						$("#btn-pay").html("立即支付");
					<?php } ?>

				    $("[name=paykind]").click(function(){
			
						if($(this).val() == 0)
				        {
				            $("#btn-pay").html("我知道了");
				            $("#btn-pay-weixin").hide();
				            $("#btn-pay").show();
				        }
				        else if($(this).val() == 1)
				        {
				        	$("#btn-pay").html("立即支付");
				        	$("#btn-pay-weixin").hide();
				        	$("#btn-pay").show();
				        }
				        else
				        {
				        	$("#btn-pay-weixin").show();
				        	$("#btn-pay").hide();
				        }
				    });

			</script>

	        <?= Html::submitButton('立即支付', ['class' => 'ui-shadow ui-btn ui-corner-all', 'id' => 'btn-pay', 'name' => 'contact-button', 'style' => 'background-color: #44B549']) ?>

			<a href="#" class="ui-shadow ui-btn ui-corner-all" id="btn-pay-weixin" style="background-color: #44B549">立即支付</a>

	    <?php ActiveForm::end(); ?>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu3','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	

<script>
	$("#btn-pay").html("我知道了");
</script>

<?php
/*
			<?php if ($supportpay_count == 1): ?>

			<?php else: ?>
				<fieldset data-role="controlgroup" data-type="horizontal" data-mini="false" data-theme="c">
					<legend>支付方式</legend>
					<?= $form->field($model, 'pay_kind')->radioList($model->getItemPayKindOption())->label(false); ?>
				</fieldset>
			<?php endif; ?>

*/
?>
