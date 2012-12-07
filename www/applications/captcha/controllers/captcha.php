<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Captcha_Controller extends ZP_Load {
		
	const backgroundSizeX = 2000;
	const backgroundSizeY = 350;
	const sizeX 		  = 200;
	const sizeY 		  = 50;
	const fontFile 		  = "www/applications/captcha/views/fonts/verdana.ttf";
	const backgroundFile  = "www/applications/captcha/views/img/background.png";
	const errorFile 	  = "www/applications/captcha/views/img/error.gif";

	public function __construct() { }
	

	public function index($token) {
		$text = SESSION("ZanCaptcha$token");

		if(!$this->generate($text)) {
			header( "Content-Type: image/gif" );
		    header("Expires: Mon, 21 Jul 2010 05:00:00 GMT");
		    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		    header("Cache-Control: no-store, no-cache, must-revalidate");
		    header("Cache-Control: post-check=0, pre-check=0", false);
		    header("Pragma: no-cache" );

		    @readfile(self::errorFile);
		}
	}

	private function generate($text) {
		if(!$text) return FALSE;

	    $textLength 	   = strlen($text);
	    $backgroundOffsetX = rand(0, self::backgroundSizeX - self::sizeX - 1);
	    $backgroundOffsetY = rand(0, self::backgroundSizeY - self::sizeY - 1);
	    $angle 			   = rand(-5, 5);
	    $fontColorR 	   = rand(0, 127);
	    $fontColorG 	   = rand(0, 127);
	    $fontColorB 	   = rand(0, 127);
	    $fontSize 		   = rand(14, 24);
	    $textX 			   = rand(0, (int)(self::sizeX - 0.9 * $textLength * $fontSize));
	    $textY 			   = rand((int)(1.25 * $fontSize), (int)(self::sizeY - 0.2 * $fontSize));
	    $src_im 		   = imagecreatefrompng(self::backgroundFile);

	    if(function_exists('imagecreatetruecolor')) {
	        $dst_im 	  = imagecreatetruecolor(self::sizeX, self::sizeY);
	        $resizeResult = imagecopyresampled($dst_im, $src_im, 0, 0, $backgroundOffsetX, $backgroundOffsetY, self::sizeX, self::sizeY, self::sizeX, self::sizeY);
	    } else {
	        $dst_im 	  = imagecreate(self::sizeX, self::sizeY);
	        $resizeResult = imagecopyresized($dst_im, $src_im, 0, 0, $backgroundOffsetX, $backgroundOffsetY, self::sizeX, self::sizeY, self::sizeX, self::sizeY);
	    }

	    if(!$resizeResult)
	        return FALSE;

	    $color = imagecolorallocate($dst_im, $fontColorR, $fontColorG, $fontColorB);

	    imagettftext($dst_im, $fontSize, -$angle, $textX, $textY, $color, self::fontFile, $text);

	    header("Content-Type: image/png");

	    imagepng($dst_im);

	    imagedestroy($src_im);
	    imagedestroy($dst_im);

	    return TRUE;
	}
}