<?php
session_start();
$_SESSION['captcha'] = mt_rand(1000,9999);
$img = imagecreate(65,30);
$font = 'fonts/PIXEAB.TTF';

$bg = imagecolorallocate($img,28,120,255);
$textcolor = imagecolorallocate($img,0,255,0);


imagettftext($img, 14, 0, 3, 30, $textcolor, $font, $_SESSION['captcha']);

header('Content-type:image/jpeg');
imagejpeg($img);
imagedestroy($img);

?>