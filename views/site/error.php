<?php
use yii\helpers\Html;

/* @var $this \app\components\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="alert alert-danger">
	<?= nl2br(Html::encode($message)) ?>
</div>
