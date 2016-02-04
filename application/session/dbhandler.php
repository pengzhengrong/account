<?php
function __session_open( $save_path , $session_name){
	global $handle;
	$handle = mysql_connect('127.0.0.1','root') or die('数据库连接失败 db connection failed');
	mysql_select_db('test',$handle) or die('数据库中没有此库名');
	return(true);
}

function __session_close(){
	global $handle;
	mysql_close( $handle );
	return(true);
}

function __session_read( $key ){
	global $handle;
	$time = time();
	$sql = "select session_data from tb_session where session_key='$key' and session_time > $time";
	$result = mysql_query( $sql , $handle);
	$row = mysql_fetch_array( $result );
	if( $row ){
		return ( $row['session_data'] );
	}else{
		return(false);
	}
}

function __session_write( $key , $data ){
	global $handle;
	$time = time()+60*60;
	$sql = "select session_data from tb_session where session_key='$key' and session_time > $time";
	$result = mysql_query( $sql , $handle);
	if( mysql_num_rows( $result ) == 0 ){
		$sql = "insert into tb_session(`session_key`,`session_data`,`session_time`) values('$key','$data',$time)";
		@error_log("\n sql=$sql",3,"/tmp/pzrlog.log");
		$result = mysql_query( $sql ,$handle );
	}else{
		$sql = "update tb_session set session_key='$key' ,session_data='$data' ,session_time=$time where sessiojn_key='$key'";
		$result = mysql_query( $sql , $handle );
	}
	@error_log("\n result=$result",3,"/tmp/pzrlog.log");
	return ($result);
}

function __session_destroy( $key ){
	global $handle;
	$sql = "delete from tb_session where session_key='$key'";
	$result = mysql_query( $sql , $handle );
	return ($results);
}

function __session_gc( $expiry_time){
	global $handle;
	$time = time();
	$sql = "delete from tb_session where expiry_time < $time";
	$result = mysql_query( $sql , $handle );
	return ($result);
}
/**
 * 
 * create table tb_session(
 * 	`id` int(11) unsigned not null auto_increment,
 * 	`session_data` varchar(100) not null default '',
 * 	`session_key` varchar(100) not null default '',
 * 	`time` int(11)  not null default 0,
 * 	primary key( `id`)
 * )engine=myisam default charset=utf8 auto_increment=1;
 * 
 */
header("Content-Type: text/html; charset=utf-8");
session_set_save_handler( '__session_open','__session_close','__session_read','__session_write','__session_destroy','__session_gc' );
session_start();
$_SESSION['user']='pzr';
$_SESSION['pwd']='123456';
echo __session_read( session_id() );



