<?php
//autodetect
if (isset($_SERVER['HTTP_HOST']) || isset($_SERVER['SERVER_NAME'])) {
	$host = rtrim(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'], '/');
	$isLocalhost = in_array($host, ['::1', '127.0.0.1', 'localhost']);
} else {
	$isLocalhost = true;
}

//environment vars
$isDebugEnabled = $isLocalhost;
$isProdEnabled = !$isLocalhost;

//whether or not to enable debug mode
defined('YII_DEBUG') or define('YII_DEBUG', $isDebugEnabled);
defined('YII_ENV') or define('YII_ENV', $isProdEnabled ? 'prod' : 'dev');
defined('YII_ENV_DEV') or define('YII_ENV_DEV', !$isProdEnabled);
defined('YII_ENV_DEV') or define('YII_ENV_PROD', $isProdEnabled);

//whether or not to enable db caching of schema and rbac
defined('ENABLE_SCHEMA_AND_RBAC_CACHING') or define('ENABLE_SCHEMA_AND_RBAC_CACHING', !$isDebugEnabled);
