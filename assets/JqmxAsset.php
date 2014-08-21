<?php
namespace app\assets;

use yii\web\AssetBundle;
 
class JqmxAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		'js/jqm/jquery.mobile-1.4.3.min.css',
	];
	
	public $js = [
		'js/jqm/jquery.mobile-1.4.3.min.js',	
	];

	public $jsOptions = ['position'=>\yii\web\View::POS_HEAD];
	
	public $depends = [
		 '\yii\web\JqueryAsset',
	];
}

/*
*/	

