<?php

class mysqlUtil{
	
	public static function connect($localhost , $user, $pwd , $db ){
		$mysqli = new mysqli( $localhost , $user , $pwd , $db );
		if ( mysqli_connect_errno ()) {
			printf ( "Connect failed: %s\n" ,  mysqli_connect_error ());
			exit();
		}
		return $mysqli;
	}
	
	public static function insert( $table , $arr ){
		$keys = array();
		$values = array();
		$mysqli = mysqlUtil::connect('10.130.18.206','root','qnsoft','cms');
		foreach ( $arr as $k => $v ){
			/* $keys[] = $k;
			$values[] = $v; */
			$sql = "insert into cms.".$table ."( newsid, title , status )  values ( $k , '$v' , 1 ) ;";
			echo $sql ."\n";
// 		$mysqli->query($sql);
			
			
		}
		
	}
	
	public static function select( $table ){
		$mysqli = mysqlUtil::connect('10.130.18.206','root','qnsoft','cms');
		$sql = " select candid from cms.xw_vote_activity_candidate_link where actid=".$table ;
		echo $sql."\n";
		$callback = $mysqli->query( $sql )->fetch_all(MYSQLI_ASSOC);
		return $callback;
	}
	
	public static function query($table,$arr=NULL){
		$mysqli = mysqlUtil::connect('127.0.0.1','root','','accountbook');
		//$query = "select * from accountbook.user ";//
		$key = array();
		$value = array();
		$query = "select * from ".$table." where 1=1 ";
		echo $query ."\n";
		if($arr){
			echo "this is array";
		}
		$result = $mysqli->query($query)->fetch_row();
		//print_r($result);
		
		$result2 = $mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
		print_r($result2);
		
		$result3 = $mysqli->query($query)->fetch_array(MYSQLI_ASSOC);
// 		print_r($result3);
// 		echo $result3['name'];
		
		$result4 = $mysqli->query($query)->fetch_array(MYSQLI_BOTH);
// 		print_r($result4);
		
// 		$result4->free();
		
	}
	
}

/*  $mysqli = new mysqlUtil();
$table = 'user';
$mysqli->query($table);  */



?>