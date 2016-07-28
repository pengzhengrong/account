<?php
header("Content-Type: image/jpg; charset=utf-8");
$width=490;
$height = 500;

$rectx = 50;
$recty = 440;

$w = $recty-$rectx;

$img = imagecreate( $width , $width );
imagecolorallocate( $img ,0,0,0 );
$white = imagecolorallocate( $img , 250,250,250 );
$random = imagecolorallocate( $img , 120,120,120 );
imagefilledrectangle( $img , $rectx,$rectx,$recty,$recty , $white  );
imagesetthickness($img,2);
imageline( $img , $rectx+$w/3 , $rectx , $rectx+$w/3 ,  $recty , $random );
imageline( $img , $recty-$w/3 , $rectx , $recty-$w/3 ,  $recty , $random );
imageline( $img , $rectx , $rectx+$w/3 , $recty ,  $rectx+$w/3 , $random );
imageline( $img , $rectx, $recty-$w/3 , $recty ,  $recty-$w/3 , $random );
imagepng( $img );


?>