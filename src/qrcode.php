<?php

function createqrcode($user_data, $prop, $direct = false)
{
	$data = str_replace("%s", is_string($prop) ? $prop : $prop['adress'], getenv('VIEW_PROPERTY_URL'));
	$size = '200x200';
	$logo = 'img/qrlogo.png';// @TODO allow custom qrlogo for premium users
	$color = '036079';
	//header('Content-type: image/png');

	$logo = imagecreatefrompng($logo);

	try
		{
		$QR = imagecreatefromstring(file_get_contents('https://api.qrserver.com/v1/create-qr-code/?ecc=Q&color=' . $color . '&size='.$size.'&data='.urlencode($data)));

		$QR_width = imagesx($QR);
		$QR_height = imagesy($QR);

		$logo_width = imagesx($logo);
		$logo_height = imagesy($logo);

		// Scale logo to fit in the QR Code
		$logo_qr_width = $QR_width/3;
		$scale = $logo_width/$logo_qr_width;
		$logo_qr_height = $logo_height/$scale;

		imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

		if($direct)
		{
			imagepng($QR);
			imagedestroy($QR);
			imagedestroy($logo);
		}
		else
		{
			ob_start();
			imagepng($QR);
			$contents =  ob_get_contents();
			ob_end_clean();

			imagedestroy($QR);
			imagedestroy($logo);
			return 'data:image/png;base64,' . base64_encode($contents);
		}
	}
	catch(Exception $e)
	{
		if($direct)
		{
			imagepng($logo);
			imagedestroy($logo);
		}
		else
		{
			ob_start();
			imagepng($logo);
			$contents =  ob_get_contents();
			ob_end_clean();
			imagedestroy($logo);

			return 'data:image/png;base64,' . base64_encode($contents);
		}
	}
}
?>
