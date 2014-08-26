<?php
use yii\helpers\Html;
use yii\grid\GridView;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
//use yii\bootstrap\Alert;
use app\models\U;

use app\assets\JqmAsset;
JqmAsset::register($this);

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../web/images';

Yii::$app->wx->setGhid($gh_id);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    
    <style type="text/CSS">

        .ui-header .ui-title, .ui-footer .ui-title {
            margin-right: 0 !important; margin-left: 0 !important;
        }
    </style>

	<?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>
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
	    <ul data-role="listview" data-inset="true">
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


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

/*

        <?php echo GridView::widget([
           // 'options'=>['data-role'=>"table",'class' => 'ui-responsive'],
            'tableOptions'=>['data-role'=>"table",'id'=>'table-custom-2','data-column-popup-theme'=>'a','data-column-btn-text'=>'选择要显示的列...','class' => 'ui-body-d ui-shadow table-stripe ui-responsive'],
            //           'showHeader' => false,
            //           'showFooter' => false,
            'headerRowOptions' =>['style'=>'display:none'],
             'layout' => "{items}",
             'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
               // ['class' => 'yii\grid\SerialColumn'],
                //'num_iid',
               // 'id',

[
	'label' => '图像',
	'headerOptions' => array('style'=>'width:80px;'),
	'format'=>'image',
	'attribute' => 'headimgurl',
	//'value'=>function ($model, $key, $index, $column) { return U::getUserHeadimgurl($model->headimgurl, 64); },
	'value'=>function ($model, $key, $index, $column) { return U::getUserHeadimgurl($model->headimgurl, 46); },
],
                [
	                'label' => '用户昵称',
	                'headerOptions' => array('style'=>'width:100px;'),
	                'attribute' => 'nickname',
                ],
	            //'create_time',
	            [
		            'label' => '吐槽时间',
		            'headerOptions' => array('style'=>'width:200px;'),
		            'attribute' => 'create_time',
	            ],
                //'title',
                [
	                'label' => '吐槽内容',
	                'headerOptions' => array('style'=>'width:300px;'),
	                'attribute' => 'detail',
                ],

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
<br><br>


 */
