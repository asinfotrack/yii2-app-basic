<?php
namespace app\modules\api\v1\controllers;

class TaskController extends \app\modules\api\common\controllers\ActiveController
{

	public $modelClass = 'app\modules\api\v1\models\Task';

	protected function verbs()
	{
		return parent::verbs();
	}

	/**
	 * @inheritdoc
	 */
	public function checkAccess($action, $model = null, $params = [])
	{
		/*
		if (in_array($action, ['create','update','delete'])) {
			throw new ForbiddenHttpException();
		}
		*/
	}

}
