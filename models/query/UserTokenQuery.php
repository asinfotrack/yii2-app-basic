<?php
namespace app\models\query;

class UserTokenQuery extends \app\components\ActiveQuery
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

	/**
	 * Named scope to filter by token
	 *
	 * @param string $token the token to look for
	 * @return \app\models\query\UserTokenQuery $this self for chaining
	 */
	public function token($token)
	{
		$this->andWhere(['user_token.token'=>$token]);
		return $this;
	}

	/**
	 * Named scope to filter either expired or not expired tokens
	 *
	 * @param bool $isExpired whether or not to look for expired tokens
	 * @return \app\models\query\UserTokenQuery $this self for chaining
	 */
	public function expired($isExpired)
	{
		$this->andWhere([$isExpired ? '<=' : '>', 'user_token.expires_at', time()]);
		return $this;
	}

}
