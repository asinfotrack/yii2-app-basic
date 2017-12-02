<?php
use yii\helpers\ArrayHelper;

$objectConfig = ArrayHelper::merge(require(__DIR__ . '/object-config.php'), require(__DIR__ . '/object-config-local.php'));
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
		'cache'=>[
			//'class'=>'yii\caching\DbCache',
			'class'=>'yii\caching\FileCache',
		],
		'request'=>[
			//TODO: replace this with own key!!!
			'cookieValidationKey'=>'QO_jGAVnuED1nTf1Kj8gzBtWjPx8SQSt',
		],
		'urlManager'=>[
			'enablePrettyUrl'=>true,
			'enableStrictParsing'=>true,
			'showScriptName'=>false,
			'rules'=>[
				''=>'site/index',
				'login'=>'site/login',
				'logout'=>'site/logout',
			],
		],
		'view'=>[
			'class'=>'app\components\View',
		],
		'assetManager'=>[
			'appendTimestamp'=>true,
			'bundles'=>require(__DIR__ . '/asset-bundles.php'),
		],
		'errorHandler'=>[
			'errorAction'=>'site/error',
		],
		'mailer'=>[
			'class'=>'yii\swiftmailer\Mailer',
			'useFileTransport'=>YII_DEBUG || YII_ENV_DEV,
		],
		'image'=>array(
			'class'=>'yii\image\ImageDriver',
			'driver'=>'GD',
		),
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

		'db'=>require(__DIR__ . '/db-local.php'),

	],

	'params'=>require(__DIR__ . '/params.php'),

];

return ArrayHelper::merge($config, require(__DIR__ . '/web-local.php'));
