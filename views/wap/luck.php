<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = '手机运程预测';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h3><?php echo Html::encode($this->title) ?>，祝您好运！</h3>
	   
    
    <div class="page-bizinfo">
      <div class="header">
   
      <p class="activity-info">
          <span id="post-date" class="activity-meta no-extra">2014-07-21</span>
              <a href="javascript:viewProfile();" id="post-user" class="activity-meta">
         <span class="text-ellipsis">沃手科技</span><i class="icon_link_arrow"></i>
          </a>
     </p>
      </div>
  </div>
   
     
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

    <?php ActiveForm::end(); ?>
    <script type="text/javascript">
        document.domain = "qq.com";
        var _wxao = window._wxao || {};
        _wxao.begin = (+new Date());
    </script>

        <script type="text/javascript">
        var tid = "";
        var aid = "";
        var uin = "";
        var key = "";
        var biz = "MjM5MDIyNDcyMQ==";
        var mid = "200391948";
        var idx = "2";
        var nickname = "沃手科技";
        var user_name = "gh_1ad98f5481f3";
        var fakeid   = "";
        var version   = "";
        var is_limit_user   = "0";

        var msg_title = "手机运程测试";
        var msg_desc = "通过手机号码测试您的手机归属地及运程信息...";
        
        var msg_cdn_url = "http://pic4.nipic.com/20090821/3259043_144134093_2.jpg"; //水晶球 favicon
        var msg_link = "http://mp.weixin.qq.com/s?__biz=MjM5MDIyNDcyMQ==&amp;mid=200391948&amp;idx=2&amp;sn=dc8afad5476525260d6f57cb055c0cc6#rd";
        var msg_source_url = 'http://mp.weixin.qq.com/s?__biz=MjM5MDIyNDcyMQ==&amp;mid=200391088&amp;idx=4&amp;sn=d888c56aeb01e2d9bb46ead6395256c6#rd';
        var networkType;
        var appmsgid = '' || '200391948';
        var abtest = 0;//(0) % 2;//默认都用灰色广告 不做ABTEST了
    </script>
            <script type="text/javascript" src="http://res.wx.qq.com/mmbizwap/zh_CN/htmledition/js//appmsg1f13a6.js"></script>
        <script type="text/javascript">
        if (Math.random() < 0.1){
            var page_endtime = (+new Date());
            var page_time = page_endtime - _wxao.begin;
            var is_link = "1" == "1";
            var oss_key = is_link ? 9 : 10;

            //var report_time_url = 'https://mp.weixin.qq.com/misc/jsreport?type=avg&23521_' + oss_key + '=' + page_time + '&23521_15=1&23521_16=1&23521_17=3&23521_15|23521_16|23521_17=1&r=' + Math.random();
            var report_time_url = 'http://isdspeed.qq.com/cgi-bin/r.cgi?flag1=7839&flag2=7&flag3=1&' + oss_key + '=' + page_time;
            var _img = new Image(1, 1);
            _img.src = report_time_url;
        }
    </script>     
    
</div>

<div id="result">
<?php echo $result; ?>
</div>

<?php
/*
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

*/