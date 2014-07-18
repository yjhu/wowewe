<?php
/*
<?php if(!empty($_GET['tag'])): ?>
<h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<style type="text/css">
div.tmall_coupon_view
{
	padding: 10px;
	margin: 10px 15px 10px 0;
	border: 1px solid #C9E0ED;
	height: 320px;
}

div.pic
{
	border: 1px solid #C9E0ED;
	text-align:center;	
}

div.title
{
	margin:4px 0px;
	height:32px;
	overflow:hidden;
}

div.price
{
	margin:4px 0px;
}

div.price .fan { color:#ff0000; font-weight:bold;font-size:1.1em; }

div.nick
{
	margin:4px 0px;
	height:20px;
	overflow:hidden;
}

div.rank
{
	margin:4px 0px;
}

</style>

<div>
<?php 
$this->widget('ETaobaokeItemsCoupon'); 
?>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'id' => 'listview_id',
	'itemView'=>'tmall_coupon_view',
//	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
	'template'=>"{sorter}\n{pager}\n{items}\n{pager}",
	'sortableAttributes'=>array(
		'volume'=>'月销量',
//		'price'=>'现价',
		'credit'=>'信用',
//		'commissionRate'=>'commissionRate',		
	),

)); ?>

*/
?>

<?php
use \yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use yii\bootstrap\Tabs;

//echo "<h1>联通微商城</h1>";

echo Tabs::widget([
    'items' => [
        [
            'label' => '精选商品',
            'content' => '',
            'active' => true,
        ],
        [
            'label' => '会员信息',
            'content' => '',        
		],
        [
            'label' => '我的购物车',
            'content' => '',        
		],
/*
        [
            'label' => '$_SERVER',
            'content' => $this->render('table', ['caption' => '$_SERVER', 'values' => $panel->data['SERVER']]),
        ],
*/
    ],
]);

	$listView = new ListView([
		'dataProvider' => $dataProvider,
		'itemView' => 'mall_item',
		//'layout' => "{summary}\n{items}\n{pager}\n",
		'layout' => "{items}\n{pager}\n",
	]);
	//$listView->sorter = ['options' => ['class'=>'mail-sorter']];
?>

<?php
/*
<h1>Email messages</h1>

<div class="row">
    <div class="col-lg-2">
        <?= Html::button('Form filtering', ['class' => 'btn btn-default', 'onclick'=>'$("#email-form").toggle();']) ?>
    </div>
    <div class="row col-lg-10">
        <?= $listView->renderSorter() ?>
    </div>
</div>

<div id="email-form" style="display: none;">
    <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['/debug/default/view', 'tag'=>\Yii::$app->request->get('tag'), 'panel'=>'mail'],
    ]); ?>
    <div class="row">
        <?= $form->field($searchModel, 'from', ['options'=>['class'=>'col-lg-6']])->textInput() ?>

        <?= $form->field($searchModel, 'to', ['options'=>['class'=>'col-lg-6']])->textInput() ?>

        <?= $form->field($searchModel, 'reply', ['options'=>['class'=>'col-lg-6']])->textInput() ?>

        <?= $form->field($searchModel, 'cc', ['options'=>['class'=>'col-lg-6']])->textInput() ?>

        <?= $form->field($searchModel, 'bcc', ['options'=>['class'=>'col-lg-6']])->textInput() ?>

        <?= $form->field($searchModel, 'charset', ['options'=>['class'=>'col-lg-6']])->textInput() ?>

        <?= $form->field($searchModel, 'subject', ['options'=>['class'=>'col-lg-6']])->textInput()	?>

        <?= $form->field($searchModel, 'body', ['options'=>['class'=>'col-lg-6']])->textInput()	?>

        <div class="form-group col-lg-12">
            <?= Html::submitButton('Filter', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
*/
?>

<?= $listView->run() ?>
