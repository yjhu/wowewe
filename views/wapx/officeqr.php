<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>

<div data-role="page" id="dialog_office_qr" data-dialog="true">
	<div data-role="header"><h1>部门的推广二维码</h1></div>
	<div role="main" class="ui-content">
	<?php echo Html::img($office->getQrImageUrl(), ['style'=>'display: block;max-width:100%;height: auto;']); ?>
	</div>
</div>

