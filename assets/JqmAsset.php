<?php
namespace app\assets;

use yii\web\AssetBundle;
 
//class JqmAsset extends AssetBundle
class JqmAsset extends \yii\web\JqueryAsset
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		//'js/jqm/jquery.mobile-1.4.3.min.css',
		//'js/jqm_flatui/generated/jquery.mobile.flatui.min.css',
		'js/jqm/xiangyangunicom.min.css',
		'js/jqm/jquery.mobile.icons.min.css',
		'js/jqm/jquery.mobile.structure-1.4.3.min.css',
		
		'js/jqm/SpryTabbedPanels.css',
	];
	
	public $js = [
		'js/jqm/jquery.mobile-1.4.3.min.js',	
		'js/jqm/SpryTabbedPanels.js',
	];

	public $depends = [
		 '\yii\web\JqueryAsset',
	];
}

/*
	public $css = [
		'js/jqm/demos/css/themes/default/jquery.mobile-1.4.3.min.css',
		'js/jqm/demos/css/themes/default/jquery.mobile.structure-1.4.3.min.css',
		'js/jqm/demos/css/themes/default/jquery.mobile.theme-1.4.3.min.css',
//		'js/jqm_flatui/demo/css/jquery.mobile.flatui.css',
		'js/jqm/SpryTabbedPanels.css',	
	];
	
	public $js = [
		'js/jqm/demos/js/jquery.mobile-1.4.3.min.js',	
//		'js/jqm_flatui/demo/js/jquery.mobile-1.4.0-rc.1.js',
		'js/jqm/SpryTabbedPanels.js',
	];
*/	

