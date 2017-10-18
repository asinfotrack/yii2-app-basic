<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\FileHelper;

/* @var $this \app\components\View */

$menuItems = require(FileHelper::normalizePath(Yii::getAlias('@app/content/menu-items.php')));
?>

<?php NavBar::begin([
	'brandLabel'=>'My Company',
	'brandUrl'=>Yii::$app->homeUrl,
	'options'=>[
		'class'=>'navbar-inverse navbar-fixed-top',
	],
]); ?>

<?= Nav::widget([
	'options'=>['class'=>'navbar-nav navbar-right'],
	'items'=>$menuItems,
]) ?>

<?php NavBar::end(); ?>
