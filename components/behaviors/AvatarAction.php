<?php
namespace app\components\behaviors;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use asinfotrack\yii2\toolbox\helpers\ComponentConfig;

class AvatarAction extends \yii\base\Action
{

	/**
	 * @var string class name of the model class
	 */
	public $modelClass;

	public function run($id)
	{
		//validate model class
		if (empty($this->modelClass)) {
			throw new InvalidConfigException(Yii::t('app', 'You need to set the model class'));
		}

		//find model instance
		$model = $this->findModel($id);
		ComponentConfig::hasBehavior($model, AvatarBehavior::className(), true);

		//act accordingly
		$path = $model->hasCustomAvatar ? $model->avatarPath : FileHelper::normalizePath(Yii::getAlias($model->avatarPlaceholderAlias));
		if (!file_exists($path)) {
			throw new InvalidConfigException(Yii::t('app', 'The model has no avatar and the default avatar does not exist either'));
		}
		$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

		//validate extension
		if (!in_array($ext, ['jpg', 'png'])) {
			throw new InvalidConfigException(Yii::t('app', 'Only jpg and png files allowed'));
		}

		//prepare and send response
		$response = &Yii::$app->response;
		$response->getHeaders()->set('Content-Type', sprintf('image/%s', $ext === 'png' ? $ext : 'jpeg'));
		$response->getHeaders()->set('Content-length', filesize($path));
		$response->getHeaders()->set('Etag', md5_file($path));

		$response->format = Response::FORMAT_RAW;
		return file_get_contents($path);
	}

	/**
	 * Find model by id
	 *
	 * @param int $id
	 * @return \app\models\User
	 * @throws NotFoundHttpException
	 */
	protected function findModel($id)
	{
		if (($model = call_user_func([$this->modelClass, 'findOne'], $id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
