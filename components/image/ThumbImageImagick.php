<?php
namespace app\components\image;

class ThumbImageImagick extends \yii\image\drivers\Image_Imagick
{

	protected function _do_save($file, $quality)
	{
		//if a jpg gets saved, use progressive encoding
		$pathInfo = pathinfo($file);
		if (strcasecmp($pathInfo['extension'], 'jpg') === 0) {
			$this->im->setInterlaceScheme(\Imagick::INTERLACE_PLANE);
		}

		return parent::_do_save($file, $quality);
	}

}
