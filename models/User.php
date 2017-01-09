<?php
namespace app\models;

use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{

	public $id;
	public $email;
	public $password;
	public $authKey;
	public $accessToken;

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		if (!isset(Yii::$app->params['users'][$id])) {
			return null;
		} else {
			$data = Yii::$app->params['users'][$id];
			$data['id'] = $id;
			return new static($data);
		}
	}

	public static function findIdentityByEmail($email)
	{
		foreach (Yii::$app->params['users'] as $id=>$data) {
			if (strcasecmp($data['email'], $email) === 0) {
				$data['id'] = $id;
				return new static($data);
			}
		}

		return null;
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type=null)
	{
		foreach (Yii::$app->params['users'] as $id=>$data) {
			if (strcasecmp($data['accessToken'], $token) === 0) {
				$data['id'] = $id;
				return new static($data);
			}
		}

		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->authKey;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return strcmp($authKey, $this->authKey) === 0;
	}

	/**
	 * @inheritdoc
	 */
	public function validatePassword($password)
	{
		return strcmp($password, $this->password) === 0;
	}

}
