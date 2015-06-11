<!DOCTYPE HTML>
<html>
<head>
<meta name="apple-itunes-app" content="app-id=458270120"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>快递100-查快递,寄快递,上快递100</title>
<meta name="renderer" content="webkit" />
<meta name="mobile-agent" content="format=html5;url=http://m.kuaidi100.com/" />
<meta name="mobile-agent" content="format=wml; url=http://wap.kuaidi100.com" />
<meta http-equiv="Cache-Control" content="no-transform" />
<link rel='canonical' href='http://www.kuaidi100.com' />
<link rel="shortcut icon" href="http://cdn.kuaidi100.com/favicon.ico" />
<link rel="icon" type="image/gif" href="http://cdn.kuaidi100.com/images/favicon.gif" />
<link rel="stylesheet" type="text/css" href="http://cdn.kuaidi100.com/css/base_m.css?version=201411101000" />
<link rel="stylesheet" type="text/css" href="http://cdn.kuaidi100.com/css/query.css?version=201411101000" />
<link rel="stylesheet" type="text/css" href="http://cdn.kuaidi100.com/css/page/index.css?version=201411101003" />
<script>(function(){var ua = navigator.userAgent.toLowerCase();if(ua.indexOf("android") != -1 || ua.indexOf("iphone") != -1){window.location.href = "http://m.kuaidi100.com";}})()</script>
</head>

<body>
<input type="hidden" id="headerMenu" value="kuaidiQuery kuaijianQuery" /> 
<input type="hidden" id="loginAccount" value="" /> <input type="hidden" id="loginStatus" value="" />


