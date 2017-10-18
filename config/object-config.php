<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

$objectConfig = [

	/* button */
	'yii\bootstrap\Button'=>[
		'tagName'=>'a',
	],
	'asinfotrack\yii2\toolbox\widgets\Button'=>[
		'tagName'=>'a',
	],

	/* detail view */
	'yii\widgets\DetailView'=>[
		'options'=>['class'=>'table table-striped table-bordered table-condensed detail-view'],
	],

	/* grid view */
	'yii\grid\GridView'=>[
		'dataColumnClass'=>'asinfotrack\yii2\toolbox\widgets\grid\AdvancedDataColumn',
		'tableOptions'=>['class'=>'table table-striped table-bordered table-condensed'],
		'options'=>['class'=>'grid-view clearfix'],
		'layout'=>"{items}\n{pager}",
		'pager'=>[
			'options'=>[
				'class'=>'pagination pagination-sm pull-right',
			],
		],
	],

	/* column types */
	'asinfotrack\yii2\toolbox\widgets\grid\AdvancedDataColumn'=>[
		'filterInputOptions'=>['class'=>'form-control input-sm', 'id'=>null],
	],
	'asinfotrack\yii2\toolbox\widgets\grid\IdColumn'=>[
		'useCodeTag'=>true,
		'filterInputOptions'=>['class'=>'form-control input-sm', 'id'=>null],
		'columnWidth'=>'75px',
	],
	'asinfotrack\yii2\toolbox\widgets\grid\BooleanColumn'=>[
		'filterInputOptions'=>['class'=>'form-control input-sm', 'id'=>null],
	],
	'asinfotrack\yii2\toolbox\widgets\grid\LinkColumn'=>[
		'filterInputOptions'=>['class'=>'form-control input-sm', 'id'=>null],
	],

	/* link pager for lists and grid view */
	'yii\widgets\LinkPager'=>[
		'firstPageLabel'=>FA::icon('chevron-left'),
		'prevPageLabel'=>FA::icon('caret-left'),
		'nextPageLabel'=>FA::icon('caret-right'),
		'lastPageLabel'=>FA::icon('chevron-right'),
		'options'=>['class'=>'pagination pagination-sm'],
		'linkOptions'=>['class'=>'pagination-link'],
	],

	/* tabs */
	'yii\bootstrap\Tabs'=>[
		'linkOptions'=>['class'=>'tab-link'],
	],
	'asinfotrack\yii2\toolbox\widgets\TabsWithMemory'=>[
		'linkOptions'=>['class'=>'tab-link'],
	],

	/* action column for grid view */
	'asinfotrack\yii2\toolbox\widgets\grid\AdvancedActionColumn'=>[
		'contentOptions'=>['class'=>'action-column text-center'],
		'buttons'=>[
			'view'=>function ($url, $model) {
				return Html::a(FA::icon('eye'), $url, [
					'data-tooltip'=>Yii::t('yii', 'View'),
					'data-pjax'=>'0',
				]);
			},
			'update'=>function ($url, $model) {
				return Html::a(FA::icon('pencil'), $url, [
					'data-tooltip'=>Yii::t('yii', 'Update'),
					'data-pjax'=>'0',
				]);
			},
			'delete'=>function ($url, $model) {
				return Html::a(FA::icon('trash'), $url, [
					'data-tooltip'=>Yii::t('yii', 'Delete'),
					'data-confirm'=>Yii::t('yii', 'Are you sure you want to delete this item?'),
					'data-method'=>'post',
					'data-pjax'=>'0',
				]);
			},
		],
	],

	/* active form */
	'yii\widgets\ActiveForm'=>[
		'enableClientValidation'=>false,
	],
	'yii\bootstrap\ActiveForm'=>[
		'enableClientValidation'=>false,
	],

	/* active field */
	'yii\bootstrap\ActiveField'=>[
		'enableError'=>false,
	],

	/* date picker */
	'yii\jui\DatePicker'=>[
		'options'=>['class'=>'form-control', 'autocomplete'=>'off'],
	],

	/* tiny mce */
	'dosamigos\tinymce\TinyMce'=>[
		'options'=>['rows'=>6],
		'language'=>'de',
		'clientOptions'=>[

			'height'=>300,
			'element_format'=>'xhtml',
			'theme'=>'modern',
			'plugins'=>'link,visualblocks,visualchars,hr,charmap,table',

			//menu-, tool- and statusbar
			'menubar'=>false,
			'toolbar'=>[
				'undo redo | removeformat visualblocks visualchars | formatselect | bold italic underline strikethrough | bullist numlist hr highlight blockquote | link unlink | charmap | table',
			],
			'statusbar'=>!YII_DEBUG,

			//styles, formats and elements
			'keep_styles'=>false,
			'content_css'=>'/backend/web/css/site.css',
			'block_formats'=>'Überschrift 2=h2;Überschrift 3=h3;Überschrift 4=h4;Abschnitt=p;Highlight Abschnitt=highlight',
			'formats'=>[
				'highlight'=>['block'=>'p', 'classes'=>'highlight'],
			],
			'invalid_elements'=>'h1',

			//link plugin
			'link_title'=>false,
			'target_list'=>false,

		],
	],

	/* response */
	'yii\web\Response'=>[
		'formatters'=>[
			'pdf'=>'asinfotrack\yii2\toolbox\components\PdfResponseFormatter',
			'pdf_download'=>[
				'class'=>'asinfotrack\yii2\toolbox\components\PdfResponseFormatter',
				'forceDownload'=>true,
			],
			'img_jpg'=>[
				'class'=>'asinfotrack\yii2\toolbox\components\ImageResponseFormatter',
				'extension'=>'jpg',
			],
			'img_png'=>[
				'class'=>'asinfotrack\yii2\toolbox\components\ImageResponseFormatter',
				'extension'=>'png',
			],
			'img_gif'=>[
				'class'=>'asinfotrack\yii2\toolbox\components\ImageResponseFormatter',
				'extension'=>'gif',
			],
		],
	],

];

return ArrayHelper::merge($objectConfig, require(__DIR__ . '/object-config-local.php'));
