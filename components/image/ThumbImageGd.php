<?php
namespace app\components\image;

class ThumbImageGd extends \yii\image\drivers\Image_GD
{

	protected function _do_save($file, $quality)
	{
		//load if not loaded already
		$this->_load_image();

		//if a jpg gets saved, use progressive encoding
		$pathInfo = pathinfo($file);
		if (strcasecmp($pathInfo['extension'], 'jpg') === 0) {
			imageinterlace($this->_image, true);
		}

		return parent::_do_save($file, $quality);
	}

}
