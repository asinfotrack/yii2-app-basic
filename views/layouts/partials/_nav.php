<?php
use yii\helpers\FileHelper;
use asinfotrack\yii2\toolbox\widgets\SimpleNav;

/* @var $this \app\components\View */

$menuItems = require(FileHelper::normalizePath(Yii::getAlias('@app/content/menu-items.php')));
?>

<?= SimpleNav::widget([
	'items'=>$menuItems,
]) ?>
