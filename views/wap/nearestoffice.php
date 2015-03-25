<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
//use yii\bootstrap\Alert;
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

    <?php echo $this->render('header1', ['menuId'=>'menu1','title' => '最近营业厅']); ?>
 
    <div data-role="content">
      <h1>最近营业厅</h1>
        <p>点击微信文字输入框右边的+号, 点击'位置', 将您的位置信息发给小沃, 
        小沃会将您最近的联通营业厅信息发给您哟~</p>

        <img width='100%' src="<?php echo $assetsPath.'/nearestoffice.jpg' ?>">

    </div>


    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->


<?php
/*

 
 */
