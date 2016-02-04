<?php

session_cache_limiter( 'public' ) ; // 可以设置为 private 或者 public
session_cache_expire( 30 ); //单位分钟
$cache_limiter = session_cache_limiter();
$cache_expire = session_cache_expire();

echo $cache_limiter;
echo "\n $cache_expire";


?>