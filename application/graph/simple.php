<?php

header("Content-Type: image/jpg; charset=utf-8");
// header("Content-Type: text/html; charset=utf-8");
//创建画布
$width = 100;
$height = 50;
$im = imagecreate($width, $height);

//颜色
$white  =  imagecolorallocate ( $im ,  255 ,  255 ,  255 );
$red  = imagecolorallocate( $im , 225,66,159);
$grey  =  imagecolorallocate ( $im ,  128 ,  128 ,  128 );
$black  =  imagecolorallocate ( $im ,  0 ,  0 ,  0 );

//画布上面添加字体
$r = rand(1,3);
$font = '';
if( $r == 1){
	$font = dirname(__FILE__).'/elephant.ttf';
}else{
	$font = dirname(__FILE__).'/Vineta.ttf';
}
$text ='';
for( $i =0 ; $i < 4 ; $i++){
	$text .= rand(0,9);
}
imagettftext( $im , 18 , 0 , 10 ,30 , $grey ,$font ,  $text);

//划线
imagesetthickness( $im , 2);
$r = rand(0,1);
$s = 0;
$e = 0;
if( $r ){
	$s = -30;$e=90;
}else{
	$s=150;$e=270;
}
imagearc( $im , 50,20 , 30,30, $s,$e,$black );


//输出
imagegif( $im );
imagedestroy( $im );
?>