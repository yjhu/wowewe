<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class YssAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/yss.css',
        'css/blueimp-gallery.min.css?v1',
        'css/bootstrap-image-gallery.min.css?v1',
    ];
    public $js = [
        'js/jquery.blueimp-gallery.min.js',
        'js/bootstrap-image-gallery.min.js?v1',
    ];

	public $jsOptions = ['position'=>\yii\web\View::POS_HEAD];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
