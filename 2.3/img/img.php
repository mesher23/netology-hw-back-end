<?php
if(mb_strlen($_GET['text'], 'UTF-8') < 13){
    header("Content-type: image/png");
    $string = $_GET['text']."\nМолодец";
    $im     = imagecreatefrompng(__DIR__.'/../img/Gerald_G_Certificate_Frame.png');
    $orange = imagecolorallocate($im, 0, 0, 0);
    $font_file = __DIR__.'/../ttf/font.ttf';
    imagettftext($im, 50, 0, 100, 195, $orange, $font_file, $string);
    imagepng($im);
    imagedestroy($im);
} else {
    echo 'Имя не должно быть больше 12 симоволов';
};
