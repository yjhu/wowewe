<?php

namespace app\models;

use Yii;
use yii\web\HttpException;
use app\models\WxException;

class MyErrorAction extends \yii\web\ErrorAction
{
	public function run()
	{
		if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
			return '';
		}

		if ($exception instanceof HttpException) {
			$code = $exception->statusCode;
		} else {
			$code = $exception->getCode();
		}
		if ($exception instanceof Exception) {
			$name = $exception->getName();
		} else {
			$name = $this->defaultName ?: Yii::t('yii', 'Error');
		}
		if ($code) {
			$name .= " (#$code)";
		}

		if ($exception instanceof WxException) {
			$resp =  json_decode($exception->getMessage(), true);	
			$message = $resp['errmsg'];
			$message .= ':'.$resp['errcode'];
		}
		else if ($exception instanceof HttpException) {
			$message = $exception->getMessage();
		}
		else if ($exception instanceof UserException) {
			$message = $exception->getMessage();
		} else {
			$message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
		}

		if (Yii::$app->getRequest()->getIsAjax()) {
			return "$name: $message";
		} else {
			return $this->controller->render($this->view ?: $this->id, [
				'name' => $name,
				'message' => $message,
				'exception' => $exception,
			]);
		}
	}

}
