<?php

namespace app\models;

class WxMenu
{
	public $button = [];

	public function __construct($button=[]) 
	{
		$this->button = $button;
	}	

	public static function createDemoWxMenu()
	{		
		$menu = new WxMenu([
			new \app\models\ButtonClick('Button-1', 'key_1'),
			new \app\models\ButtonView('Button-2', 'http://hoyatech.net/wx/web/index.php'),
			new \app\models\ButtonComplex('Button-3', [
				new \app\models\ButtonClick('Button-31', 'key_31'),
				new \app\models\ButtonView('Button-32', 'http://sina.com'),
			]),
		]);
		return $menu;
	}

	public static function createDemoWxMenuOld()
	{		
		$menu = new WxMenu;
		$b1 = new \app\models\ButtonClick;
		$b1->name = "Button-One";
		$b1->type = "click";
		$b1->key = "key_1";

		$b2 = new \app\models\ButtonView;
		$b2->name = "Button-Two";
		$b2->type = "view";
		$b2->url = "http://hoyatech.net/wx/web/index.php";

		$b31 = new \app\models\ButtonClick;
		$b31->name = "Button-Three";
		$b31->type = "click";
		$b31->key = "key_31";

		$b32 = new \app\models\ButtonView;
		$b32->name = "Button-32";
		$b32->type = "view";
		$b32->url = "http://sina.com";

		$b3 = new \app\models\ButtonComplex;
		$b3->name = "Button-Three";
		$b3->sub_button = [$b31,$b32];

		$menu->button = [$b1, $b2, $b3];
		return $menu;
	}
	
}

/*
button name max length: 16 bytes (5 chinese word)
sub_button name max length: 40 bytes (13 chinese word)

*/

