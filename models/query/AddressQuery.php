<?php
namespace app\models\query;

class AddressQuery extends \app\components\ActiveQuery
{

	/**
	 * @inheritdoc
	 */
	public function prepare($builder)
	{
		//default ordering
		if (empty($this->orderBy)) {
			//add default ordering scope here if desired
		}

		return parent::prepare($builder);
	}

}
