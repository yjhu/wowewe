<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MStaff;
    
?>

<?php
  include('../models/utils/emoji.php');
?>
    
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>襄阳联通</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css?v11" rel="stylesheet">

  
    <link href="./php-emoji/emoji.css" rel="stylesheet">


    <style type="text/css">

      .btn {
        border-radius: 0 ;
      }

    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>

    <script src="/wx/web/js/jquery.touchSwipe.min.js"></script>
   
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">

      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>

      <h1 class="title">
      <!--
      <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
      -->
       员工管理
      </h1>

    </header>

    <?php 
        $outlet = \app\models\ClientOutlet::findOne([ 'outlet_id' => $outlet_id ]);
    ?>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <p class="content-padded">
      <table width="100%" border=0 style="padding:3px;text-align:center">
      <tr>

        <td width=100%>
          <button class="btn btn-positive btn-block">
    
              <?= $outlet->title ?>员工总数
              <br>
              <span style="font-size:48px;font-weight:bolder;vertical-align: middle;">
              <?= ($outlet->employeeCount + $outlet->agentCount) ?>
              </span>
               <br>
              <a class="btn icon icon-plus" style="border-radius:200px;font-size:20px;background-color:#4d9b4d;border-color:#4d9b4d;color:#fff" href="#xzyg">
              新增员工
              </a>
        </button>
        </td>
      </tr>
      </table>

    </p>



    <input type="search" id="searchStr"  placeholder="按姓名、手机号查找员工">

    <ul class="table-view" id="ul-content">

        <?php 
            foreach ($outlet->employees as $employee) 
            {             
        ?>

        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['yggl2','outlet_id' => $outlet_id,'employee_id'=>$employee->employee_id, 'is_agent'=> false]) ?>">
        <img class="media-object pull-left" src="<?= (empty($employee->wechat) || empty($employee->wechat->headimgurl)) ? '../web/images/wxmpres/headimg-blank.png':$employee->wechat->headimgurl ?>" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          <?= $employee->name ?>&nbsp;<span class="badge pull-right"><?= $employee->getOutletPosition($outlet->outlet_id) ?></span>
          <p>
            手机号码 <?= implode(",", $employee->mobiles) ?>
            <br>
            <!--
            2015-05-20
            <br>
            -->
            <?php if (!empty($employee->wechat) && $employee->wechat->subscribe != 1 ) { ?>
            <span style="color:red">已取消关注</span><br/>
            <?php } ?>
          </p>
        </div>
        </a>
        </li>
        <?php } ?>
        
        <?php 
            foreach ($outlet->agents as $agent) 
            {             
        ?>

        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['yggl2','outlet_id'=>$outlet_id,'agent_id'=>$agent->agent_id, 'is_agent' => true]) ?>">
        <img class="media-object pull-left" src="<?= (empty($agent->wechat) || empty($agent->wechat->headimgurl)) ? '../web/images/wxmpres/headimg-blank.png':$agent->wechat->headimgurl ?>" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          <?= $agent->name ?>
          <p>
            手机号码 <?= implode(",", $agent->mobiles) ?>
            <br>
            <!--
            2015-05-20
            <br>
            -->
            <?php if (!empty($agent->wechat) && $agent->wechat->subscribe != 1 ) { ?>
            <span style="color:red">已取消关注</span><br/>
            <?php } ?>
          </p>
        </div>
        </a>
        </li>
        <?php } ?>
      

    </ul>

    &nbsp;
    <br>
    &nbsp;
    <br>

    </div><!-- end of content -->


    
    

    <div id="xzyg" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#xzyg"></a>
        <h1 class="title">新增员工</h1>
      </header>

      <div class="content">

          <center>
            <div class="input-group">
            
                <div class="input-row">
                  <label style="color:#777777">姓名</label>
                  <input type="text" id="ygxm">
                </div>

                <div class="input-row">
                  <label style="color:#777777">手机</label>
                   <input type="text"  id="ygsjhm">
                </div>
              
                <div class="input-row">
                  <label style="color:#777777">职位</label>
                  <input type="text" id="ygzw">
                </div>

               <p class="content-padded"> </p>
             
                <div class="input-row">
                  <label style="color:#777777">联通员工</label>
                      <div class="toggle" id="myToggle">
                      <div class="toggle-handle"></div>
                      </div>
                </div>
                <br> <br>
              <button class="btn btn-positive btn-block" style="border-radius:3px" id="addBtn">确定</button>

              <a class="btn btn-block" style="border-radius:3px" href="#xzyg"> 返回</a>
            </div>
          </center>

  
      </div>
    </div>



  <script type="text/javascript">
  //var ul-content;
  //alert($("#ul-content").html());
  var count = 0;
  var yuangongFlag = 0;
  var office_id = "<?= $outlet->outlet_id ?>";

