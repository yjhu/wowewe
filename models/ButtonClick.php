<?php

namespace app\models;

class ButtonClick extends \app\models\Button
{
	public $type = 'click';
	public $key;
	
	public function __construct($name='button', $key='10') 
	{
		parent::__construct($name);
		$this->key = $key;
	}	
	
}

