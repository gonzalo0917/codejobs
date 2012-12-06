<?php
	class Captcha
	{
		public static init() {
			$text = SESSION("ZanCaptcha" . md5(getURL()));

			$this->generate($text);
		}

		private function generate($text) {
		    $backgroundSizeX = 2000;
		    $backgroundSizeY = 350;
		    $sizeX = 200;
		    $sizeY = 50;
		    $fontFile = "captcha/verdana.ttf";
		    $textLength = strlen($text);

		    $backgroundOffsetX = rand(0, $backgroundSizeX - $sizeX - 1);
		    $backgroundOffsetY = rand(0, $backgroundSizeY - $sizeY - 1);
		    $angle = rand(-5, 5);
		    $fontColorR = rand(0, 127);
		    $fontColorG = rand(0, 127);
		    $fontColorB = rand(0, 127);

		    $fontSize = rand(14, 24);
		    $textX = rand(0, (int)($sizeX - 0.9 * $textLength * $fontSize));
		    $textY = rand((int)(1.25 * $fontSize), (int)($sizeY - 0.2 * $fontSize));

		    $gdInfoArray = gd_info();
		    if (! $gdInfoArray['PNG Support'])
		        return IMAGE_ERROR_GD_TYPE_NOT_SUPPORTED;

		    $src_im = imagecreatefrompng( "captcha/background.png");
		    if (function_exists('imagecreatetruecolor')) {
		        $dst_im = imagecreatetruecolor($sizeX, $sizeY);
		        $resizeResult = imagecopyresampled($dst_im, $src_im, 0, 0, $backgroundOffsetX, $backgroundOffsetY, $sizeX, $sizeY, $sizeX, $sizeY);
		    } else {
		        $dst_im = imagecreate( $sizeX, $sizeY );
		        $resizeResult = imagecopyresized($dst_im, $src_im, 0, 0, $backgroundOffsetX, $backgroundOffsetY, $sizeX, $sizeY, $sizeX, $sizeY);
		    }

		    if (! $resizeResult)
		        return IMAGE_ERROR_GD_RESIZE_ERROR;

		    if (! function_exists('imagettftext'))
		        return IMAGE_ERROR_GD_TTF_NOT_SUPPORTED;
		    $color = imagecolorallocate($dst_im, $fontColorR, $fontColorG, $fontColorB);
		    imagettftext($dst_im, $fontSize, -$angle, $textX, $textY, $color, $fontFile, $text);

		    header("Content-Type: image/png");

		    imagepng($dst_im);

		    imagedestroy($src_im);
		    imagedestroy($dst_im);

		    return IMAGE_ERROR_SUCCESS;
		}
	}

	Captcha::init();
