<?php

namespace app\controllers;

class MarketingController extends \yii\web\Controller
{
    public $layout = 'metronic';
    
    public function actionSms()
    {
        return $this->render('sms');
    }

}
