<?php
$url = "http://apitest1.xw.feedss.com:9001/t/EI0dZl25?newsid=100";
// ^/t/([a-zA-Z0-9]+)?(.*)?$ /index.php?r=dwz/jump&shorturl=$1&newsid=$2
// $url = preg_replace( '^/t/([a-zA-Z0-9]+)?newsid=(/d)+', '/index.php?r=dwz/jump&shorturl=$1&newsid=$2' , $url );
$pattern = '/\/t\/([a-zA-Z0-9]+)\?newsid=(\d+)/';
$url = preg_replace( $pattern , '/index.php?r=dwz/jump&shorturl=$1&newsid=$2' , $url );
echo $url;

//http://apitest1.xw.feedss.com:9001/t/CWAHS641?newsid=31248

// $pattern = '/\?/';
// echo preg_match( $pattern , $url  );
