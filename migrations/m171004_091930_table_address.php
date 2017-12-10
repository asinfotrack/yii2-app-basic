<?php

use yii\db\Migration;

class m171004_091930_table_address extends \asinfotrack\yii2\toolbox\console\Migration
{

	public function safeUp()
	{
		//create address table
		$this->createAuditedTable('{{%address}}', [
			'id'=>$this->primaryKey(),
			'salutation'=>$this->string(64),
			'firstname'=>$this->string(128),
			'middlename'=>$this->string(128),
			'lastname'=>$this->string(128),
			'sex'=>$this->char(1),
			'company'=>$this->string(128),
			'division'=>$this->string(128),
			'address1'=>$this->string(128),
			'address2'=>$this->string(128),
			'postbox'=>$this->string(128),
			'street'=>$this->string(128),
			'zip'=>$this->string(8),
			'city'=>$this->string(128),
			'country_code'=>'CHAR(2) NULL',
			'email'=>$this->string(128),
			'mobile'=>$this->string(128),
			'phone'=>$this->string(128),
			'fax'=>$this->string(128),
			'desc'=>$this->text(),
		]);
		$this->createIndex('IN_address_email', '{{%address}}', 'email');

		//add relation for user table
		$this->addColumn('{{%user}}', 'address_id', $this->integer()->notNull()->after('acronym')->unique());
		$this->addForeignKey('FK_user_address', '{{%user}}', 'address_id', '{{%address}}', 'id', 'CASCADE', 'CASCADE');

		return true;
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_user_address', '{{%user}}');
		$this->dropColumn('{{%user}}', 'address_id');
		$this->dropTable('{{%address}}');

		return true;
	}

}
