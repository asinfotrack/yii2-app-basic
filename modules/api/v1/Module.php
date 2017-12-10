<?php
namespace app\modules\api\v1;

use Yii;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

	/**
	 * @inheritdoc
	 */
	public function bootstrap($app)
	{
		Yii::$app->urlManager->addRules([
			[
				'class'=>'yii\rest\UrlRule',
				'controller'=>['api-v1/user'],
				'only'=>['authenticate'],
				'pluralize'=>false,
				'patterns'=>[],
				'extraPatterns'=>[
					'POST authenticate'=>'authenticate',
				],
			],
			[
				'class'=>'yii\rest\UrlRule',
				'controller'=>['api-v1/task'],
				'pluralize'=>true,
			],
		], false);
	}

}
