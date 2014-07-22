<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v2112');


$this->title = '手机运程预测';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h3><?php echo Html::encode($this->title) ?>，祝您好运！</h3>
	   
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
		//'layout' => 'horizontal',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'手机号码'])->label(false); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 col-sm-11">
            <?= Html::submitButton('马上测算手机运程！', ['class' => 'btn btn-primary btn-success btn-block btn-lg', 'name' => 'login-button']) ?>
        </div>
    </div>
    
</div>

<div id="result">
<?php echo $result; ?>
</div>

<br><br>



<script>
 var myImg = <?php if($lucy_msg['JX']=="吉") echo "http://hoyatech.net/wx/web/images/magicYellow.jpg"; 
                                    else if($lucy_msg['JX']=="凶") echo "http://hoyatech.net/wx/web/images/magicBlack.jpg";
                                    else if($lucy_msg['JX']=="吉带凶") echo "http://hoyatech.net/wx/web/images/magicBlue.jpg";
                                    else  echo "http://hoyatech.net/wx/web/images/magicBlue.jpg";
                        ?>;
        
 var dataForWeixin={
	   appId:"<?php echo Yii::$app->wx->gh['appid']; ?>",
	   MsgImg:myImg,
	   TLImg:myImg,
	   url:"<?php echo Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/luck:'.Yii::$app->wx->getGhid()); ?>",
	   
                       
                       title:"<?php echo empty($lucy_msg)?"手机运程":"您的手机运程: ".$lucy_msg['JX'] ; ?>",

                      
	   desc:"<?php echo empty($lucy_msg)?"手机运程预测，准的很，不信你试试！": $lucy_msg['JXDetail'].";".$lucy_msg['GXDetail'] ; ?>",
	   fakeid:"",
	   prepare:function(argv){
/*                       
	   if (typeof argv.shareTo!='undefined') 
                      {
                             alert(argv.shareTo);
	   	switch(argv.shareTo) {
	   		case 'friend':
	   		//发送给朋友
	   		alert(argv.scene); //friend
	   		break;
	   		case 'timeline':
	   		//发送给朋友
	   		break;
	   		case 'weibo':
	   		//发送到微博
	   		alert(argv.url);
	   		break;
	   		case 'favorite':
	   		//收藏
	   		alert(argv.scene);//favorite
	   		break;
	   		case 'connector':
	   		//分享到第三方应用
	   		alert(argv.scene);//connector
	   		break;
	   		default：
	   	}
                         }
                         else
                         {
                               alert("err");
                         }
*/                         
	   },
	   callback:function(res){
	   	//发送给好友或应用
	   	if (res.err_msg=='send_app_msg:confirm') {
	   		//todo:func1();
	   		///alert(res.err_desc);
	   	}
	   	if (res.err_msg=='send_app_msg:cancel') {
	   		//todo:func2();
	   		///alert(res.err_desc);
	   	}
	   	//分享到朋友圈
	   	if (res.err_msg=='share_timeline:confirm') {
	   		//todo:func1();
	   		///alert(res.err_desc);
	   	}
	   	if (res.err_msg=='share_timeline:cancel') {
	   		//todo:func1();
	   		///alert(res.err_desc);
	   	}
	   	//分享到微博
	   	if (res.err_msg=='share_weibo:confirm') {
	   		//todo:func1();
	   		///alert(res.err_desc);
	   	}
	   	if (res.err_msg=='share_weibo:cancel') {
	   		//todo:func1();
	   		///alert(res.err_desc);
	   	}
	   	//收藏或分享到应用
	   	if (res.err_msg=='send_app_msg:ok') {
	   		//todo:func1();
	   		///alert(res.err_desc);
	   	}   	
	   }
};
</script>

<?php echo Html::img(Url::to('images/wx-tuiguang1.png'), ['class'=>'img-responsive']); ?>

<?php
/*
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

*/