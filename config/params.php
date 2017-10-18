<?php
use yii\helpers\ArrayHelper;

$params = [

	'adminEmail' => 'admin@site.com',

	'users'=>[
		'100'=>[
			'email'=>'admin@site.com',
			'password'=>'asdfasdf',
			'authKey'=>'57eb676261c4e',
			'accessToken'=>'57eb6777c8f057.11113219',
		],
	],

];

return ArrayHelper::merge($params, require(__DIR__ . '/params-local.php'));
