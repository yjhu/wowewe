<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\MHelpdoc;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\MHelpdoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mhelpdoc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <!--
    <//?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    -->

    <?php echo $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'zh_cn',
            'minHeight'=>200,
            'maxHeight'=>400,
            'buttonSource'=>true,
            'convertDivs'=>false,
            'removeEmptyTags'=>false,
            'plugins' => [
                'clips',
                'fullscreen',
                'fontcolor',
                'fontfamily',
                'fontsize',
                'limiter',
                'table',
                'textexpander',
                'textdirection',
                'video',
                'definedlinks',
                'filemanager',
                'imagemanager',
            ],
            'imageManagerJson' => Url::to(['/helpdoc/imagesget']),
            'imageUpload' => Url::to(['/helpdoc/imageupload']),
        ]
    ]); ?>


    <!--
    <//?= $form->field($model, 'sort')->textInput() ?>
    -->

    <!--
    <//?= $form->field($model, 'visual')->textInput() ?>
    -->

    <?= $form->field($model, 'visual')->dropDownList(MHelpdoc::getVisualOption()) ?>

    <?= $form->field($model, 'relate')->textInput(['maxlength' => 256]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