<div class="container w960 mt10px">
  <div class="section">
    <div class="search-box">
      <div class="input-box"> <input name="postid" type="text" class="inp-metro" id="postid" placeholder="请输入单号或地址，这里既能查单号又能查网点噢" maxlength="26" autocomplete="off" /><a id="query" class="btn-query">查询</a><a id="location" class="hidden" title="获取当前位置"></a></div>
      <p id="valideBox" class="pt10px hidden"><span style="float:left;margin-right:5px;">请您输入验证码：<input name="valicode" type="text" class="inp" id="valicode" maxlength="8" style="width:120px;" /></span><span class="vali-images"><img id="valiimages" src="http://cdn.kuaidi100.com/images/clear.gif" onclick="refreshCode()" alt="点击获取新验证码" /></span><a class="font12px refresh-a fl" onclick="refreshCode();">看不清，换一张</a></p>
      <p id="telBox" class="pt10px hidden">请您输入电话号码：<input name="valicodetel" type="text" class="inp" id="valicodetel" maxlength="18" style="width:214px;" /></p>
      <p class="box"></p>
      <ul class="input-tips" id="inputTips">
      </ul>
    </div>
    <div id="example" class="mt10px pl10px font14px">例如：<a id="useTips"></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a id="useTips2">深圳华强北</a><a id="commonShow" class="add-btn hidden">添加导航</a></div>
    <p id="queryWait" class="wait mt10px hidden">正在查询中，请稍等片刻......</p>
    <div id="selectCom" class="select-com relative hidden"> <span><a id="selectComBtn">其他快递</a></span> <a id="companyUrl" href="" target="_blank" class="mr10px">官网</a> <span id="companyTel" class="ico-tel"></span><span id="timeCost" class="ico-clock hidden"></span><span id="arrTime" class="ico-date hidden"></span> </div>
    <div id="comList" class="select-box hidden"> <a id="otherComBtn" class="other-com">其他快递</a>
      <div class="com-list">
        <div id="suggestList" class="suggest"></div>
        <ul class="common">
          <li><span class="li-title">常</span><a data-code="ems">EMS</a><a data-code="shentong">申通</a><a data-code="zhongtong">中通</a><a data-code="yunda">韵达</a><a data-code="zhaijisong">宅急送</a><a data-code="youzhengguonei">邮政包裹</a></li>
          <li><span class="li-title">用</span><a data-code="shunfeng">顺丰</a><a data-code="yuantong">圆通</a><a data-code="huitongkuaidi">汇通</a><a data-code="tiantian">天天</a><a data-code="quanfengkuaidi">全峰</a><a data-code="rufengda">凡客配送</a></li>
        </ul>
        <ul class="all-list fl">
          <li class="dl-bg"><span class="li-title">B</span><a data-code="youzhengguonei">包裹/平邮</a><a data-code="bangsongwuliu">邦送物流</a></li>
          <li><span class="li-title">D</span><a data-code="dhl">DHL</a><a data-code="debangwuliu">德邦</a><a data-code="disifang">递四方</a></li>
          <li class="dl-bg"><span class="li-title">E</span><a data-code="ems">E邮宝</a><a data-code="emsguoji">EMS国际</a></li>
          <li><span class="li-title">F</span><a data-code="fedex">FedEx</a><a data-code="feibaokuaidi">飞豹快递</a><a data-code="feikangda">飞康达</a></li>
          <li class="dl-bg"><span class="li-title">G</span><a data-code="youzhengguonei">挂号信</a><a data-code="guotongkuaidi">国通快递</a><a data-code="ganzhongnengda">能达速递</a></li>
          <li><span class="li-title">H</span><a data-code="huitongkuaidi">汇通快运</a><a data-code="huaqikuaiyun">华企快运</a></li>
          <li class="dl-bg"><span class="li-title">J</span><a data-code="jiajiwuliu">佳吉快运</a><a data-code="jialidatong">嘉里大通</a><a data-code="jixianda">急先达</a></li>
          <li><span class="li-title">K</span><a data-code="kuaijiesudi">快捷速递</a><a data-code="kuayue">跨越速递</a></li>
        </ul>
        <ul class="all-list fl">
          <li class="dl-bg"><span class="li-title">L</span><a data-code="lianbangkuaidi">联邦快递</a><a data-code="lianhaowuliu">联昊通</a></li>
          <li><span class="li-title">Q</span><a data-code="quanfengkuaidi">全峰快递</a><a data-code="quanchenkuaidi">全晨快递</a><a data-code="quanyikuaidi">全一快递</a></li>
          <li class="dl-bg"><span class="li-title">S</span><a data-code="suer">速尔快递</a><a data-code="shangcheng">尚橙物流</a></li>
          <li><span class="li-title">T</span><a data-code="tnt">TNT</a><a data-code="tiandihuayu">天地华宇</a></li>
          <li class="dl-bg"><span class="li-title">U</span><a data-code="usps">USPS</a><a data-code="ups">UPS</a><a data-code="youshuwuliu">优速快递</a></li>
          <li><span class="li-title">X</span><a data-code="xinbangwuliu">新邦物流</a><a data-code="xinfengwuliu">信丰物流</a><a data-code="neweggozzo">新蛋物流</a></li>
          <li class="dl-bg"><span class="li-title">Y</span><a data-code="youzhengguonei">邮政国内</a><a data-code="youzhengguoji">邮政国际</a><a data-code="yinjiesudi">银捷速递</a></li>
          <li><span class="li-title">Z</span><a data-code="zhongyouwuliu">中邮物流</a><a data-code="ztky">中铁物流</a><a data-code="zhongtiewuliu">中铁快运</a></li>
        </ul>
        <div class="box"></div>
        <div class="other"><a href="/all/">查看更多快递公司</a></div>
      </div>
    </div>
    <div id="errorTips" class="tips mt10px hidden"><a onclick="$('#errorTips').hide();" class="tips-close" title="关闭提示"></a><span class="icon"></span>
      <p id="errorMessage">您输入的验证码错误，请重新输入！</p>
    </div>
    <div id="queryContext" class="mt10px hidden relative" style="z-index:4">
      <span class="qr-sf hidden" id="sfQr"></span>
      <div class="result-top"><span class="col1">时间</span><span class="col2">地点和跟踪进度</span><a id="rssBtn" class="a-rss">订阅</a><a id="shareBtn" class="a-share">分享</a></div>
      <table id="queryResult2" class="result-info2" cellspacing="0">
      </table>
    </div>
    <div id="queryQr" class="qr-box mt10px hidden">
      <div class="qr-ad">
        <div id="PAGE_AD_1011838"></div>
      </div>
      <div class="qr-content">
        <div class="qr-l" id="resultImgBox">
          <p><img width="100" height="100" id="queryQrImg" /></p>
          <p><span id="queryQrNum"></span></p>
        </div>
        <div class="qr-l hidden" id="downloadImgBox">
          <p><img width="100" height="100" src="http://cdn.kuaidi100.com/images/qrcode/qr_app.png" title="扫描下载快递100客户端" /></p>
          <p><span>扫描下载</span></p>
        </div>
        <div class="qr-r">
          <p>快递100客户端扫二维码即可实时追踪该单信息</p>
          <p><a href="http://www.kuaidi100.com/mobile/iphone.shtml?from=newindex" id="downloadLink">【下载快递100】</a></p>
        </div>
      </div>
      <div class="box"></div>
    </div>
	<script type="text/javascript" src="http://cdn.kuaidi100.com/js/util/jquery-1.7.1.min.js?version=201411101000"></script> 
<script type="text/javascript" src="http://www.kuaidi100.com/js/share/company.js?version=201411101000"></script> 
<script type="text/javascript" src="http://cdn.kuaidi100.com/js/page/include/header.js?version=201504271400"></script>
<script type="text/javascript" src="http://cdn.kuaidi100.com/js/page/indexnew.js?version=201504271401"></script>
<script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script> 
<script type="text/javascript">BAIDU_CLB_fillSlotAsync('323605','PAGE_AD_323605');BAIDU_CLB_fillSlotAsync('1011838','PAGE_AD_1011838');</script> 
<script type="text/javascript" src="http://cdn.kuaidi100.com/js/share/count.js?version=201411101000"></script>

	</body>
	</html>