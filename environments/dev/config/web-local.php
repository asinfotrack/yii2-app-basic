<?php
return [

	'bootstrap'=>['log','debug','gii'],

	'modules'=>[
		'debug'=>['class'=>'yii\debug\Module'],
		'gii'=>[
			'class'=>'yii\gii\Module',
			'generators'=>[
				'model'=>[
					'class'=>'asinfotrack\yii2\toolbox\gii\model\Generator',
					'templates'=>[
						'asiToolboxModel'=>'@vendor/asinfotrack/yii2-toolbox/gii/model/default',
					],
				],
				'crud'=>[
					'class'=>'asinfotrack\yii2\toolbox\gii\crud\Generator',
					'templates'=>[
						'asiToolboxCrud'=>'@vendor/asinfotrack/yii2-toolbox/gii/crud/default',
					],
				],
			],
		],
	],

];
