<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');
Yii::setAlias('@webroot', dirname(__DIR__) . '/web');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
	'id' => 'basic-console',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'language' => 'zh-CN',	
	'timeZone' => 'Asia/Shanghai',
	'controllerNamespace' => 'app\commands',
	'components' => [

		'cacheFile' => [
			'class' => 'yii\caching\FileCache',
		],

		'cache' => [
                        'class' => 'yii\caching\DummyCache',
//			'class' => 'yii\caching\MemCache',
//			'keyPrefix' => 'ya54dee8',
//			'servers' => [
//				[
//					'host' => 'localhost',
//					'port' => 11211,
//					'weight' => 100,
//				],
//			],
		],		



/*
        	'cache' => [
        		'class' => 'yii\caching\ApcCache',
        	],	
*/

		'log' => [
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],

		'db' => $db,

		'wx' => require(__DIR__ . '/wx.php'),	      

		'sm' => require(__DIR__ . '/sm.php'),			
	],

	'params' => $params,
];
