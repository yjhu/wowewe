<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;
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

    </div>

    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>

</div> <!-- page1 end -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




