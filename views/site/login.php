<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
?>

<p>Please fill out the following fields to login:</p>

<?php $form = ActiveForm::begin([
	'id'=>'login-form',
	'layout'=>'horizontal',
	'fieldConfig'=>[
		'template'=>"{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
		'labelOptions'=>['class'=>'col-lg-1 control-label'],
	],
]); ?>

<?= $form->field($model, 'email')->textInput(['autofocus'=>true]) ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'remember')->checkbox([
	'template'=>"<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
]) ?>
<?= Html::submitButton('Login', ['class'=>'btn btn-primary', 'name'=>'login-button']) ?>

<?php ActiveForm::end(); ?>
