<?php
namespace app\assets;

use yii\web\AssetBundle;
 
class JqmAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	
	public $css = [
		'js/jqm/demos/css/themes/default/jquery.mobile-1.4.3.min.css',	
		'js/jqm/demos/_assets/css/jqm-demos.css',
	];
	
	public $js = [
		'js/jqm/demos/js/jquery.js',		
		'js/jqm/demos/_assets/js/index.js',		
		'js/jqm/demos/js/jquery.mobile-1.4.3.min.js',		
	];
	
	public $depends = [
		//'app\assets\AppAsset',
	];
}
