<?php
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
