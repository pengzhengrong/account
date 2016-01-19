<?php

//加载所有配置文件

include dirname(__FILE__).'/global.php';

if( !isset($_SERVER[__SYS_GLOBAL_SERVER__])  ){
	$_SERVER[__SYS_GLOBAL_SERVER__] = array(
			'comp' => array(
					'mysql' => @include __PATH_PARAM__.'/mysql.php'
			)
	);
}


?>