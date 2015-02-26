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

<title>我要预约</title>

</head>

<style type="text/css">
  body{padding: 10px;}
</style>

<body>

<img src='./swiper/head1.jpg' width='100%' class="img-rounded">
<br><br>


<form role="form">
  <div class="form-group">
    <label for="school">试听中心</label>

   <select class="form-control">
    <option>请选择:</option>
    <option>菱角湖万达校区</option>
    <option>光谷步行街校区</option>
    <option>光谷时代广场校区</option>
    <option>青山奥山世纪城校区</option>
  </select>

  </div>

  <div class="form-group">
    <label for="school">试听课程</label>
   <select class="form-control">
    <option>请选择:</option>
    <option>(2-4) 创意思维</option>
    <option>(4-6) HaBa数学</option>
    <option>(6-9) 快乐科学</option>
    <option>(3-18)夏恩英语</option>
  </select>
  </div>

  <div class="form-group">
    <label for="username" class="sr-only">学生姓名</label>
    <input type="text" class="form-control" id="username" placeholder="学生姓名">
  </div>
  
  <div class="form-group">
    <label for="age" class="sr-only">学生年龄</label>
    <input type="number" class="form-control" id="age" placeholder="学生年龄">
  </div>

  <div class="form-group">
    <label for="sex" class="sr-only">学生性别</label>
    <label class="radio-inline">
      <input type="radio" name="sex" id="sex" value="女学生"> 女
    </label>
    <label class="radio-inline">
      <input type="radio" name="sex" id="sex" value="男学生"> 男
    </label>
  </div>



  <div class="form-group">
    <label for="mobile" class="sr-only">手机号码</label>
    <input type="tel" class="form-control" id="mobile" placeholder="手机号码">
  </div>

  <div class="form-group">
    <label for="memo" class="sr-only">备注信息</label>
    <textarea class="form-control" rows="3" id="memo" placeholder="备注信息"></textarea>
  </div>

  <button type="submit" class="btn btn-success btn-lg btn-block">提交信息</button>
</form>

<!--
<form role="form">
 
      <h5 class="page-header"></h5>

      <div class="form-group">
        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">试听中心</label>
        <div class="col-sm-10">
          <select class="form-control">
            <option>请选择:</option>
            <option>菱角湖万达校区</option>
            <option>光谷步行街校区</option>
            <option>光谷时代广场校区</option>
            <option>青山奥山世纪城校区</option>
          </select>
          <div class="help-block"></div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">试听课程</label>
        <div class="col-sm-10">
          <select class="form-control">
            <option>请选择:</option>
            <option>(2-4) 创意思维</option>
            <option>(4-6) HaBa数学</option>
            <option>(6-9) 快乐科学</option>
            <option>(3-18)夏恩英语</option>
          </select>
          <div class="help-block"></div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">学生姓名</label>
        <div class="col-sm-10">
          <input type="text" name="username" class="form-control" value="" />
          <div class="help-block"></div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">学生性别</label>
        <div class="col-sm-10">
          <label for="radio_1" class="radio-inline"><input type="radio" name="sex" id="sex_1" /> 女</label>
          <label for="radio_2" class="radio-inline"><input type="radio" name="sex" id="sex_2" /> 男</label>
          <div class="help-block"></div>
      </div>

      <div class="form-group">
        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">手机号码</label>
        <div class="col-sm-10">
          <input type="tel" name="mobile" class="form-control" value="" />
          <div class="help-block"></div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">备注信息</label>
        <div class="col-sm-10">
          <textarea id="memo" name="memo" class="form-control" rows="3"></textarea>
          <div class="help-block"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-md-10 col-lg-10">
          <input name="submit" type="submit" value="提交信息" class="btn bbtn-success btn-lg btn-block" />
        </div>
      </div>
</form>
-->
</body>

</html>





