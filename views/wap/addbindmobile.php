<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use app\models\SmCaptcha;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OpenidBindMobile */
/* @var $form ActiveForm */
?>

     <?php
          $this->registerJs(
             '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
             yii\web\View::POS_READY
          );
     ?>

<div class="openid-bind-mobile-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => false,
        'layout' => "\n{items}\n",
        'showOnEmpty' => false,
        'emptyText'=>'',
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
            [
                'attribute'=>'mobile',
                'label' => '已绑定的手机号',
            ],
             [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{deletebindmobile}',
                    'buttons' => [
                         'deletebindmobile' => function ($url, $model) {
                              return Html::a('删除', $url, [
                                   'title' => Yii::t('yii', 'Delete'),
                                   'data-confirm' => '确定不再绑定此手机号?',
                                   'data-method' => 'post',
                                   'data-pjax' => '0',
                                   //'data-pjax' => '1',
                              ]);
                         }
                    ],
               ],

        ],
    ]); ?>

</div>






<div class="mp-openidbindmobile-create">

    <br />

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success flash-success">
			<?php echo Yii::$app->session->getFlash('success'); ?>
		</div>
	<?php else: ?>
	<?php endif; ?>

    <?php //$form = ActiveForm::begin(); ?>

		<?php $form = ActiveForm::begin([
			'id' => "form_id",
			'enableClientScript'=>false,
			//'method' => 'get',
			//'options'=>['class'=>'ui-corner-all'],
			//'action' => ['wapx/staffscore'],
			'method' => 'post',
/*
			'options'=>['class'=>'ui-corner-all', 'data' => ['ajax'=>'false']],
			'fieldConfig' => [
				//'labelOptions' => ['class' => 'control-label col-sm-3'],
				//'inputOptions' => ['class' => 'form-control'],
				//'template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
				'options' => ['class' => 'ui-field-contain'],
				'inputOptions' => [],
				'labelOptions' => [],
			]               
*/
		]); ?>

		<?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'placeholder'=>'输入手机号码'])->label('') ?>

    <span class="row">
		<?php echo $form->field($model, 'verifyCode')->label('')->widget(SmCaptcha::className(), [
			'template' => '{input}<label></label>{button}',	
			'buttonLabel' => '免费获取验证码',
		]) ?>
    </span>

        <div class="form-group">
            <?= Html::submitButton('添加绑定手机号，尊享会员特权', ['class' => 'btn btn-lg btn-success btn-block']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- mp-openidbindmobile-create -->

<hr width="90%">
<h4>
绑定手机后即可成为联通微信会员
<br><br>
在全市18家自营厅尊享会员特权服务
</h4>

<table class="table">

      <tbody>
        <tr class="info">
          <th scope="row">1</th>
          <td>每月享受手机免费贴膜一次;</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>购全场配件享七折优惠;</td>
        </tr>
        <tr class="success">
          <th scope="row">3</th>
          <td>每月均有会员日,会员可参与线上线下各种活动;</td>
        </tr>
        <tr>
          <th scope="row">4</th>
          <td>享受自营厅免费充电/免费饮水/免费下载手机软件等服务;</td>
        </tr>
        <tr class="info">
          <th scope="row">5</th>
          <td>享受免费停车位,购机免费送货上门(仅限市区)服务;</td>
        </tr>
         <tr>
          <th scope="row">6</th>
          <td>可参与襄阳联通微信举办的各种微信活动;</td>
        </tr>
        <tr class="success">
          <th scope="row">7</th>
          <td>微信平台每周会推出微信会员特价机;</td>
        </tr>
</table>
<?php
/*
    <h1><?= '绑定手机号' ?></h1>

        <?= $form->field($model, 'gh_id') ?>
        <?= $form->field($model, 'openid') ?>
*/
