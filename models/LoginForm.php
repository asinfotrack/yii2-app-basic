<?php
namespace app\models;

use Yii;

class LoginForm extends \yii\base\Model
{

	public $email;
	public $password;
	public $remember = true;

	public function rules()
	{
		return [
			[['email','password'], 'required'],
			[['email'], 'email'],
			[['password'], 'string', 'max'=>128],
			[['remember'], 'boolean'],

			[['password'], 'validatePassword'],
		];
	}

	public function attributeLabels()
	{
		return [
			'email'=>'E-Mail',
			'password'=>'Passwort',
			'remember'=>'automatisch einloggen',
		];
	}

	public function validatePassword($attribute, $params)
	{
		//skip if there are errors already
		if ($this->hasErrors()) return;

		//find the user model and validate the password
		$model = User::findIdentityByEmail($this->email);
		if ($model === null || !$model->validatePassword($this->password)) {
			$this->addError($attribute, 'Ungültiger Benutzer oder falsches Passwort!');
		}
	}

	public function login()
	{
		//validate the data
		if (!$this->validate()) return false;

		//login the user
		$model = User::findIdentityByEmail($this->email);
		return Yii::$app->user->login($model, $this->remember ? 30*86400 : 0);
	}

}
