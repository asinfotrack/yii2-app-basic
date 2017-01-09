<?php

//get default configs for classes
$objectConfig = require(__DIR__ . '/object-config.php');
foreach ($objectConfig as $class=>$config) {
	Yii::$container->set($class, $config);
}

$config = [

	'id'=>'site-frontend',
	'name'=>'Site name TBD',
	'language'=>'de-CH',
	'sourceLanguage'=>'de-CH',
	'timeZone'=>'Europe/Zurich',
	'basePath'=>dirname(__DIR__),
	'bootstrap'=>['log'],

	'components'=>[

		'authManager'=>[
			'class'=>'yii\rbac\PhpManager',
		],
		'user'=>[
			'class'=>'asinfotrack\yii2\toolbox\components\User',
			'identityClass'=>'app\models\User',
			'enableAutoLogin'=>true,
			'loginUrl'=>['site/login'],
		],
		'urlManager'=>[
			'enablePrettyUrl'=>true,
			'showScriptName'=>false,
			'rules'=>[
				''=>'site/index',
				'login'=>'site/login',
				'logout'=>'site/logout',
			],
		],
		'request'=>[
			//TODO: replace this with own key!!!
			'cookieValidationKey'=>'QO_jGAVnuED1nTf1Kj8gzBtWjPx8SQSt',
		],
		'cache'=>[
			'class'=>'yii\caching\DbCache',
		],
		'errorHandler'=>[
			'errorAction'=>'site/error',
		],
		'mailer'=>[
			'class'=>'yii\swiftmailer\Mailer',
			'useFileTransport'=>YII_DEBUG || YII_ENV_DEV,
		],
		'log'=>[
			'traceLevel'=>YII_DEBUG ? 3 : 0,
			'targets'=>[
				[
					'class'=>'yii\log\FileTarget',
					'levels'=>['info', 'error', 'warning'],
					'logFile'=>'@runtime/logs/site.web.log',
					'logVars'=>[],
					'except'=>['yii\*'],
					'maxLogFiles'=>5,
				],
				[
					'class'=>'yii\log\FileTarget',
					'levels'=>['error', 'warning'],
					'logFile'=>'@runtime/logs/site.web.error.log',
					'maxLogFiles'=>5,
				],
			],
		],
		'db'=>require(__DIR__ . '/db.php'),

	],
	'params'=>require(__DIR__ . '/params.php'),
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class'=>'yii\debug\Module',
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class'=>'yii\gii\Module',
	];
}

return $config;
