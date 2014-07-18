<?php

namespace app\models;

use yii\web\HttpException;
use yii\base\UserException;

class WxException extends UserException
{
	public function __construct($resp = null, $code = 0, \Exception $previous = null)
	{
		parent::__construct(json_encode($resp), $code, $previous);
	}	
}

/*
		parent::__construct(500, json_encode($resp));	
*/
