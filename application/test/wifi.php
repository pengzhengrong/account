<?php
$url = 'http://apitest1.xw.feedss.com:9001/rss/wifi/channel?channelId=27';
 $content = file_get_contents($url);
// echo '<pre>';

$content =  json_decode($content,true);
//  print_r($content);
// echo $content['channelName'];
print_r($content['articles']);