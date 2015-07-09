<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use vova07\imperavi\Widget;
/* @var $this yii\web\View */
/* @var $model app\models\Messagebox */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messagebox-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 256]) ?>

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
                //'filemanager',
                //'imagemanager',
            ],
            //'imageManagerJson' => Url::to(['/article/imagesget']),
            //'imageUpload' => Url::to(['/article/imageupload']),
        ]
    ]); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'receiver_type')->textInput() ?>

    <?= $form->field($model, 'receiver')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
