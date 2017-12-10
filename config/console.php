<?php
use yii\helpers\ArrayHelper;

$config = [

	'id'=>'site-console',
	'basePath'=>dirname(__DIR__),
	'bootstrap'=>['log'],
	'controllerNamespace'=>'app\commands',

	'components'=>[

		'cache'=>[
			//'class'=>'yii\caching\DbCache',
			'class'=>'yii\caching\FileCache',
		],
		'log'=>[
			'traceLevel'=>YII_DEBUG ? 3 : 0,
			'targets'=>[
				[
					'class'=>'yii\log\FileTarget',
					'levels'=>['info', 'error', 'warning'],
					'logFile'=>'@runtime/logs/site.console.log',
					'logVars'=>[],
					'except'=>['yii\*'],
					'maxLogFiles'=>5,
				],
				[
					'class'=>'yii\log\FileTarget',
					'levels'=>['error', 'warning'],
					'logFile'=>'@runtime/logs/site.console.error.log',
					'maxLogFiles'=>5,
				],
			],
		],

		'db'=>require(__DIR__ . '/db.php')

	],

	'params'=>require(__DIR__ . '/params.php'),

];

return ArrayHelper::merge($config, require(__DIR__ . '/console-local.php'));
