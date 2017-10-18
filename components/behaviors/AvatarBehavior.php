<?php
namespace app\components\behaviors;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\image\drivers\Image;
use yii\web\UploadedFile;
use app\components\image\ThumbImageGd;
use app\components\image\ThumbImageImagick;

/**
 * Behavior to enable avatars on a model.
 *
 * Simply create a public property on the model and validate its contents
 * as an image file as follows:
 *
 * [['avatar'], 'file', 'mimeTypes'=>'image/*', 'maxSize'=>4*1024*1024],
 *
 * @property string $avatarAttribute
 * @property string $avatarPathAlias
 *
 * @property bool $hasCustomAvatar
 * @property string $avatarPath readonly
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class AvatarBehavior extends \yii\base\Behavior
{

	public $avatarAttribute = 'avatar';
	public $avatarPathAlias = '@app/runtime/avatars/{class}/{pk}.{ext}';
	public $avatarExtension = 'jpg';
	public $avatarWidth = 1000;
	public $avatarPlaceholderAlias;
	public $avatarController;
	public $avatarAction = 'avatar';

	public $processAvatarCallback;

	/**
	 * @inheritdoc
	 */
	public function attach($owner)
	{
		//assert owner extends class ActiveRecord
		if (!($owner instanceof ActiveRecord)) {
			throw new InvalidConfigException('AvatarBehavior can only be applied to classes extending \yii\db\ActiveRecord');
		}

		//assert property exists
		if (empty($this->avatarAttribute) || !$owner->hasProperty($this->avatarAttribute)) {
			throw new InvalidConfigException('No avatar attribute specified or the owner has no such property');
		}

		parent::attach($owner);
	}

	/**
	 * @inheritdoc
	 */
	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE=>'onBeforeValidate',
			ActiveRecord::EVENT_AFTER_INSERT=>'onAfterSave',
			ActiveRecord::EVENT_AFTER_UPDATE=>'onAfterSave',
		];
	}

	public function onBeforeValidate($event)
	{
		//if file is present create instance of uploaded file
		if ($this->owner->{$this->avatarAttribute} !== null && !($this->owner->{$this->avatarAttribute} instanceof UploadedFile)) {
			$this->owner->{$this->avatarAttribute} = UploadedFile::getInstance($this->owner, $this->avatarAttribute);
		}
	}

	public function onAfterSave($event)
	{
		//catch no work necessary
		$uploadedFile = $this->owner->{$this->avatarAttribute};
		if ($uploadedFile === null || !($uploadedFile instanceof UploadedFile)) return;

		//prepare path and folders
		$path = $this->avatarPath;
		FileHelper::createDirectory(StringHelper::dirname($path));

		//read image contents
		$img = extension_loaded('imagick') ? new ThumbImageImagick($path) : new ThumbImageGd($path);
		if ($this->processAvatarCallback !== null && $this->processAvatarCallback instanceof \Closure) {
			$img = call_user_func($this->processAvatarCallback, $img);
		} else {
			$img = $this->processAvatar($img);
		}

		$img->save($path, 75);
	}

	/**
	 * Processes an image instance
	 *
	 * @param \yii\image\drivers\Image $img the image to process
	 * @return \yii\image\drivers\Image the processed image
	 */
	public function processAvatar($img)
	{
		return $img->resize($this->avatarWidth, $this->avatarWidth, Image::CROP);
	}

	public function deleteAvatar()
	{
		if ($this->owner->isNewRecord) return false;
		$path = $this->avatarPath;

		return file_exists($path) ? unlink($path) : true;
	}

	public function getHasCustomAvatar()
	{
		return !$this->owner->isNewRecord && file_exists($this->avatarPath);
	}

	/**
	 * Creates the route for the avatar to show
	 *
	 * @return array array as used for url helper
	 */
	public function getAvatarRoute()
	{
		if ($this->owner->isNewRecord) return null;

		if ($this->hasCustomAvatar) {
			$path = $this->avatarPath;
		} else {
			$path = FileHelper::normalizePath(Yii::getAlias($this->avatarPlaceholderAlias));
		}

		$ctr = empty($this->avatarController) ? Inflector::camel2id(StringHelper::basename(call_user_func([$this->owner, 'className']))) : $this->avatarController;
		return ArrayHelper::merge(
			[sprintf('/%s/%s', $ctr, $this->avatarAction)],
			$this->owner->getPrimaryKey(true),
			['v'=>filemtime($path)
		]);
	}

	public function getAvatarPath()
	{
		if ($this->owner->isNewRecord) return null;

		$pk = $this->owner->primaryKey;
		$classString = Inflector::camel2id(StringHelper::basename(call_user_func([$this->owner, 'className'])));
		$pkString = Inflector::slug(is_array($pk) ? implode('-', array_values($pk)) : $pk);

		$parsedAlias = str_replace(
			['{class}', '{pk}', '{ext}'],
			[$classString, $pkString, $this->avatarExtension],
			$this->avatarPathAlias);

		return FileHelper::normalizePath(Yii::getAlias($parsedAlias));
	}
	
}
