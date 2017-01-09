<?php
namespace app\assets;

class ModernizrAsset extends \yii\web\AssetBundle
{

	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $js = [
		'js/modernizr-custom.min.js',
	];

}
