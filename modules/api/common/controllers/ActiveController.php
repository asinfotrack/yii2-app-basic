<?php
namespace app\modules\api\common\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;

class ActiveController extends \yii\rest\ActiveController
{

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		unset($behaviors['authenticator']);

		$behaviors['cors'] = [
			'class'=>Cors::className(),
		];
		$behaviors['authenticator'] = [
			'class'=>HttpBearerAuth::className(),
			'except'=>['options'],
		];

		return $behaviors;
	}

}
