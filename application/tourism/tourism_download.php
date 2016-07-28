<?php

/**
 * 根据给定的url 资源进行下载
 */
include  'tourism_wr.class.php';

function build_mp3( $mp3_url='' , $path='' , &$count=0 ){
	//$mp3_url = 'http://c.tingtoutiao.com/tour/2016-2-26/2016-02-26-14-42-51-611_wet.mp3';
	//http://c.tingtoutiao.com/tour/2015-8-29/2015-08-29-11-36-40_wet.mp3
	if( empty( $mp3_url) || empty( $path ) ){
		// die( '图片地址不能为空!' );
		return;
	}
	$dir_names = array();
	preg_match('/\d{4}-\d{1,2}-\d{1,2}/', $mp3_url , $dir_names);
	$dir_name = $dir_names[0];
	$file_names = array();
	preg_match( '/\d{4}(?:[-|_]\d{1,3}){5,6}_wet\.mp3/' , $mp3_url , $file_names );
	$file_name = $file_names[0];
	$data = file_get_contents( $mp3_url );
	if(  !is_dir( $path.$dir_name )){
		logger( "mkdir:  ",$path.$dir_name  );
		mkdir( $path.$dir_name );
	}
	if( !is_file( $path.$dir_name.'/'.$file_name ) ){
		 logger( "read MP3",$path.$dir_name.'/'.$file_name  );
		$size = file_put_contents( $path.$dir_name.'/'.$file_name , $data);
		$count++;
		logger( "close MP3",$path.$dir_name.'/'.$file_name."数据大小:$size"  );
		// $handle = fopen($path.$dir_name.'/'.$file_name,'wb');
		// fwrite($handle, $data);
		// $count++;
		// fclose( $handle );
	}
}
function build_img( $img_url='' , $path='' ,&$count=0){
// 	$img_url = 'http://c.tingtoutiao.com/tour/2015-8-29/2015-08-29-11-36-26[-1234].jpg';	
	if( empty( $img_url ) || empty( $path ) ){
		// die( '图片地址不能为空!' );
		return;
	}
	$dir_names = array();
	preg_match('/\d{4}-\d{1,2}-\d{1,2}/', $img_url , $dir_names);
	$dir_name = $dir_names[0];
	$file_names = array();
	preg_match( '/\d{4}(?:[-|_]\d{1,3}){5,6}\.jpg/' , $img_url , $file_names );
	$file_name = $file_names[0];
	$data = file_get_contents( $img_url );
	if(  !is_dir( $path.$dir_name )){
		logger( "创建文件夹",$path.$dir_name  );
		mkdir( $path.$dir_name );
	}
	if( !is_file( $path.$dir_name.'/'.$file_name ) ){
		 logger( "读取资源IMG",$path.$dir_name.'/'.$file_name  );
		$size = file_put_contents( $path.$dir_name.'/'.$file_name , $data);
		$count++;
		logger( "关闭资源IMG",$path.$dir_name.'/'.$file_name."数据大小:$size"  );
		// logger( "读取资源",$path.$dir_name.'/'.$file_name  );
		// $handle = fopen($path.$dir_name.'/'.$file_name,'wb');
		// fwrite($handle, $data);
		// $count++;
		// logger( "关闭资源",$path.$dir_name.'/'.$file_name  );
		// fclose( $handle );
	}
}

