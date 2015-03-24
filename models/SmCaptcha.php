<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class SmCaptcha extends InputWidget
{
    /**
     * @var string|array the route of the action that generates the CAPTCHA buttons.
     * The action represented by this route must be an action of [[CaptchaAction]].
     * Please refer to [[\yii\helpers\Url::toRoute()]] for acceptable formats.
     */
    public $captchaAction = ['site/smcaptcha'];
    /**
     * @var array HTML attributes to be applied to the CAPTCHA button tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $buttonOptions = [];
    /**
     * @var string the template for arranging the CAPTCHA button tag and the text input tag.
     * In this template, the token `{button}` will be replaced with the actual button tag,
     * while `{input}` will be replaced with the text input tag.
     */
//    public $template = '{button} {input}';
    public $template = '{input} {button}';    

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control'];

    public $buttonLabel = 'Generate verify code';

    const MOBILE_ATTRIBUTE = 'mobile';
    public $mobileAttribute;

    public function init()
    {
        parent::init();

        if (!isset($this->buttonOptions['id'])) {
            $this->buttonOptions['id'] = $this->options['id'] . '-button';
        }

        $this->mobileAttribute = self::MOBILE_ATTRIBUTE;        
    }

    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::textInput($this->name, $this->value, $this->options);
        }

/*        
        $route = $this->captchaAction;
        if (is_array($route)) {
            $route['v'] = uniqid();
        } else {
            $route = [$route, 'v' => uniqid()];
        }
        $button = Html::img($route, $this->buttonOptions);
        echo strtr($this->template, [
            '{input}' => $input,
            '{button}' => $button,
        ]);
*/
        $button = Html::buttonInput($this->buttonLabel, $this->buttonOptions);        
        echo strtr($this->template, [
            '{input}' => $input,
            '{button}' => $button,
        ]);


    }

    /**
     * Registers the needed JavaScript.
     */
/*     
    public function registerClientScript()
    {
        $options = $this->getClientOptions();
        $options = empty($options) ? '' : Json::encode($options);
        $id = $this->buttonOptions['id'];
        $view = $this->getView();
        CaptchaAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiCaptcha($options);");
    }
*/
    public function registerClientScript()
    {
//        $options = $this->getClientOptions();
        $options = empty($options) ? '' : Json::encode($options);
        $id = $this->buttonOptions['id'];
        $view = $this->getView();
//        CaptchaAsset::register($view);
//        $view->registerJs("jQuery('#$id').yiiCaptcha($options);");
        $verifyCodeId = Html::getInputId($this->model, $this->attribute);
        $mobileId = Html::getInputId($this->model, $this->mobileAttribute);        
        $route = $this->captchaAction;        
        $url = Url::to($route);

        $js = <<< JS
var wait = 120;  
get_code_time = function (btn) 
{  
    if (wait == 0) 
    {  
        btn.removeAttribute('disabled');
        btn.value = '等待';
        wait = 120;
    } 
    else 
    {  
        btn.setAttribute('disabled', true);
        btn.value = '等待 (' + wait + ')...';
        wait--;
        setTimeout(function() {  
            get_code_time(btn);
        }, 1000);
    }  
};  

jQuery('#{$id}').on('click', function () {
    var btn = this;
    jQuery.ajax({
        url: '{$url}',
        data: { $this->mobileAttribute: jQuery('#$mobileId').val() },
        dataType: 'json',
        cache: false,
        error: function(XHR, textStatus, errorThrown, err) {
        	alert(XHR.responseText);
        },
        success: function(data) {
//            alert(data['code']);
            jQuery('#{$verifyCodeId}').val('');
            //alert(data['hash2']);
            if (data['code'] == 0)
                alert('验证码已发送');            
            get_code_time(btn);
        }
    });
    return false;
});
JS;

        $view->registerJs($js);

    }


}

/*
    protected function getClientOptions()
    {
        $route = $this->captchaAction;
        if (is_array($route)) {
            $route[CaptchaAction::REFRESH_GET_VAR] = 1;
        } else {
            $route = [$route, CaptchaAction::REFRESH_GET_VAR => 1];
        }

        $options = [
            'refreshUrl' => Url::toRoute($route),
            'hashKey' => "yiiCaptcha/{$route[0]}",
        ];

        return $options;
    }

    public function registerAssets()
    {
        $view = $this->getView();
//        MaskMoneyAsset::register($view);
//        $id = 'jQuery("#' . $this->_displayOptions['id'] . '")';
        $id = $this->buttonOptions['id'];
        
//        $idSave = 'jQuery("#' . $this->options['id'] . '")';
//        $this->registerPlugin('maskMoney', $id);
        $js = <<< JS
//var val = parseFloat({$idSave}.val());
//{$id}.maskMoney('mask', val);
{$id}.on('click', function () {
alert('abc');
//     var numDecimal = {$id}.maskMoney('unmasked')[0];
//    {$idSave}.val(numDecimal);
//    {$idSave}.trigger('change');
});
JS;
        $view->registerJs($js);
    }
*/

