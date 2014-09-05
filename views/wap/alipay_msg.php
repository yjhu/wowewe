<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\U;
?>

    
<div data-role="page" id="page1" data-theme="c">

    <?php echo $this->render('header1', ['menuId'=>'menu1','title' => '支付宝付款']); ?>
 
    <div data-role="content">
        <?php echo $msg; ?>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
</div> <!-- page1 end -->


<?php
/*

 
 */
