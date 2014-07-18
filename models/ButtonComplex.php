<?php

namespace app\models;

class ButtonComplex extends \app\models\Button
{
	public $sub_button = [];

	public function __construct($name='button', $sub_button=[]) 
	{
		parent::__construct($name);
		$this->sub_button = $sub_button;
	}	
	
}

