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

	<?php echo $this->render('header1', ['menuId'=>'menu3','title' => '商品订单']); ?>
	
	<div data-role="content">

		<h2>订单详情</h2>

			<p id="oid">订单号: <?= $model->oid; ?></p>
	        <p id="title">商品名称: 
	        <!--
	        <//?= MItem::getItemCatName($model->cid); ?>
	        -->
			<?= MItem::getItemTitle($model->oid); ?>
	        
	        &nbsp;&nbsp;
	        	<!--
				<//?php if($item->ctrl_package == 0 ) 
						echo '';
					else if($model->val_pkg_3g4g == '3g')
						echo '3G普通套餐'; 
					else if($model->val_pkg_3g4g == '4g')
						echo '4G/3G一体化套餐'; 
					else
						echo '';
				?>
				-->
	        </p>

			<?php if($model->select_mobnum!=''){?>
	        <p id="selectNum">所选号码: <?= $model->select_mobnum; ?></p>
	        <?php } ?>
	        
	        <p id="office">营业厅: <?= empty($model->office->title)?'':$model->office->title; ?> <?= empty($model->office->address)?'':'('.$model->office->address.')'; ?></p>
	        <hr color="#F7C708">
			<p id="contact">
				用户信息<br>姓名: <?= $model->username; ?> <br>
				<?= $model->usermobile=="undefined"?"":"手机:".$model->usermobile."<br>" ; ?>
				身份证: <?= $model->userid; ?>
			</p>

			<?php if($model->address != null) { ?>
			<p id="address">
				联系方式<br>
				<?= $model->usermobile=="undefined"?"":"手机:".$model->usermobile."<br>" ; ?>
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

			<?php
				//当产品为 惠购流量包产品时，不需要用户选择支付方式，直接订购，营业厅扣除用户话费，办理相应业务 
				//校园优惠季 + 流量宝 活动 直接订购，办理相应业务 
				if( $model->cid == 90000 ||
					$model->cid == 90001 ||
					$model->cid == 90002 ||
					$model->cid == 90003 ||
					$model->cid == 90004 ||
					$model->cid == 90005 ||
					$model->cid == 90006 ||
					$model->cid == 90007 ||
					$model->cid == 90008 ||
					$model->cid == 90009 ||
					$model->cid == 90010 ||
					$model->cid == 80000 ||
					$model->cid == 80001 ) {
			?>
				<!-- nothing -->
					选择用户类型
   					<?= $form->field($model, 'memo')->label(false)->dropDownList(MItem::getUserTypeOption()) ?>
			<?php } else { ?>

			 		<?= $form->field($model, 'memo')->textinput(['id'=>'memo', 'maxlength' => '256', 'placeholder'=>'给卖家留言'])->label(false); ?>
				
					<!-- iphone6s 和宽带产品只是预订不用支付 -->
					<?php if($model->cid != 4006 &&
								$model->cid != 80050 &&
								$model->cid != 80051 &&
								$model->cid != 80052 &&
								$model->cid != 80053 &&
								$model->cid != 80054 ) 
					{ ?>
					<div>
					<fieldset data-role="controlgroup" data-type="horizontal" id="paykind-field">
					<legend>支付方式</legend>
						<select onchange="showButton()" id="sel_paykind">
							<option value="0" selected>线下支付</option>
							<!-- 暂时屏蔽 该支付项 -->
							<!--
							<option value="2">微信支付</option>
							-->
						</select>
					</fieldset>						
					</div>
					<?php } ?>
			<?php } ?>


			<script>
				var btn_paykind = 0;
				url = localStorage.getItem("url");
                var jsApiParameters = JSON.parse(url);

                function showButton()
                {
	                if($("#sel_paykind").val() == 0) /*线下支付*/
			        {
			            $("#btn-pay-weixin").hide();
			            $("#btn-pay").show();
			        }
			        else if($("#sel_paykind").val() == 1) /*支付宝支付，已废除*/
			        {
			        	alert('alipay?!!');
			        }
			        else if($("#sel_paykind").val() == 2)/*微信支付*/
			        {
			        	//alert(url);
			        	$("#btn-pay-weixin").show();
			        	$("#btn-pay").hide();
			        }
			        else/*线下支付*/
			        {
			            $("#btn-pay-weixin").hide();
			            $("#btn-pay").show();
			        }
                }

                function jsApiCall()
                {
                    WeixinJSBridge.invoke(
                        'getBrandWCPayRequest',
                        jsApiParameters,
                        function(res){
                            //WeixinJSBridge.log(res.err_msg);
                            //alert(res.err_code+res.err_desc+res.err_msg);
                            if (res.err_msg == 'get_brand_wcpay_request:ok')
                            {
                            } 
                            else
                            {
                            }
                            window.location.href = "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/myorder'.'&gh_id='.$gh_id.'&openid='.$openid ; ?>";
                        }
                    );
                }

                function callpayout()
                {
					$.ajax({
						url: "<?php echo Url::to(['wap/handlecallpayout','oid'=>$model->oid], true) ; ?>",
						type:"GET",
						cache:false,
						dataType:"json",
						//data: "xxx="+xxx+"&yyy="+yyy,
						success: function(t){
								callpay();
						},
						error: function(){
							alert('error!');
						}
					});

					return false;
                }

                function callpay()
                {
                    if (typeof WeixinJSBridge == "undefined"){
                        if( document.addEventListener ){
                            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                        }else if (document.attachEvent){
                            document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                        }
                    }else{
                        jsApiCall();
                    }
                }

				$(function(){
					if($("#memo").val() != "")
					{
						$("#memo").attr("readonly","readonly");
					}

					showButton();
				});

			</script>

	        <?= Html::submitButton('确定', ['class' => 'ui-shadow ui-btn ui-corner-all', 'id' => 'btn-pay', 'name' => 'contact-button', 'style' => 'background-color: #44B549']) ?>

			<a href="#" class="ui-shadow ui-btn ui-corner-all" id="btn-pay-weixin" style="background-color: #44B549" onclick="callpayout()" >立即支付</a>


	    <?php ActiveForm::end(); ?>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2015</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu3','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	


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
