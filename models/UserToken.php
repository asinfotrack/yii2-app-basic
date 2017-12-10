<?php
namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\query\UserTokenQuery;

/**
 * This is the model class for table "user_token".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $expires_at
 * @property string $token
 * @property integer $created
 * @property integer $created_by
 * @property integer $updated
 * @property integer $updated_by
 *
 * @property User $user
 * @property User $createdBy
 * @property User $updatedBy
 */
class UserToken extends \app\components\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user_token';
	}

	/**
	 * Returns the font-awesome icon name assigned to this model
	 *
	 * @return string name of the icon
	 */
	public static function iconName()
	{
		return 'key';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'timestamp'=>[
				'class'=>TimestampBehavior::className(),
				'createdAtAttribute'=>'created',
				'updatedAtAttribute'=>'updated',
			],
			'blameable'=>[
				'class'=>BlameableBehavior::className(),
				'createdByAttribute'=>'created_by',
				'updatedByAttribute'=>'updated_by',
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id','expires_at','token'], 'required'],

			[['user_id','expires_at'], 'integer'],
			[['token'], 'string'],

			[['user_id'], 'exist', 'skipOnError'=>true, 'targetClass'=>User::className(), 'targetAttribute'=>['user_id'=>'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'=>Yii::t('app', 'ID'),
			'user_id'=>Yii::t('app', 'User ID'),
			'expires_at'=>Yii::t('app', 'Expires at'),
			'token'=>Yii::t('app', 'Token'),

			'created'=>Yii::t('app', 'Created'),
			'created_by'=>Yii::t('app', 'Created by'),
			'updated'=>Yii::t('app', 'Updated'),
			'updated_by'=>Yii::t('app', 'Updated by'),
		];
	}

	/**
	 * Returns an instance of the query-type for this model
	 *
	 * @return \app\models\query\UserTokenQuery;
	 */
	public static function find()
	{
		return new UserTokenQuery(get_called_class());
	}

	public static function findOne($condition)
	{
		if (!is_numeric($condition)) {
			return static::find()->token($condition)->one();
		} else {
			return parent::findOne($condition);
		}

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id'=>'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreatedBy()
	{
		return $this->hasOne(User::className(), ['id'=>'created_by']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUpdatedBy()
	{
		return $this->hasOne(User::className(), ['id'=>'updated_by']);
	}

	/**
	 * Deletes all expired tokens
	 *
	 * @return int number of tokens deleted
	 */
	public static function deleteExpired()
	{
		$numDeleted = 0;
		foreach (UserToken::find()->expired(true)->all() as $expiredToken) {
			if ($expiredToken->delete() !== false) $numDeleted++;
		}

		return $numDeleted;
	}

}
