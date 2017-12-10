<?php

use yii\db\Query;

class m171206_095303_table_token extends \asinfotrack\yii2\toolbox\console\Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createAuditedTable('{{%user_token}}', [
			'id'=>$this->primaryKey(),
			'user_id'=>$this->integer()->notNull(),
			'expires_at'=>$this->integer()->notNull(),
			'token'=>$this->text()->notNull(),
		]);
		$this->addForeignKey('FK_user_token_user', '{{%user_token}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropTable('{{%user_token}}');

		return true;
	}

}
