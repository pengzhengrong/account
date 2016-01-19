<?php
//upload
$module = $_GET['m'];
//attachments
$control = $_GET['c'];
//method
$method = $_GET['a'];

define( '__ROUT_M__' , $module );
//   echo $module." ".$control." ".$method ;
include __PATH_APP__.$module.'/'.$control.'.php';
// echo __PATH_APP__.$module.'/'.$control.'.php';
call_user_func( array( $control , $method ) );


?>