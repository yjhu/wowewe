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

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js?v1"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js?v1"></script>

<?php
    $this->registerJs(
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       yii\web\View::POS_READY
    );
?>
<center>
<h1>会员注册</h1>
</center>

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


    <div class="form-group form-group-lg">
      <?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'placeholder'=>''])->label('您的手机号码') ?>

      <span class="row">
      <?php echo $form->field($model, 'verifyCode')->label('验证码')->widget(SmCaptcha::className(), [
        'template' => '{input}<label></label>{button}', 
        'buttonLabel' => '免费获取验证码',
      ]) ?>
      </span>
    </div>

    <br>

    <div class="form-group">
        <?= Html::submitButton('&nbsp;注册', ['class' => 'btn btn-lg btn-success btn-block glyphicon glyphicon-ok']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- mp-openidbindmobile-create -->

<button  class="btn btn-lg btn-primary btn-block glyphicon glyphicon-eye-open" id="v1DetailBtn">&nbsp;查看会员特权</button>

  <?php 
    $show = false;
    yii\bootstrap\Modal::begin([
      'header' => '<h4>在全市18家自营厅尊享会员特权服务</h4>',
      'options' => [
         'id' => 'showPlayerBox',
             'style' => 'opacity:0.95;',
      ], 
      //'footer' => "&copy; <span style='color:#d71920'>demo</span> ".date('Y'),
      'size' => 'modal-sm',
      'clientOptions' => [
        'show' => false
      ],
      'closeButton' => [
        'label' => '&times;',
              //'label' => '',
      ]
    ]);
  ?>

   <div>

    <table class="table">
          <tbody>
            <tr class="info">
              <th scope="row">1</th>
              <td>每月享受手机免费贴膜一次。</td>
            </tr>
            <tr class="info">
              <th scope="row">2</th>
              <td>购全场配件享七折优惠。</td>
            </tr>
            <tr  class="info">
              <th scope="row">3</th>
              <td>每月会员日可参与线上线下各种活动。</td>
            </tr>
            <tr  class="info">
              <th scope="row">4</th>
              <td>享受自营厅免费充/电饮水/下载手机软件等服务。</td>
            </tr>
            <tr class="info">
              <th scope="row">5</th>
              <td>享受免费停车位,购机免费送货上门【仅限市区】服务。</td>
            </tr>
            <tr  class="info">
              <th scope="row">6</th>
              <td>微信平台每周会推出微信会员特价机。</td>
            </tr>
            <!--
            <tr>
              <th scope="row">7</th>
              <td>尊享一对一人工客服;</td>
            </tr>
            -->
    </table>
  </div>

  <?php yii\bootstrap\Modal::end(); ?>



<script type="text/javascript">

  $(document).ready(function() {

    $("#v1DetailBtn").click(function(){
      $('#showPlayerBox').modal('show');
    });  
  });

</script>


<?php
/*
    <h1><?= '绑定手机号' ?></h1>

        <?= $form->field($model, 'gh_id') ?>
        <?= $form->field($model, 'openid') ?>
*/
