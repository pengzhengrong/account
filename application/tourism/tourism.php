<?php


// 1.3 获取旅游景点节点
//http://tourapi.tingtoutiao.com/sftour/audio/getSight.do?id=12185&username=xinhuaxuanwen&password=456789

// 1.4 获取行政区节点
//over http://tourapi.tingtoutiao.com/sftour/audio/getDistrict.do?id=4169&username=xinhuaxuanwen&password=456789

// 1.5 获取百科（好吃，好玩，好奇）信息
//over  http://tourapi.tingtoutiao.com/sftour/audio/listBaikeList.do?endTime=14410002000&pageCount=1&username=xinhuaxuanwen&password=456789

// 1.6 获取行政区
//over http://tourapi.tingtoutiao.com/sftour/audio/listDistrict.do?username=xinhuaxuanwen&password=456789

//1.7 获取百科信息
//http://tourapi.tingtoutiao.com/sftour/audio/listBaikeByDistrict.do?id=12&username=yyyyyy&password=xxxxxx&pageCount=1

//1.8 搜索旅游音频数据(不包括百科数据)
//http://tourapi.tingtoutiao.com/sftour/audio/searchKeys.do?keys=798&username=yyyyyy&password=xxxxxx

//1.9 根据坐标点获取周围的旅游景点	
//http://tourapi.tingtoutiao.com/sftour/audio/listTravelItemByPoint.do?username=yyyyyy&password=xxxxxx&lon=116.02040499251729&lat=40.36144599181091&page=2&pageCount=10

//1.10 获取视频列表
//http://tourapi.tingtoutiao.com/sftour/video/listVideo.do?username=yyyyyy&password=xxxxxx&pageCount=2&endTime=1452132632000

//1.11 获取视频详细信息	
//http://tourapi.tingtoutiao.com/sftour/video/getVideo.do?id=2&username=yyyyyy&password=xxxxxx

// $url1 = 'http://tourapi.tingtoutiao.com/sftour/audio/listDistrict.do?username=xinhuaxuanwen&password=456789';

// $arr_xzq =  file_get_contents( $url1 );
// $file = fopen("/home/pzr/download/2016-03-18/xzq", "wb");
// fwrite($file, $arr_xzq);
/*$filename = '/home/pzr/download/2016-03-18/xzq';
$xzq = file_get_contents($filename);
$arr_xzq = json_decode( $xzq , true );
*/


/*
-- get audiolist
http://tourapi.tingtoutiao.com/sftour/audio/listAudio.do?endTime=14410002000&pageCount=100000&username=xinhuaxuanwen&password=456789
-- more count
http://tourapi.tingtoutiao.com/sftour/audio/listAudio.do?endTime=144100020&pageCount=100000&username=xinhuaxuanwen&password=456789
-- detail audio
http://tourapi.tingtoutiao.com/sftour/audio/getAudio.do?id=9407&username=yyyyyy&password=xxxxxx
-- baike
http://tourapi.tingtoutiao.com/sftour/audio/listBaikeByDistrict.do?id=12&username=yyyyyy&password=xxxxxx&pageCount=1
*/

/**
 * 读取url 并且将返回的数据写入文件
 */
ini_set('memory_limit','1000M');
$start =170000;
$end = 175000;
// $sum = 1;
// for ( $m=1;$m<35;$m++ ){
// 	$start = $sum;
// 	$end = $sum+5000;
// 	$sum = $end;
	$handle = fopen("/home/pzr/download/2016-03-18/{$start}-{$end}", 'wb');
	for($i=$start;$i<$end;$i++){
		// $i = 639;
		$url = 'http://tourapi.tingtoutiao.com/sftour/audio/getAudio.do?id='.$i.'&username=xinhuaxuanwen&password=456789';
		$arr_str = file_get_contents( $url );
		$arr_temp = json_decode( $arr_str , true );
		if( @$arr_temp['audio'] ){
			fwrite( $handle ,  $arr_str.',' );
		}
	}
	echo $start.'--'.$end."\n";
// }



fclose( $handle );

?>