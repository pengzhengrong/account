<?php

Class tourism{

	public $readPath ;

	public $writePath;

	public $basePath;

	public $logPath;

	public $type ;

	public $img_count = 0;

	public $mp3_count = 0;

	public $failed = array();

	public function __construct( $readPath , $basePath='/home/pzr/tour'  , $type = 'mp3',$logPath='/tmp/tourism.log' ){
		$this->readPath = $readPath;
		$this->basePath = $basePath;
		$this->logPath = $logPath;
		$this->type = $type;
	}

	public function read_file( $start , $end ){
		$file = $this->readPath."{$this->type}$start-$end.json";
		$Json_temp = file_get_contents($file);
		$json = json_decode( $Json_temp , true);
		return $json;
	}

	public function write_url( $data ){
		if( !is_array($data) ) return;
		foreach ($data as $key => $url) {
			$source = $this->read( $url );
			
			if( $this->type == 'img' ){
				$savePath = $this->buildSavePath_img( $url );
			}else{
				$savePath = $this->buildSavePath_mp3( $url );
			}
			$this->write( $source , $savePath );
			if( $key > 0 && $key%10 == 0 ){
				$this->logger( '' , $key  ,true);
				break;
			}
			// die;
		}
	}

	public function buildSavePath_img( $url){
		$dir_names = array();
		preg_match('/\/\d{4}-\d{1,2}-\d{1,2}\//', $url , $dir_names);
		$dir_name = $this->basePath.$dir_names[0];
		// echo $dir_name;die;
		if( !is_dir($dir_name) ){
			mkdir($dir_name);
		}
		
		$file_names = array();
		preg_match( '/\d{4}(?:[-|_]\d{1,3}){5,6}\.jpg/' , $url , $file_names );
		$savePath = $dir_name.$file_names[0];
		// echo $file_name;  die;
		return $savePath;
	}

	public function buildSavePath_mp3( $url ){
		$dir_names = array();
		preg_match('/\/\d{4}-\d{1,2}-\d{1,2}\//', $url , $dir_names);
		$dir_name = $this->basePath.$dir_names[0];
		if( !is_dir($dir_name) ){
			mkdir($dir_name);
		}
		// echo $dir_name;die;
		$file_names = array();
		preg_match( '/\d{4}(?:[-|_]\d{1,3}){5,6}_wet\.mp3/' , $url , $file_names );
		$savePath = $dir_name.$file_names[0];
		// echo $file_name;  die;
		return $savePath;
	}

	public function read( $url ){
		$handle = fopen($url, 'rb');
		$data = '';
		while( !feof($handle) ){
			$data .= fread($handle, 1024);
		}
		fclose($handle);
		return $data;
	}

	public function write( $data , $savePath ){
		// $this->logger( 'open: ',$savePath );
		if( file_exists( $savePath ) ){
			return;
		}
		$handle = fopen($savePath, 'wb');
		$rest = fwrite($handle, $data);
		if( !$rest ){
			$this->failed[] = $savePath;
			$count = count( $this->failed );
			if( $count >0 && $count%10==0  ){
				$this->logger( "failed array:  ",json_encode( $this->failed ) );
			}
			$this->logger( "downlaod failed({$count}): " , "$savePath " );
		}
		fclose($handle);
		if( $this->type == 'img' ){
			$this->img_count++;
			$this->logger( "{$this->type}-{$this->img_count} success: ",$savePath );
		}else{
			$this->mp3_count++;
			$this->logger( "{$this->type}-{$this->mp3_count} success: ",$savePath );
		}
		
	}

	public function logger( $key , $value , $line=false ){
		
		if( $line ){
			@error_log( "\n-----------------------------$value------------------------------\n" ,3 ,$this->logPath);
		}else{
			@error_log( "\n $key".$value  ,3 , $this->logPath);
		}
	}

	public function start_all(){
		$sum = 0;
		for( $i=0;$i<1;$i++ ){
			$this->picArray = array();
			$this->mp3Array = array();
			$start = $sum;
			$end = $start + 1000;
			$sum = $end;
			$this->start_one( $start , $end );
		}
	}

	public function start_one( $start , $end ){
		$now = time();
		$this->logger( "start {$start}-{$end}: ",$now );
		$data = $this->read_file($start , $end);
		$this->write_url($data);
		$this->logger( "ended {$start}-{$end}: ",time()-$now );
	}


}
/**
 *  $readPath , 
 *  $basePath='/home/pzr/tour'  , 
 *  $type = 'img',
 *  $logPath='/tmp/tourism.log' )
 * @var unknown
 */
$readPath =  '/home/pzr/download/2016-05-08/';
$tourism = new tourism( $readPath );
$tourism->start_one(0,1000);