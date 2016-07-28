<?php 

Class Pipe {

	public $fifoPath;
	public $w_pipe;
	public $r_pipe;
	function __construct( $fifoPath, $mode = 0666 ){
		//posix_getpid 返回进程ID号
		// $fifoPath = "/home//$name.".posix_getpid();
		if( !file_exists( $fifoPath ) ){
			if( !posix_mkfifo($fifoPath, $mode) ){
				error( 'create new pipe ($name) error.' );
				return false;
			}
		}else{
			error( "pipe ($name) has exist." );
			return false;
		}
		$this->fifoPath = $fifoPath;
	}


	function open_write( $writePath ) {
		$this->w_pipe = fopen( $writePath, 'wb');
		if( $this->w_pipe == null ){
			error( "open pipe {$this->fifoPath} for write error." );
			return false;
		}
		return true;
	}

	function write( $data ){
		return fwrite($this->w_pipe, $data);
	}

	function write_all( $data ) {
		$w_pipe = fopen($this->fifoPath, 'wb');
		fwrite($w_pipe, $data);
		fclose($w_pipe);
	}

	function close_write(){
		return fclose($this->w_pipe);
	}

	function open_read(){
		$this->r_pipe = fopen($this->fifoPath, 'r');
		if( $this->r_pipe == null ){
			error( "open pipe {$this->r_pipe} for read error." );
			return false;
		}
		return true;
	}

	function read( $byte=1024 ){
		return fread($this->r_pipe, $byte);
	}

	function read_all(){
		$r_pipe = fopen( $this->fifoPath , 'r' );
		$data = '';
		while( !feof($r_pipe) ){
			//echo "read one K\n";
			$data .= fread($r_pipe, 1024);
		}
		fclose($r_pipe);
		return $data;
	}

	function close_data(){
		return fclose($this->r_pipe);
	}


	function rm_pipe(){
		return unlink($this->fifoPath);
	}

}




?>