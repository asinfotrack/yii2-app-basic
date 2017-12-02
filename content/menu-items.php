<?php
$items = [
	['label'=>'Home', 'url'=>['/site/index']],
	Yii::$app->user->isGuest ? ['label'=>'Login', 'url'=>['/site/login']] : ['label'=>'Logout', 'url'=>['/site/logout']],
];

return $items;


