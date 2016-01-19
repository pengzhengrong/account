<?php
$text  =  "This is the Euro symbol '我的'." ;

/* echo  'Original : ' ,  $text  ;
echo  'TRANSLIT : ' ,  iconv ( "UTF-8" ,  "ISO-8859-1" ,  $text ) ;
echo  'IGNORE   : ' ,  iconv ( "UTF-8" ,  "ISO-8859-1//IGNORE" ,  $text ),  PHP_EOL ;
echo  'Plain    : ' ,  iconv ( "UTF-8" ,  "ISO-8859-1" ,  $text ),  PHP_EOL ;
echo "\n". 'TRANSLIT : ' ,  iconv ( "ISO-8859-1" ,  "UTF-8" ,  $text ) ; */

$id = session_id();
session_start();
// echo $id." ".session_id();

$string = "hello world";
$string = str_replace( " " , "+" , $string );
echo  $string;


?>