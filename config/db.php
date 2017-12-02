<?php
use yii\helpers\ArrayHelper;

$db = [

];

return ArrayHelper::merge($db, require(__DIR__ . '/db-local.php'));
