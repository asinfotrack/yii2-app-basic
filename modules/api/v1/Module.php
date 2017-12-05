<?php
namespace app\modules\api\v1;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

	/**
	 * @inheritdoc
	 */
	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			['class'=>'yii\rest\UrlRule', 'controller'=>sprintf('%s/user', $this->id)],
		]);
	}

}
