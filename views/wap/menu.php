
<?php
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\U;

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>


<div data-role="panel" id="<?php echo $menuId ?>" data-position="right" data-display="overlay">

  <ul data-role="listview" data-inset="false" data-divider-theme="a" class="ui-nodisc-icon ui-alt-icon">
    <li data-role="list-divider">选套餐</li>

    <li><a data-ajax=false href="<?php echo Url::to(['product', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">自由组合套餐</a></li>

    <li><a data-ajax=false href="<?php echo Url::to(['cardxiaoyuan', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">沃派校园卡</a></li>

    <li><a data-ajax=false href="<?php echo Url::to(['cardwo', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">微信沃卡</a></li>
    
    <li data-role="list-divider">选手机</li>
    <li><a data-ajax=false href="<?php echo Url::to(['mobile', 'cid'=>12, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">iPhone 4S 8G</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['mobile', 'cid'=>14, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">HTC D516W</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['mobile', 'cid'=>13, 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">CoolPad K1</a></li>

    <li data-role="list-divider">选号码</li>
    <li><a data-ajax=false href="<?php echo Url::to(['goodnumber', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">精选靓号</a></li>


    <li data-role="list-divider">沃服务</li>
    <li><a data-ajax=false href="<?php echo Url::to(['order', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">我的订单</a></li>
    <li><a data-ajax=false href="<?php echo Url::to(['suggest', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">用户吐槽</a></li>
    <li><a data-ajax=false href="#">游戏2048</a></li>
  </ul>

</div><!-- end of menu panel-->