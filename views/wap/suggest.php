<?php
use yii\helpers\Html;
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
        <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class'=>'ui-field-contain']); ?>

             <?= $form->field($ar, 'detail')->textarea(['maxlength' => '256', 'placeholder'=>'我要吐槽的详细内容'])->label(false); ?>

            <?= Html::submitButton('我要吐槽', ['class' => 'ui-shadow ui-btn ui-corner-all', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end(); ?>
            <br><br>
        <?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive','width'=>'100%']); ?>
    </div>

    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
</div> <!-- page1 end -->

<div data-role="page" id="page2" data-theme="e">
    <div data-role="header" data-add-back-btn="true" data-back-btn-text="返回">
        <h1>襄阳联通官方微信营业厅</h1>
    </div>

    <div data-role="content">
        <h3>感谢您的吐槽！</h3>
    </div>

    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
</div> <!-- page2 end -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<script>
    $(document).on("pageshow", "#page1", function(){
        //alert('aaa');

        //submit form
        /*
        $('#submitBtn').click(function(){

            $.mobile.changePage("#page2",{transition:"slide"});
            return false;
        });
        */

           /*
        $( "#contact-form" ).submit(function( event ) {
           //alert( "Handler for .submit() called." );
           //event.preventDefault();
            $.mobile.changePage("#page2",{transition:"slide"});
           // return false;

        });
        */

    });
</script>



