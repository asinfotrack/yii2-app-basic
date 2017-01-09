<?php
require('environment.php');

//prepare actual config
return [

	'id'=>'site-console',
	'basePath'=>dirname(__DIR__),
	'bootstrap'=>['log'],
	'controllerNamespace'=>'app\commands',
	'modules'=>[
		'gii'=>'yii\gii\Module',
	],
	'components'=>[

		'cache'=>[
			'class'=>'yii\caching\DbCache',
		],
		'log'=>[
			'traceLevel'=>0,
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
		'db'=>require(__DIR__ . '/db.php'),

	],

	'params'=>require(__DIR__ . '/params.php'),

];
