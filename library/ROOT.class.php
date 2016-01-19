<?php

class ROOT{
	
	public static function START(){
		$rout = 'index';
		if(isset($_GET[__SYS_ROUT__]) && !empty($_GET[__SYS_ROUT__]))
		{
			$tmp = preg_match('/^[a-z]+(\/[a-z]+)*$/',$_GET[__SYS_ROUT__]);
			if(!$tmp)
			{
				self::page404();
			}
			$rout = $_GET[__SYS_ROUT__];
		}
		include __PATH_APP__.$rout.'.php';
	}
	
	
	public static function page404() {
		@header("http/1.1 404 not found"); 
		@header("status: 404 not found");
	}
	
	public static function load_tpl( $filename ){
		include __PATH_APP__.__ROUT_M__.'/template/'.$filename.'.tpl.php';
	}
	
}

?>