function read_file_json(  $path=''  , $type=1){
	if( empty( $path ) )  return ;
	
	$sum = 0;
	for( $i=0;$i<5;$i++ ){
		$start = $sum;
		$end = $start + 1000;
		$sum = $end;
		
	$now = time();
	logger(  "$start-$end",$now );
	if(  $type )
		$file_name = "/home/pzr/download/2016-05-04-audio/$start-$end";
	else
		$file_name = "/home/xuanwen/download/2016-03-18/$start-$end";

	$temp_str = file_get_contents( $file_name );
	$temp_str = trim( $temp_str , ',' );
	$temp_str = '['.$temp_str.']';
	$temp_json = json_decode( $temp_str , true );
	logger( "$start-$end 总共有数据" ,  count($temp_json) );
	$count =  0;
	static $img_count = 0;
	static $mp3_count = 0;
	foreach ($temp_json as $value) {
		if( $value['audio'] ){
			$audio = $value['audio'];
			$title_photo = is_empty( $audio['title_photo'] );
			$content_photo = is_empty( $audio['content_photo'] );
			$wetsound_path = is_empty( $audio['wetsound_path'] );
			
			if(  isset( $audio['addPicList'] )){
				$addPicList = is_empty( $audio['addPicList'] );
				read_pics( $addPicList , $path );
			}
			build_img( $title_photo , $path ,$img_count);
			build_img( $content_photo , $path ,$img_count);
			build_mp3( $wetsound_path , $path ,$mp3_count); 
			$count++;
		}
		if( $count == 5 ) break;
	}
	my_log( $count , $img_count , $mp3_count );
	$img_count=0;
	$mp3_count = 0;

	$use_time = time() - $now;
	logger( "$start-$end ENDED", $use_time );
	}
}

function is_empty( $string=null ){
	return empty( $string )?null:$string;
}

function read_pics( $pics ,$path ){
	if( !is_array( $pics ) )  return;
	foreach ($pics as $value) {
		$content_pic = $value['content_pic'];
		build_img( $content_pic , $path );
	}
}

function my_log( $count=0 , $img_count=0 , $mp3_count=0 ){
	@error_log( "\n HANDLE {$count} ,  IMG {$img_count} , MP3 {$mp3_count}"  ,3 ,'/tmp/tourism.log');
}

function logger( $key , $value ){
	@error_log( "\n $key : ".$value  ,3 ,'/tmp/tourism.log');
}

function test( $start=0, $end=0  ,$path=''){
	if( empty( $path ) )  return ;
	$now = time();
	logger(  "$start-$end",$now );
	$file_name = "/home/xuanwen/download/2016-03-18/$start-$end";

	$temp_str = file_get_contents( $file_name );
	$temp_str = trim( $temp_str , ',' );
	$temp_str = '['.$temp_str.']';
	$temp_json = json_decode( $temp_str , true );
	$count =  0;
	static $img_count = 0;
	static $mp3_count = 0;
	foreach ($temp_json as $value) {
		if( $value['audio'] ){
			$audio = $value['audio'];
			$title_photo = is_empty( $audio['title_photo'] );
			$content_photo = is_empty( $audio['content_photo'] );
			$wetsound_path = is_empty( $audio['wetsound_path'] );
			$addPicList = is_empty( $audio['addPicList'] );
			if( $addPicList )
				read_pics( $addPicList , $path );
			build_img( $title_photo , $path ,$img_count );
			build_img( $content_photo , $path ,$img_count );
			build_mp3( $wetsound_path , $path ,$mp3_count ); 
			$count++;
		}
		if( $count==10 ){
			break;
		} 
	}
	my_log( $count , $img_count , $mp3_count );
	$img_count=0;
	$mp3_count = 0;
	
	$use_time = time() - $now;
	logger( "$start-$end ENDED", $use_time );
}
// set_time_limit(0);
ini_set('memory_limit','1024M');
$type = 1;
if( $type ){
	$save_path = '/home/pzr/tour/';	
}else{
	$save_path = '/home/xuanwen/tour/';	
}


// test( 1,10000  , $save_path);
// $file_name = '/home/pzr/download/2016-05-04-audio/';
read_file_json( $save_path , $type );
/*$img_url = 'http://c.tingtoutiao.com/tour/2015-8-29/2015-08-29-11-36-26.jpg';	
build_img( $img_url , $path );
$mp3_url = 'http://c.tingtoutiao.com/tour/2016-2-26/2016-02-26-14-42-51-611_wet.mp3';
build_mp3( $mp3_url  , $path);*/

