<?php

class m171004_090815_table_user extends \asinfotrack\yii2\toolbox\console\Migration
{

	public function safeUp()
	{
		$this->createAuditedTable('{{%user}}', [
			'id'=>$this->primaryKey(),
			'acronym'=>$this->char(8),
			'state'=>$this->smallInteger()->notNull()->defaultValue(1),
			'language_code'=>$this->char(2),
			'auth_key'=>$this->char(64)->notNull(),
			'password_hash' =>$this->string(255)->notNull(),
			'password_reset_token'=>$this->string(255),
			'status_emoji'=>$this->char(1),
			'status_text'=>$this->string(64),
			'desc'=>$this->text(),
		]);

		return true;
	}

	public function safeDown()
	{
		$this->dropTable('{{%user}}');

		return true;
	}

}
