<?php

echo date('Y-m-d')."\n";
echo time( date('Y-m-d') )."\n";
echo strtotime(  date('Y-m-d')) ."\n";
echo date( 'Y-m-d', strtotime(  date('Y-m-d')) );

$text  =  "This is the Euro symbol '我的'." ;

/* echo  'Original : ' ,  $text  ;
echo  'TRANSLIT : ' ,  iconv ( "UTF-8" ,  "ISO-8859-1" ,  $text ) ;
echo  'IGNORE   : ' ,  iconv ( "UTF-8" ,  "ISO-8859-1//IGNORE" ,  $text ),  PHP_EOL ;
echo  'Plain    : ' ,  iconv ( "UTF-8" ,  "ISO-8859-1" ,  $text ),  PHP_EOL ;
echo "\n". 'TRANSLIT : ' ,  iconv ( "ISO-8859-1" ,  "UTF-8" ,  $text ) ; */

// session_register();
$id = session_id();
// session_start();
// echo $id." ".session_id();

$string = "hello world";
$string = str_replace( " " , "+" , $string );
// echo  $string;

 $pattern = '/\[color=(.*)\](.*)\[\/color\]/U';
$subject = '[color=blue]字体颜色[/color]';
// echo preg_replace_callback( $pattern , 'callback' , $subject );
function callback( $str ){
	$str = "<font color=$str[1]>$str[2]</font>";
	return $str;
} 

setcookie( 'test','test');
echo $_COOKIE['test'];
// session_register();
$_SESSION['name']='pzr';
echo $_SESSION['name'];
// setcookie( 'test','',time()-1);
// echo $_COOKIE['test'];
// phpinfo();
session_id('name');
echo session_id();



?>