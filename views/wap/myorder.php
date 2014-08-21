<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\U;
use app\models\MItem;
use app\models\MOrder;

use app\assets\JqmAsset;
JqmAsset::register($this);

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../web/images';


$gh_id = U::getSessionParam('gh_id');
Yii::$app->wx->setGhid($gh_id);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <script type="text/javascript">
        var  statusName = {'0':'等待付款', '3':'交易成功', '7':'用户取消订单', '9':'超时自动取消订单'};
    </script>

    <style type="text/CSS">

        .ui-header .ui-title, .ui-footer .ui-title {
            margin-right: 0 !important; margin-left: 0 !important;
        }
    </style>

	<?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>
<div data-role="page" id="page1" data-theme="e">
    <div data-role="header" data-theme="e">
        <h1>襄阳联通官方微信营业厅</h1>
    </div>
    

    <div data-role="content">
        <h1>我的订单</h1>

         <table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke" data-column-btn-text="选择要显示的列...">
             <thead>
               <tr>
                 <th >订单号</th>
                 <th >名称</th>
                 <!--
                 <th data-priority="1">营业厅</th>
                 -->
                 <th data-priority="2">价格</th>
                 <th >订单状态</th>
                 <th data-priority="3">时间</th>
               </tr>
             </thead>

             <tbody>
            <?php foreach($rows as $row) { ?>
               <tr>
                 <th><?php echo $row['oid'] ?></th>
                 <td><?php echo $row['title'] ?></td>
                 <!--<td><//?php echo $row['office_id'] ?></td>-->
                 <td><?php echo ($row['feesum'])/100 ?></td>

                 <td><script>document.write(statusName[<?php echo $row['status'] ?>])</script></td>

                 <td><?php echo $row['create_time'] ?></td>
               </tr>
            <?php } ?>
      
             </tbody>
           </table>     
    </div>


    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
</div> <!-- page1 end -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

