<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main asset bundle
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class AppAsset extends AssetBundle
{

	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [];
	public $js = [];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
		'rmrevin\yii\fontawesome\AssetBundle',

		'app\assets\ModernizrAsset',
		'app\assets\SweetAlertAsset',
	];

	public function init()
	{
		parent::init();

		//add main page js
		$this->js[] = YII_DEBUG ? 'js/site.js' : 'js/site.min.js';

		//add main page css
		$this->css[] = YII_DEBUG ? 'css/site.css' : 'css/site.min.css';
	}


}
