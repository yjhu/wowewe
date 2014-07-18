<?php
/*
C:\xampp\php\php.exe C:\htdocs\wx\yii timer hello
*/
namespace app\commands;

use yii\console\Controller;

class TimerController extends Controller
{
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
}
