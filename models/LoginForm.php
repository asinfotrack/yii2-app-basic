<?php
namespace app\models;

use Yii;

class LoginForm extends \yii\base\Model
{

	public $username;
	public $password;
	public $remember = true;

	public function rules()
	{
		return [
			[['username','password'], 'required'],
			[['username'], 'email'],
			[['password'], 'string', 'max'=>128],
			[['remember'], 'boolean'],

			[['password'], 'validatePassword'],
		];
	}

	public function attributeLabels()
	{
		return [
			'username'=>'E-Mail',
			'password'=>'Passwort',
			'remember'=>'automatisch einloggen',
		];
	}

	public function validatePassword($attribute, $params)
	{
		//skip if there are errors already
		if ($this->hasErrors()) return;

		//find the user model and validate the password
		$model = User::findOne($this->username);
		if ($model === null || !$model->validatePassword($this->password)) {
			$this->addError($attribute, 'Ungültiger Benutzer oder falsches Passwort!');
		}
	}

	public function login()
	{
		//validate the data
		if (!$this->validate()) return false;

		//login the user
		$model = User::findOne($this->username);
		return Yii::$app->user->login($model, $this->remember ? 30*86400 : 0);
	}

}
