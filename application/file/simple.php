<?php

$file = '/home/pzr/desktop/php.sh';
//{{
// readfile( $file ); //不需要echo
//}}

//{{
// $arr = file( $file );
// foreach ( $arr as $v ){
// 	echo $v."<br>"; //\n 不行
// }
//}}

//{{
// echo file_get_contents( $file , '',null, 1,10);
//}}

//---------------------------------------------------------------------------//
//{{
/*
$handle = @fopen($file , 'rb');
if( $handle ){
	//echo fgets( $handle , 5 );
	 while( ($buffer = fgets( $handle,5) )  != false ){
		echo $buffer;
	} 
	if( ! feof( $handle )){
		echo 'error file read';
	}
	fclose( $handle );	
}
 */
//}}

//--------------------------------------------------------------------//
//{{
/* $handle = @fopen($file , 'rb');
while( ( $char = fgetc( $handle ) ) !== false ){
	echo $char;
}
fclose( $handle );
 */
//}}

//{{
/* $handle = @fopen( $file , 'rb' );
echo fread( $handle , 22 )."<br>";
echo fread( $handle , filesize( $file ) );
fclose( $handle ); */
//}}

//{{
header("Content-Type: text/html; charset=utf-8");
$file = '/home/save/temp';
$handle = @fopen( $file , 'wb' ) or die('文件不存在或者权限不够');
fwrite( $handle , "this is a test");
fclose( $handle );
echo readfile( $file );

file_put_contents( $file , 'this is a test2' , FILE_APPEND );
echo readfile( $file );
//}}



?>