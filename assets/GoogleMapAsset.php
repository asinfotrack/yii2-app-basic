<?php
namespace app\assets;

/**
 * Asset to integrate google maps on a page
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class GoogleMapAsset extends \yii\web\AssetBundle
{

	public $js = [
		'https://maps.googleapis.com/maps/api/js',
	];

}
