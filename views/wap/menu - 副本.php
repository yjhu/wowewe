
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\MItem;
use app\models\U;

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>


<div data-role="panel" id="<?php echo $menuId ?>" data-position="right" data-display="overlay" data-theme="a">

  <ul data-role="listview" data-inset="false"  class="ui-nodisc-icon ui-alt-icon">
    <!--
    <li data-role="list-divider">选套餐</li>

    <li><a data-ajax=false href="<?//php echo Url::to(['product', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">自由组合套餐</a></li>

    <li><a data-ajax=false href="<?//php echo Url::to(['cardxiaoyuan', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">沃派校园卡</a></li>

    <li><a data-ajax=false href="<?//php echo Url::to(['cardwo', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">微信沃卡</a></li>
    
    <li data-role="list-divider">选手机</li>
    <li><a data-ajax=false href="<?//php echo Url::to(['mobile', 'cid'=>12, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">iPhone 4S 8G 联通版</a></li>
    <li><a data-ajax=false href="<?//php echo Url::to(['mobile', 'cid'=>14, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">HTC D516W 联通版</a></li>
    <li><a data-ajax=false href="<?//php echo Url::to(['mobile', 'cid'=>13, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">CoolPad K1 联通版</a></li>

    <li data-role="list-divider">选号码</li>
    <li><a data-ajax=false href="<?//php echo Url::to(['goodnumber', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">精选靓号</a></li>

    <li data-role="list-divider">沃服务</li>
    <li><a data-ajax=false href="<?//php echo Url::to(['order', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">我的订单</a></li>
    <li><a data-ajax=false href="<?//php echo Url::to(['suggest', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">用户吐槽</a></li>
    <li><a data-ajax=false href="<?//php echo Url::to(['wap/g2048', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">游戏2048</a></li>
    -->


    <li data-role="list-divider">沃商城</li>
    <!--
    <li><a data-ajax=false href="<?//php echo Url::to(['cardxiaoyuan', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">沃派校园卡</a></li>
    -->

     <li>
         <a data-ajax=false href="https://uac.10010.com/oauth2/loginWeb06?display=wap&page_type=05&app_code=ECS-YH-SD%20&redirect_uri=http://wap.10010.com/t/loginCallBack.htm?version=sd&state=http://wap.10010.com/t/home.htm&channel_code=113000002&real_ip=221.232.49.198">
            3G国内流量包
         </a>
     </li>
  
     <li>
         <a data-ajax=false href="http://m.10010.com/mobilegoodsdetail/711403121719.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a8914879788001487d40ab930009">
            4G全国套餐
         </a>
     </li>

     <li>
         <a data-ajax=false href="http://www.10010.com/goodsdetail/711405149472.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a8914879788001487d3a26690005&menuId=000300010001">
           4G组合套餐
         </a>
     </li>


    <?php
        //$models = MItem::findAll(['kind'=>MItem::ITEM_KIND_CARD]);
        $models = MItem::find()->where(['kind'=>MItem::ITEM_KIND_CARD])->orderBy(['price'=>SORT_DESC])->all();
    ?>
    <?php foreach($models as $model) { ?>
     <li><a data-ajax=false href="<?php echo Url::to(['card', 'cid'=>$model->cid, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">
        <?= $model->title; ?>
     </a></li>
    <?php } ?>

     <li>
         <a data-ajax=false href="http://m.10010.com/mobilegoodsdetail/711407153411.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c6577d0148c6c54ae50042&menuId=000300010001">
          华为荣耀3C
         </a>
     </li>
 
    <li>
         <a data-ajax=false href="http://m.10010.com/mobilegoodsdetail/711408014789.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891487978800148826b0d5a005a">
          华为荣耀6
         </a>
     </li>

     <!--
      <li>
         <a data-ajax=false href="">
          小米红米1S
         </a>
     </li>
    -->

    <?php
        //$models = MItem::findAll(['kind'=>MItem::ITEM_KIND_MOBILE]);
     $models = MItem::find()->where(['kind'=>MItem::ITEM_KIND_MOBILE])->orderBy(['price'=>SORT_DESC])->all();
    ?>
    <?php foreach($models as $model) { ?>
     <li><a data-ajax=false href="<?php echo Url::to(['mobile', 'cid'=>$model->cid, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">
        <?= $model->title; ?>
     </a></li>
    <?php } ?>
        





    <li data-role="list-divider">沃服务</li>
    <li><a data-ajax=false href="<?php echo Url::to(['suggest', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">用户吐槽</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['wap/g2048', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">游戏2048</a></li>

    <li data-role="list-divider">沃订单</li>
    <li><a data-ajax=false href="<?php echo Url::to(['nearestoffice', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">最近营业厅</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['order', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">我的订单</a></li>


  </ul>

</div><!-- end of menu panel-->