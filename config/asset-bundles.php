<?php

if (YII_ENV_DEV) {

	return [];

} else {

	return [
		'yii\web\JqueryAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],

		'yii\web\YiiAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'yii\widgets\PjaxAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'yii\grid\GridViewAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'yii\widgets\ActiveFormAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'yii\validators\ValidationAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'yii\captcha\CaptchaAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],

		'yii\bootstrap\BootstrapAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'css'=>['css/lib.min.css'],
		],
		'yii\bootstrap\BootstrapPluginAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],

		'rmrevin\yii\fontawesome\AssetBundle'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'css'=>['css/lib.min.css'],
		],
		'app\assets\SweetAlertAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
			'css'=>['css/lib.min.css'],
		],

		'asinfotrack\yii2\flagicons\assetsFlagIconAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'css'=>['css/lib.min.css'],
		],
		'asinfotrack\yii2\toolbox\assets\AjaxToggleButtonAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'asinfotrack\yii2\toolbox\assets\EmailDisguiseAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],

		'app\assets\ModernizrAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'app\assets\HighlightAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/lib.min.js'],
		],
		'app\assets\CytoscapeAsset'=>[
			'basePath'=>'@webroot',
			'baseUrl'=>'@web',
			'js'=>['js/cytoscape.min.js'],
		],
	];

}
