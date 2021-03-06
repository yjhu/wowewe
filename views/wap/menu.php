
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

    <li data-role="list-divider">沃商城</li>
    <!--
    <li><a data-ajax=false href="<?//php echo Url::to(['cardxiaoyuan', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">沃派校园卡</a></li>
    -->

     <li>
         <a data-ajax=false href="<?php echo Url::to(['wap/mobilelist', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">
            <!--双11合约机-->
            特惠合约机
         </a>
     </li>

    <li>
         <a data-ajax=false href="<?php echo Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_CARD]) ?>">
            单卡产品
         </a>
     </li>    

     <li>
         <a data-ajax=false href="<?php echo Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_FLOW_CARD]) ?>">
            5折流量包
         </a>
     </li>

     <li>
         <a data-ajax=false href="<?php echo Url::to(['wap/cardlist', 'gh_id'=>$gh_id, 'openid'=>$openid, 'kind'=>MItem::ITEM_KIND_INTERNET_CARD]) ?>">
            <!--双11上网卡-->
            8折上网卡
         </a>
     </li>

    <li data-role="list-divider">沃服务</li>
    <li><a data-ajax=false href="http://wsq.qq.com/reflow/263163652-1044?_wv=1&source=">用户吐槽</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['wap/g2048', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">游戏2048</a></li>

    <li data-role="list-divider">沃订单</li>
    <li><a data-ajax=false href="<?php echo Url::to(['nearestoffice', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">最近营业厅</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['order', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">我的订单</a></li>


  </ul>

</div><!-- end of menu panel-->