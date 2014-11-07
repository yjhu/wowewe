<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-CN',	
    'timeZone' => 'Asia/Shanghai',	
    
    'components' => [
/*	
	'assetManager' => [
		'linkAssets' => true,		
		'bundles' => [
			'yii\web\JqueryAsset' => [
				'sourcePath' => null,
				'js' => ['http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js']
			],
		],		
	],	
		
	'cache' => [
		'class' => 'yii\caching\DummyCache',
	],		
*/	
	'cache' => [
		'class' => 'yii\caching\MemCache',
		'keyPrefix' => 'ya54dee8',
		'servers' => [
			[
				'host' => 'localhost',
				'port' => 11211,
				'weight' => 100,
			],
		],
	],			

	'request' => [
		'cookieValidationKey' => 'FHcXXyNQEu4_O_A68pFWXgK8TKYyKc2Z',
	],

	'cacheFile' => [
		'class' => 'yii\caching\FileCache',
	],
/*	
	'cache' => [
		'class' => 'yii\caching\ApcCache',
	],		
*/
	'formatter'=> [
		'datetimeFormat'=>'Y-m-d H:i:s',
		'dateFormat'=>'Y-m-d',
		'timeFormat'=>'H:i:s',
	],
	
	'user' => [
		'class' => 'app\models\WebUser',
		//'identityClass' => 'app\models\User',
		'identityClass' => 'app\models\MUser',
		'enableAutoLogin' => true,
	],
	
	'errorHandler' => [
		'errorAction' => 'site/error',
	],
	
	'mail' => [
		'class' => 'yii\swiftmailer\Mailer',
		// send all mails to a file by default. You have to set
		// 'useFileTransport' to false and configure a transport
		// for the mailer to send real emails.
		'useFileTransport' => true,
	],
/*
	'mail' => [
		'class' => 'yii\swiftmailer\Mailer',
		'transport' => [
			'class' => 'Swift_SmtpTransport',
			'host' => 'smtp.sina.com',
			'username' => 'xxx@sina.com',
			'password' => 'xxx',			
			'port' => '25',
			//'encryption' => 'tls',
		],
	],
*/        

	'log' => [
	    'traceLevel' => YII_DEBUG ? 5 : 2,
	    'targets' => [
	        [
	            'class' => 'yii\log\FileTarget',
	            //'levels' => ['error', 'warning'],
	            'levels' => ['error', 'warning', 'profile', 'info', 'trace'],	            
	        ],
	    ],
	],
	
	'db' => require(__DIR__ . '/db.php'),
	
	'wx' => require(__DIR__ . '/wx.php'),	

	'sm' => require(__DIR__ . '/sm.php'),		
	
    ],

	'modules'=>[
		'dynagrid'=>[
			'class'=>'\kartik\dynagrid\Module',
			// other settings (refer documentation)
		],
		'gridview'=>[
			'class'=>'\kartik\grid\Module',
			// other module settings
		],
	],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		'allowedIPs' => ['119.96.*.*', '101.226.*.*', '127.0.0.1', '::1']
	];
	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
