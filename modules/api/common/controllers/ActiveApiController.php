<?php
namespace app\modules\api\common\controllers;

use yii\web\ForbiddenHttpException;

class ActiveApiController extends \app\modules\api\common\controllers\ApiController
{

	/**
	 * @inheritdoc
	 */
	public function checkAccess($action, $model = null, $params = [])
	{
		if (in_array($action, ['create','update','delete'])) {
			throw new ForbiddenHttpException();
		}
	}

}
