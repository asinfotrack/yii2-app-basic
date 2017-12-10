<?php
namespace app\models;

use asinfotrack\yii2\jwt\helpers\JwtTokenIssueRequest;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\validators\EmailValidator;
use asinfotrack\yii2\jwt\traits\JwtTokenTrait;
use app\models\query\UserQuery;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $acronym
 * @property integer $address_id
 * @property integer $state
 * @property string $language_code
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $status_emoji
 * @property string $status_text
 * @property string $desc
 * @property integer $created
 * @property integer $created_by
 * @property integer $updated
 * @property integer $updated_by
 *
 * @property string $displayName readonly
 * @property string $fullName readonly
 *
 * @property Address $address
 * @property \app\models\UserToken[] $tokens
 * @property User $createdBy
 * @property User $updatedBy
 */
class User extends \app\components\ActiveRecord implements \yii\web\IdentityInterface
{

	use JwtTokenTrait;

	public $password;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * Returns the font-awesome icon name assigned to this model
	 *
	 * @return string name of the icon
	 */
	public static function iconName()
	{
		return 'user';
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
			[['password'], 'trim'],
			[['password'], 'default'],
			[['auth_key'], 'default', 'value'=>function ($model, $attribute) {
				return Yii::$app->security->generateRandomString(64);
			}],

			[['auth_key','password_hash'], 'required'],
			[['address_id'], 'required', 'when'=>function ($model) { return !$model->isNewRecord; }],
			[['address_id','state'], 'integer'],
			[['desc'], 'string'],
			[['password'], 'string', 'min'=>8, 'max'=>255],
			[['acronym'], 'string', 'min'=>2, 'max'=>32],
			[['language_code'], 'string', 'max'=>2],
			[['auth_key'], 'string', 'min'=>64, 'max'=>64],
			[['password_hash','password_reset_token'], 'string', 'max'=>255],
			[['status_emoji'], 'string', 'max'=>1],
			[['status_text'], 'string', 'max'=>64],

			[['address_id'], 'exist', 'skipOnError'=>true, 'targetClass'=>Address::className(), 'targetAttribute'=>['address_id'=>'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'=>Yii::t('app', 'ID'),
			'acronym'=>Yii::t('app', 'Acronym'),
			'address_id'=>Yii::t('app', 'Address ID'),
			'state'=>Yii::t('app', 'State'),
			'language_code'=>Yii::t('app', 'Language Code'),
			'auth_key'=>Yii::t('app', 'Auth Key'),
			'password_hash'=>Yii::t('app', 'Password Hash'),
			'password_reset_token'=>Yii::t('app', 'Password Reset Token'),
			'status_emoji'=>Yii::t('app', 'Status Emoji'),
			'status_text'=>Yii::t('app', 'Status Text'),
			'desc'=>Yii::t('app', 'Desc'),
			'created'=>Yii::t('app', 'Created'),
			'created_by'=>Yii::t('app', 'Created By'),
			'updated'=>Yii::t('app', 'Updated'),
			'updated_by'=>Yii::t('app', 'Updated By'),
		];
	}

	/**
	 * Returns an instance of the query-type for this model
	 *
	 * @return \app\models\query\UserQuery;
	 */
	public static function find()
	{
		return new UserQuery(get_called_class());
	}

	/**
	 * @inheritdoc
	 */
	public static function findOne($condition)
	{
		if (is_string($condition) && (new EmailValidator())->validate($condition)) {
			return static::find()
				->joinWith('address', true)
				->where(['address.email'=>$condition])
				->one();
		} else {
			return parent::findOne($condition);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT=>self::OP_INSERT | self::OP_DELETE,
		];
	}

	/**
	 * @inheritdoc
	 */
	public function beforeValidate()
	{
		//generate password hash if necessary
		if (!empty($this->password)) {
			$this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
		}

		return parent::beforeValidate();
	}

	/**
	 * @inheritdoc
	 */
	public function save($runValidation = true, $attributeNames = null)
	{
		return parent::save($runValidation, $attributeNames);
	}

	/**
	 * Magic getter for the users display name
	 *
	 * @return string the display name
	 */
	public function getDisplayName()
	{
		$parts = [];

		if (!empty($this->address->lastname)) $parts[] = $this->address->lastname;
		if (!empty($this->address->firstname)) $parts[] = $this->address->firstname;
		if (!empty($this->address->middlename)) $parts[] = $this->address->middlename;

		if (empty($parts) && !empty($this->acronym)) $parts[] = $this->acronym;
		if (empty($parts) && !empty($this->address->email)) $parts[] = $this->address->email;
		if (empty($parts)) $parts[] = $this->id;

		return implode(' ', $parts);
	}

	/**
	 * Magic getter for the users full name
	 *
	 * @return string the display name
	 */
	public function getFullName()
	{
		$parts = [];

		if (!empty($this->address->lastname)) $parts[] = $this->address->lastname;
		if (!empty($this->address->firstname)) $parts[] = $this->address->firstname;
		if (!empty($this->address->middlename)) $parts[] = $this->address->middlename;

		return empty($parts) ? Yii::t('app', 'User without a name') : implode(' ', $parts);
	}

	/**
	 * Validates a password
	 *
	 * @param string $password the password to validate
	 * @return bool true if correct password provided
	 */
	public function validatePassword($password)
	{
		return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
	}

	/**
	 * Creates a token for the user
	 *
	 * @return bool|\app\models\UserToken either false when failed, or the user token model when successful
	 */
	public function createToken()
	{
		//prepare vars
		$jwtParams = Yii::$app->params['jwt'];
		$expiresAt = time() + $jwtParams['lifespanSeconds'];

		//prepare the token issue request
		$request = new JwtTokenIssueRequest();
		$request->setExpiresAt($expiresAt);
		if ($jwtParams['includeRoles']) {
			$roles = [];
			foreach (Yii::$app->authManager->getRoles() as $role) {
				if (Yii::$app->user->can($role->name)) $roles[] = $role->name;
			}
			$request->setPayloadEntry('roles', $roles);
		}
		if ($jwtParams['includePermissions']) {
			$permissions = [];
			foreach (Yii::$app->authManager->getPermissions() as $permission) {
				if (Yii::$app->user->can($permission->name)) $permissions[] = $permission->name;
			}
			$request->setPayloadEntry('permissions', $permissions);
		}
		$request->setPayloadEntry('dfv', 'blupp');

		//create the token depending on the algorithm
		if (strcasecmp($jwtParams['algorithm'], 'RS256') === 0) {
			$token = $this->createJwtToken($this->getId(), $jwtParams['secretAsync']['private'], $request, $jwtParams['algorithm']);
		} else {
			$token = $this->createJwtToken($this->getId(), $jwtParams['secret'], $request, $jwtParams['algorithm']);
		}

		//create the model
		$model = new UserToken([
			'token'=>$token,
			'user_id'=>$this->getId(),
			'expires_at'=>$expiresAt,
		]);

		//return result
		return $model->save() ? $model : false;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAddress()
	{
		return $this->hasOne(Address::className(), ['id'=>'address_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTokens()
	{
		return $this->hasMany(UserToken::className(), ['user_id'=>'id']);
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
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type=null)
	{
		UserToken::deleteExpired();
		$model = UserToken::findOne($token);

		return $model === null ? null : $model->user;
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
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return strcmp($this->auth_key, $authKey) === 0;
	}

}
