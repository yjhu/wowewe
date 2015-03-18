<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\MGh;
use app\models\MPhoto;

use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\MArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marticle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'photo_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        MPhoto::find()->where(['gh_id'=>Yii::$app->user->getGhid()])->all(),
        'photo_id',
        'title'
    )) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'digest')->textInput(['maxlength' => 256]) ?>

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
                'imagemanager',
            ],
            'imageManagerJson' => Url::to(['/article/imagesget']),
            'imageUpload' => Url::to(['/article/imageupload']),
        ]
    ]); ?>

    <?= $form->field($model, 'content_source_url')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'show_cover_pic')->dropDownList(MGh::getNoYesOptionName()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
