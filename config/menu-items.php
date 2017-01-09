<?php
$items = [
	['label'=>'Home', 'url'=>['/site/index']],
];

if (Yii::$app->user->isGuest) {
	$items[] = ['label'=>'Login', 'url'=>['/site/login']];
} else {
	$items[] = ['label'=>'Logout', 'url'=>['/site/logout']];
}

return $items;


