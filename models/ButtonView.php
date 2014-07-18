<?php

namespace app\models;

class ButtonView extends \app\models\Button
{
	public $type = 'view';
	public $url;

	public function __construct($name='button', $url='') 
	{
		parent::__construct($name);
		$this->url = $url;
	}	
}

