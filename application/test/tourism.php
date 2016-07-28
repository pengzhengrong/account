<?php 
/** 
* @desc 根据两点间的经纬度计算距离 
* @param float $lat 纬度值 
* @param float $lng 经度值 
*/
function getDistance($lat1, $lng1, $lat2, $lng2) {
	
	$earthRadius = 6367000; //approximate radius of earth in meters
	/*
	 Convert these degrees to radians
	 to work with the formula
	 */
	$lat1 = ($lat1 * pi() ) / 180;
	$lng1 = ($lng1 * pi() ) / 180;
	
	$lat2 = ($lat2 * pi() ) / 180;
	$lng2 = ($lng2 * pi() ) / 180;
	
	$calcLongitude = $lng2 - $lng1;
	$calcLatitude = $lat2 - $lat1;
	$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
	$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
	$calculatedDistance = $earthRadius * $stepTwo;
// 	return round($calculatedDistance);
	return floatval($calculatedDistance);
}

$lat1 = 77.9;
$lng1 = 35.6;

$lat2 = 82.4;
$lng2 =35.6;   //36.6+14.8=    51.4

// $distance = getDistance( $lat1,$lng1,$lat2,$lng2 );
// echo $distance;


/*  经度  纬度      经度  纬度         距离                                                   纬度差     经度差
 *  73.4     4          73.4  19.8         500公里（500145.74619578）           14.8
 *  73.4     19.8     73.4  35.6         500公里（500145.74619578）           14.8
 *  73.4      35.6    73.4  51.4         500公里（500145.74619578）           15.8                                                                                                           
 *  73.4     4          77.9    4            500公里（500063.01063516）                            4.5                                                                                            
 *                                                                                                                                      
 * 77.9      19.8     82.4    19.8                                                                                                                                     
 *  
 *  
 *  http://tourapi.tingtoutiao.com/sftour/audio/listTravelItemByPoint.do?username=xinhuaxuanwen&password=456789&lon=115.575387&lat=16.79405&page=1&pageCount=1000&distance=500
 *  
 *  lat 纬度  lon经度
 *  
 *  
 *  
 */
$lon=73.4;
$arr = array($lon);
for( $i=0;$i<20;$i++ ){
	$lon = $lon+4.5;
	$arr[] = $lon;
	if( $lon > 135.5 ){ break;}
}

// print_r( $arr );

$arr2 = array(
		4,19.8,15.6,51.4
);
$count = 0;
foreach ( $arr2 as $lat ){
	foreach ( $arr as $lon ){
		$url = 'http://tourapi.tingtoutiao.com/sftour/audio/listTravelItemByPoint.do?username=xinhuaxuanwen&password=456789&lon='.$lon.'&lat='.$lat.'&page=1&pageCount=10000&distance=500';
		
		$databack = file_get_contents( $url );
		
		$temp =  iconv("gbk","UTF-8",$databack);
		
		$now = date('Y-m-d H:i:s',time() );
		$id = $lon."-".$lat;
		$file = fopen("/home/pzr/download/2016-03-15/databack{$id}",'w+');
		fwrite( $file , $temp );
		$count++;
	}
}
echo $count;
?>