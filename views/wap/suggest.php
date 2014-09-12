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

    <?php echo $this->render('header1', ['menuId'=>'menu1','title' => '用户吐槽']); ?>
 
    <div data-role="content">
        <?php $form = ActiveForm::begin(['id' => 'contact-form','class'=>'ui-field-contain']); ?>

             <?= $form->field($ar, 'detail')->textarea(['maxlength' => '256', 'placeholder'=>'我要吐槽的详细内容'])->label(false); ?>

            <?= Html::submitButton('我要吐槽', ['class' => 'ui-shadow ui-btn ui-corner-all', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end(); ?>


        <br>
        <!--
        data-role="table"
        id="table-custom-2"
        data-mode="columntoggle"
        class="ui-body-d ui-shadow table-stripe ui-responsive"
        data-column-btn-text="选择要显示的列..."
        data-column-popup-theme="a"
        -->

	    <!-- -->
	    <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">
		    <?php foreach($rows as $row) { ?>
		    <li>
			    <img src="<?php echo U::getUserHeadimgurl($row['headimgurl'], 96);  ?> ">
			    <h2><?php echo $row['nickname'] ?></h2>

			    <p><?php echo $row['create_time_new'] ?></p>

			    <p><?php echo $row['detail'] ?></p>
		    </li>
		    <?php } ?>
	    </ul>

	    <br><br>

        <?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive','width'=>'100%']); ?>
    </div>


    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->


<?php
/*

 
 */
