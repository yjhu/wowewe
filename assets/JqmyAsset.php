<?php
namespace app\assets;

use yii\web\AssetBundle;
 
//class JqmAsset extends AssetBundle
class JqmyAsset extends \yii\web\JqueryAsset
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		'js/jqm/xiangyangunicom.min.whitepanel.css',
		'js/jqm/jquery.mobile.icons.min.css',
		'js/jqm/jquery.mobile.structure-1.4.3.min.css',
		'js/jqm/SpryTabbedPanels.css',

		'js/jqm/idangerous.swiper.css',
	];
	
	public $js = [
		'js/jqm/jquery.mobile-1.4.3.min.js',	
		'js/jqm/SpryTabbedPanels.js',

		'js/jqm/idangerous.swiper.min.js',
	];

	public $jsOptions = ['position'=>\yii\web\View::POS_HEAD];

	public $depends = [
		 '\yii\web\JqueryAsset',
	];
}
