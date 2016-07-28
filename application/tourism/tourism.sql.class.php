<?php
$databack = array();
ini_set('memory_limit','1000M');

$start = 155000;
$end  = 160000;

// $sum = 20000;
// for( $i=0;$i<26;$i++ ){
// 	$start = $sum;
// 	$end = $start + 5000;
// 	$sum = $end;

$handle = fopen("/home/pzr/download/2016-03-21/$start-$end",'wb');
$file_name = "/home/pzr/download/2016-03-18/$start-$end";
$temp_str = file_get_contents( $file_name );
$temp_str = trim( $temp_str , ',' );
$temp_str = '['.$temp_str.']';
$temp_json = json_decode( $temp_str , true );
$count =  0;
foreach ($temp_json as $key => $value) {
	if( $value['audio'] ){
		$audio = $value['audio'];
		$sql = print_sql( $audio , 'tourism' );
		fwrite($handle, $sql);
		$count++;
	}	
}
echo $count;
// }
fclose($handle);
// $seri = serialize( $databack );



function print_sql( $arr , $table ){
	$keys = array();
	$values = array();
	foreach ( $arr as $k=>$v ){
		$keys[] = "`".$k."`";
		if( is_string( $v ) ){
			$v = addslashes( $v );
			$values[] = "'".$v."'";
			continue;
		}elseif( is_array( $v ) ){
			$values[] = "'".json_encode( $v )."'";
			// break;
			continue;
		}else{
			$values[] = $v;
		}
	}
	$sql = "insert into $table(".implode(',',$keys).")  values (".implode( ',',$values ).");";
	return $sql;
}

?>