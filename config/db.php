<?php

if (YII_ENV_DEV) {

	//debug db config
	return [
		'class'=>'yii\db\Connection',
		'dsn'=>'mysql:host=localhost;dbname=webapp-xxx',
		'username'=>'root',
		'password'=>'',
		'charset'=>'utf8',

		'enableSchemaCache'=>ENABLE_SCHEMA_AND_RBAC_CACHING,
		'schemaCacheDuration'=>3600,
		'schemaCache'=>'cache',

		'enableQueryCache'=>!YII_DEBUG,
		'queryCacheDuration'=>3600,
	];

} else {

	//production db config
	return [
		'class'=>'yii\db\Connection',
		'dsn'=>'mysql:host=localhost;dbname=xxx',
		'username'=>'xxx',
		'password'=>'xxx',
		'charset'=>'utf8',

		'enableSchemaCache'=>ENABLE_SCHEMA_AND_RBAC_CACHING,
		'schemaCacheDuration'=>86400,
		'schemaCache'=>'cache',

		'enableQueryCache'=>!YII_DEBUG,
		'queryCacheDuration'=>3600,
	];

}
