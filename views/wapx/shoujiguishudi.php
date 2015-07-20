<!DOCTYPE html>
<html lang="zh-CN">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<title></title>

<script type="text/javascript">

function get_jsonp() {
	$('#result_tele').html('<span>正在查询中……' + '</span>');
	$.getJSON("http://apis.juhe.cn/mobile/get?callback=?", {
		"phone" : $("#textt").val(),
		"dtype" : "jsonp",
		"key" : "b4b88a8ffc09e2fd3f24251ee19fa168"
	}, function(data) {
		if(data.result.company){
			$('#result_tele').html('归属地：' + data.result.province + data.result.city + ' &nbsp; &nbsp;'
			+ " 区号：" + data.result.areacode + ' &nbsp; &nbsp;' 
			+ "邮编：" + data.result.zip + '<br />' 
			+ "运营商：" + data.result.company + ' &nbsp; &nbsp;' 
			+ "卡类型：" + data.result.card);
			$('#result_tele').css('border','1px solid #ccc');
		}else{
			$('#result_tele').html('请输入正确的手机号码！');
			$('#result_tele').css('border','1px solid #ccc');
		}
	});
	return false;
}

toChange = function(){
	var oTextt = document.getElementById('textt');
	textChange(oTextt,'请输入手机号码前七位');
};


window.onload = function(){
	toChange();
}

textChange = function(obj,str){
	
	obj.onfocus = function(){
		if(this.value == str){
			this.value = '';
		}
	};
	
	obj.onblur = function(){
		if(this.value == ''){
			this.value = str;
		}
	};
	
};

</script>


</head>

<style type="text/css">
  body{padding: 10px;}
</style>

<body>
<!--
<img src='./swiper/olduser1.jpg' width='100%' class="img-rounded">
-->
<img src='/wx/web/images/olduser1.jpg' width='100%' class="img-rounded">
<br><br>
<h3>手机号码归属地查询</h3>

<br />

<div class="form-group field-olduser-mobile">
	<form onsubmit="return get_jsonp();">
		  <input type="tel" id="textt" class="form-control input-lg" maxlength="64" placeholder="请输入手机号码前七位">
  </form>
</div>


<div id="result_tele"></div>

</body>

</html>





