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


$gh_id = U::getSessionParam('gh_id');
Yii::$app->wx->setGhid($gh_id);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div data-role="page" id="page1" data-theme="e">
    <div data-role="header" data-theme="e">
        <h1>襄阳联通官方微信营业厅</h1>
    </div>

    <div data-role="content">
        <?php $form = ActiveForm::begin(['id' => 'contact-form','class'=>'ui-field-contain']); ?>

             <?= $form->field($ar, 'detail')->textarea(['maxlength' => '256', 'placeholder'=>'我要吐槽的详细内容'])->label(false); ?>

            <?= Html::submitButton('我要吐槽', ['class' => 'ui-shadow ui-btn ui-corner-all', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end(); ?>


        <br><br>
        <!--
        data-role="table"
        id="table-custom-2"
        data-mode="columntoggle"
        class="ui-body-d ui-shadow table-stripe ui-responsive"
        data-column-btn-text="选择要显示的列..."
        data-column-popup-theme="a"
        -->

        <?php echo GridView::widget([
           // 'options'=>['data-role'=>"table",'class' => 'ui-responsive'],
            'tableOptions'=>['data-role'=>"table",'id'=>'table-custom-2','data-column-popup-theme'=>'a','data-column-btn-text'=>'选择要显示的列...','class' => 'ui-body-d ui-shadow table-stripe ui-responsive'],
            //            'showHeader' => false,
            //           'showFooter' => false,
            //'headerRowOptions' =>['style'=>'display:none'],
             'layout' => "{items}",
             'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
               // ['class' => 'yii\grid\SerialColumn'],
                //'num_iid',
               // 'id',
                [
                    'label' => '用户昵称',
                    'headerOptions' => array('style'=>'width:100px;'),
                    'attribute' => 'id',
                ],
                //'title',
                [
                    'label' => '吐槽内容',
                    'headerOptions' => array('style'=>'width:300px;'),
                    'attribute' => 'detail',
                ],
                //'create_time',
                [
                    'label' => '吐槽时间',
                    'headerOptions' => array('style'=>'width:200px;'),
                    'attribute' => 'create_time',
                ],
                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
            <br><br>
        <?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive','width'=>'100%']); ?>
    </div>


    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
</div> <!-- page1 end -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
