<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\U;

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../web/images';
Yii::$app->wx->setGhid($gh_id);
?>
    
<style type="text/CSS">
    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }
</style>


<div data-role="page" id="page1" data-theme="c">

    <?php echo $this->render('../wap/header1', ['menuId'=>'menu1','title' => '支付成功']); ?>
 
        <div data-role="content">

        <img src="<?php echo $assetsPath.'/shopcartapply.png'?>" class="img-responsive">
        <h2>恭喜！ 您已经成功支付。</h2>

        <a data-ajax=false href="<?php echo Url::to(['wap/order', 'gh_id'=>$gh_id, 'openid'=>$openid]) ?>">猛戳进入我的订单</a>

    </div>


    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('../wap/menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->


<?php
/*

 
 */
