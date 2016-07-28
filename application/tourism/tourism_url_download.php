<?php


class tourism {

	public $mp3Path;

	public $imgPath;

	public $picArray = array();

	public $mp3Array = array();


	public function __construct( $mp3Path , $imgPath ){
		$this->mp3Path = $mp3Path;
		$this->imgPath = $imgPath;
	}

	public function read_file_json(  $path='' ){
		$json_temp = file_get_contents( $path );
		$temp_str = trim( $json_temp , ',' );
		$temp_str = '['.$temp_str.']';
		return json_decode( $temp_str , true );
	}

	public function read_json( $data ){
		if( !is_array($data) ){ 
			logger( ' source data is not a array.' );
			return;
		}
		foreach ($data as $value) {
			if( $value['audio'] ){
				$audio = $value['audio'];
				if( $audio['title_photo'] ){
					$this->picArray[] =  $audio['title_photo'];
				}
				if( $audio['content_photo'] ){
					$this->picArray[] = $audio['content_photo'];
				}
				if( $audio['wetsound_path'] ){
					$this->mp3Array[] = $audio['wetsound_path'];
				}
				if(  isset( $audio['addPicList'] )){
					$addPicList = $audio['addPicList'] ;
					if( !is_array($addPicList) ) return;
					foreach ($addPicList as $value) {
						$this->picArray[] = $value['content_pic'];
					}
				}
			}
		}
	}

	public function start(){
		$sum = 5000;
		for( $i=0;$i<10;$i++ ){
			$this->picArray = array();
			$this->mp3Array = array();
			$start = $sum;
			$end = $start + 1000;
			$sum = $end;
			$file_name = "/home/pzr/download/2016-05-04-audio/$start-$end";
			$this->logger( "start ",$file_name );
			$data = $this->read_file_json( $file_name );
			$this->read_json( $data );
			$this->write_url_json( $start , $end );
			$this->logger( 'ended ',$file_name );
		}
	}


	public function logger( $key , $value , $line=false ){
		@error_log( "\n $key : ".$value  ,3 ,'/tmp/tourism.log');
		if( $line ){
			@error_log( "\n------------------------------------------------------\n" ,3 ,'/tmp/tourism.log');
		}
	}

	public function write_url_json( $start , $end ){
		$imgPath = $this->imgPath."img$start-$end.json";
		$mp3Path = $this->mp3Path."mp3$start-$end.json";
		$this->logger( "$start-$end :",count($this->picArray) );
		$this->logger( "$start-$end :",count($this->mp3Array) );
		file_put_contents( $imgPath , json_encode($this->picArray));
		file_put_contents($mp3Path, json_encode($this->mp3Array));
	}
}

$mp3Path = '/home/pzr/download/2016-05-08/';
$imgPath =  '/home/pzr/download/2016-05-08/';
$tourism = new tourism( $mp3Path , $imgPath );
$tourism->start();