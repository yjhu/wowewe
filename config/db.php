<?php

return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=wx',
	'username' => 'root',
	'password' => 'password#1',
	'charset' => 'utf8',
	'enableSchemaCache' => true,
	'schemaCacheDuration' => YII_DEBUG ? 10 : 3600,
];
