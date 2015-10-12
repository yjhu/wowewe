<?php
/* @var $this yii\web\View */
$this->title = '短信营销';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-mobile"></i>
                    营销短信直发
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                        <label class="col-md-3" style="text-align: right;">
                            手机号码：
                        </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon input-circle-left">
                                <i class="fa fa-mobile"></i>
                            </span>
                            <input type="number" id="sms_mobile" class="form-control input-circle-right" placeholder="手机号码">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" id="sms_send" class="btn btn-circle blue">发送</button>
                    </div>
                </div>
                <div class="row">
                        <label class="col-md-3" style="text-align: right;">
                            状态：
                        </label>
                    <div class="col-md-9">
                        <span id="sms_status"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    'use strict';
    
//    alert('ready!');
    
    $('#sms_send').click(function() {
        var ajax_url = "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>";
        var mobile = $('#sms_mobile').val();
//        alert(mobile);
        var args = {
            'classname':    '\\app\\models\\SmsMarketingConfig',
            'funcname':     'smsAjax',
            'params':       {
                'mobile': mobile
            } 
        };
        $.ajax({
            url:        ajax_url,
            type:       "GET",
            cache:      false,
            dataType:   "json",
            data:       "args=" + JSON.stringify(args),
            success:    function(ret) { 
//                alert(JSON.stringify(ret));
                if (0 === ret['err_code']) {
                    $('#sms_mobile').val(null);
                    $('#sms_status').html('营销短信发送至'+ mobile + '成功!');
                } else {
                    $('#sms_status').html('发送失败，原因：'+ ret['err_msg']);
                }
            },                        
            error:      function(){
                $('#sms_status').html('AJAX 调用失败！');
            }
        });             
    });
});    
</script>