function load_data2(i, n)
{
  count++;
  //alert(n.staff_id);
  text ="<li class=\"table-view-cell media\">"+
          "<a data-ignore='push' class='navigate-right' href=/wx/web/index.php?r=wap/yggl2&staff_id="+n.staff_id+"&searchStr="+$("#searchStr").val()+">"+
          "<div class=\"media-body\">"+
          n.name+
          "<p>"+
          "手机号码 "+n.mobile+
          "<br>"+
          "</p>"+
          "</div>"+
          "</a>"+
          "</li>";

  $("#ul-content").append(text);
}

  function ygglchaxunajax(office_id,searchStr)
  {
      //alert('czhm'+czhm+'czje'+czje);
      $.ajax({
      url: "<?php echo Url::to(['wap/ygglchaxunajax'],true); ?>",
      type:"GET",
      cache:false,
      dataType:"json",
      data: "office_id="+office_id+"&searchStr="+searchStr,
      success: function(t){

              if(t.code==0)
              {
                  //var url = "<//?//php echo Url::to(['hyzx1'],true) ?>";
                  //location.href = url+'&gh_id=<//?//= $user->gh_id ?>&openid<//?//= $user->openid ?>';
                  //alert("query ok");
                  //$("#ul-content").hide();
                  //$("#ul-content").html("<p>没有找到哟 :( </p");
                  $("#ul-content").html("");
                  $.each(t.data, load_data2);
              }
              else
              {
                alert('error');
              }

        },
        error: function(){
          alert('error!');
        }
    });

    return false;
  }


  function zjygajax(ygxm,ygsjhm,ygzw,yuangongFlag,office_id)
  {
        $.ajax({
        url: "<?php echo Url::to(['wap/zjygajax'], true) ; ?>",
        type:"GET",
        cache:false,
        dataType:"json",
        data: "ygxm="+ygxm+"&ygsjhm="+ygsjhm+"&ygzw="+ygzw+"&office_id="+office_id+"&yuangongFlag="+yuangongFlag,
        success: function(t){

                if(t.code==0)
                {
                    alert("员工已经成功加入。");
                    var url = "<?php echo Url::to(['yggl1'],true) ?>";
                    location.href = url+'&staff_id=<?= $employee->employee_id ?>';
                }
                else
                {
                  alert('error');
                }
          },
          error: function(){
            alert('error!');
          }
      });

      return false;
  }


  $(document).ready(function(){


      $('#searchStr').change(function() {
          //ajax 
          //alert($('#searchStr').val());
          var searchStr = $('#searchStr').val();

          ygglchaxunajax(office_id,searchStr);
          return false;
      }); 


      $('#myToggle').click(function(){
              if ($('#myToggle').hasClass('active'))
              {
                yuangongFlag = 1;
                //alert("内部员工:" + yuangongFlag);
              }
              else
              {
                yuangongFlag = 0;
                //alert("不是内部员工:" + yuangongFlag);
              }
      });


      $("#myToggle").swipe( {
        //Generic swipe handler for all directions
        threshold: 30,
        swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
          //$(this).text("You swiped " + direction );  
              if ($('#myToggle').hasClass('active'))
              {
                yuangongFlag = 1;
                //alert("内部员工:" + yuangongFlag);
              }
              else
              {
                yuangongFlag = 0;
                //alert("不是内部员工:" + yuangongFlag);
              }
        }
      });

      /*增加员工*/
      $("#addBtn").click(function(){
          //alert("增加员工");
          var ygxm = $("#ygxm").val();
          var ygsjhm = $("#ygsjhm").val();
          var ygzw = $("#ygzw").val();
           
          if((ygxm == ""))
          {
            alert("员工姓名不能为空，\n请重新填写。");
            return  false;
          }
 
          var usermobileReg = /(^(1)\d{10}$)/;
          if((usermobileReg.test(ygsjhm) === false) || (ygsjhm == ""))
          {
            alert("手机号码不正确，\n请重新填写。");
            return  false;
          }

          alert("员工："+ ygxm + "手机："+ygsjhm + "联通员工 :" + yuangongFlag);

          //if(!confirm("现在就增加员工，确定?"))
          //  return false;

          zjygajax(ygxm,ygsjhm,ygzw,yuangongFlag,office_id);
          return false;
      });



  })


  function back2pre()
  {
     location.href = "<?php echo Url::to(['hyzx3']) ?>";
  }


  </script>

  </body>
</html>