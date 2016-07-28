<?php
$lon=73.4;
$arr = array($lon);
for( $i=0;$i<20;$i++ ){
	$lon = $lon+4.5;
	$arr[] = $lon;
	if( $lon > 135.5 ){ break;}
}

include 'util/mysqli.php';

$arr2 = array(
		4,19.8,15.6,51.4
);
$count = 0;
$total_count = 0;
$arr_all = array();
foreach ( $arr2 as $lat ){
	foreach ( $arr as $lon ){

		$id = $lon."-".$lat;
// 		$file = fopen("/home/pzr/download/2016-03-15/databack{$id}",'rb');
		$filename = "/home/pzr/download/2016-03-15/databack{$id}";
// 		echo $id;
		$databack = file_get_contents( $filename );
		@error_log( "\n-------------------------{$id}-----------------------" ,3,"/tmp/tourism.log");
// 		$temp =  iconv("gbk","UTF-8",$databack);
		$json_arr = json_decode( $databack ,true );
		$list = $json_arr['list'];
		if( $list ){
			$total_count += count( $list );
			foreach ( $list as $v ){
// 				mysqlUtil::insert( 'tourism',$v );
				$arr_all[] = $v;
			}
		}
		$count++;
	}
}
print_r( $arr_all );  

// $arr_uni = array_unique( $arr_all );
echo count( $arr_uni );
echo "\n".$count."  total=$total_count";
?>