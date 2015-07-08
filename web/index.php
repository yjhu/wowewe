<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
//defined('YII_DEBUG') or define('YII_DEBUG', false);
//defined('YII_ENV') or define('YII_ENV', 'prod');

//require(__DIR__ . '/../vendor/hightman/xunsearch/sdk/php/lib/XS.php');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');
\Yii::$classMap['XS'] = __DIR__ . '/../vendor/hightman/xunsearch/sdk/php/lib/XS.php';
\Yii::$classMap['XSDocument'] = __DIR__ . '/../vendor/hightman/xunsearch/sdk/php/lib/XS.php';
(new yii\web\Application($config))->run();
