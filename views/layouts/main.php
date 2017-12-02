<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use asinfotrack\yii2\toolbox\helpers\Html as AsiHtml;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="<?= AsiHtml::htmlClass() ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">

	<div id="nav-wrapper">
		<nav id="nav">
			<?= $this->render('partials/_nav') ?>
		</nav>
	</div>

	<div id="content-wrapper">
		<section id="content">
			<?= $content ?>
		</section>
	</div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
