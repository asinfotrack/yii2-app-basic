<?php
//load environment
require(__DIR__ . '/../config/environment.php');

//load required files
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../components/Application.php');

//read config and create app instance
$config = require(__DIR__ . '/../config/web.php');
$app = new \app\components\Application($config);

//run it
$app->run();
