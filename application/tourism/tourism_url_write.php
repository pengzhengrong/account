<?php

function read_url_write( $url , $save_dir , $key ){
	if( empty( $url ) || empty( $save_dir ) || empty( $key ) ){
		return;
	}
	if( !is_dir( $save_dir ) ){
		mkdir( $save_dir );
	}
	ini_set('memory_limit','1000M');
	$sum = 0;
	for ( $m=1;$m<26;$m++ ){
		$start = $sum;
		$end = $sum+1000;
		$sum = $end;
		
		$count = 0;
		
		if( !is_file( $save_dir.$start.'-'.$end ) ){
			my_log( "START {$start}-{$end}" );
			$handle = fopen("{$save_dir}{$start}-{$end}", 'wb');
			for($i=$start;$i<$end;$i++){
				$url_temp = $url.'?id='.$i.'&username=xinhuaxuanwen&password=456789';
				$arr_str = @file_get_contents( $url_temp );
				$arr_temp = json_decode( $arr_str , true );
				if( @$arr_temp[$key] ){
					fwrite( $handle ,  $arr_str.',' );
					$count++;
				}
			}
			my_log( "HANDLE $count" );
			fclose( $handle );
			my_log( "ENDED {$start}-{$end}" );
		}
	}
}

function my_log( $msg ){
	@error_log( "\n {$msg}" , 3 , '/tmp/tour.log' );
}

$save_dir = '/home/pzr/download/2016-05-04-audio/';
$url = 'http://tourapi.tingtoutiao.com/sftour/audio/getAudio.do';  $key = 'audio';

// $url = 'http://tourapi.tingtoutiao.com/sftour/video/getVideo.do'; $key = 'video';

// $url = 'http://tourapi.tingtoutiao.com/sftour/audio/getSight.do'; $key='Node';
read_url_write( $url , $save_dir , $key );
