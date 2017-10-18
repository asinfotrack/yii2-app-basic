<?php
use yii\helpers\ArrayHelper;

$assetBundles = [

];

return ArrayHelper::merge($assetBundles, require(__DIR__ . '/asset-bundles-local.php'));
