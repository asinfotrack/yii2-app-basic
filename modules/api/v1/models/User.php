<?php
namespace app\modules\api\v1\models;

use yii\helpers\Url;
use yii\web\Link;

class User extends \app\models\User implements \yii\web\Linkable
{

	/**
	 * @inheritdoc
	 */
	public function extraFields()
	{
		return [];
	}

	/**
	 * @inheritdoc
	 */
	public function getLinks()
	{
		return [
			Link::REL_SELF=>Url::to(['/api-v1/user', 'id'=>$this->id]),
		];
	}
}
