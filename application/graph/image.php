<?php
header("Content-Type: image/jpg; charset=utf-8");
$width=300;
$height = 300;

$rectx = $width/6;
$recty = $width-$width/6;


$img = imagecreate( $width , $height );
imagecolorallocate( $img ,0,0,0 );
$white = imagecolorallocate( $img , 250,250,250 );
$random = imagecolorallocate( $img , 250 ,0 ,250 );
imagefilledrectangle( $img , $rectx,$rectx,$recty,$recty , $white  );
imageline( $img , 50+200/3 , 50 , 50+200/3 ,  250 , $random );
imageline( $img , 250-200/3 , 50 , 250-200/3 ,  250 , $random );
imageline( $img , 50 , 50+200/3 , 250 ,  50+200/3 , $random );
imageline( $img , 50, 250-200/3 , 250 ,  250-200/3 , $random );
imagepng( $img );


?>