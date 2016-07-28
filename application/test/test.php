<?php 

$content = '<img src="http://127.0.0.1/test.jpg" class="" style="" />test<img src="http://127.0.0.1/test.jpg" class="" style="" />';
$pattern = '/<img .*?src="(.*?)".*?/';
preg_match_all( $pattern, $content, $arr );
print_r($arr);
die;

$backdata['friendTime'] = '2016年12月11日 11:11:11';
/* $arr = preg_match('/(\d{4})年(\d{2})月(\d{2})日(.*)/',$backdata['friendTime']);
echo $arr; */

$backdata['friendTime'] = preg_replace('/(\d{4})年(\d{2})月(\d{2})日(.*)/', "$1año$2mes$3día$4", $backdata['friendTime']);
echo $backdata['friendTime'];
die;


echo 1111;
header('Location:http://www.baidu.com');
exit();

$content = "<p style=\"text-align:center;\"><!--IMG#0--></p>\r\n<p>海南网台12月8日消息(记者高文婷)12月8日下午3点,2015海南农民创业创新互联网+大会第二部分&ldquo;互联网农业小镇优电联盟优质特色农产品订单竞拍会&rdquo;开始。</p>\r\n<p>在现场,来自海南各地10余家农产品生产商与近30家电商通过&ldquo;优电平台&rdquo;参与竞拍。黄灯笼、文昌鸡、无核荔枝干等多样农产品被拍出,许多商品在不到三分钟内就所剩无几。其中,50万斤特级无核荔枝干在不到2秒的时间内就被抢购一空,成为目前竞拍现场最快结束竞拍的产品。</p>\r\n<p>据介绍,嘉宾在现场可以通过手机微信扫描二维码,进入&ldquo;优电联盟竞拍系统&rdquo;的界面,便可进行优质农产品竞拍。</p>\r\n<p style=\"text-align:center;\"><!--IMG#1--></p>\r\n<p style=\"text-align:center;\"><!--IMG#2--></p>\r\n<p>据统计,竞拍会上的15种商品成交额达13.94亿元,优电联盟平台上的销售额达16.03亿元,成交额为29.98亿元。在竞拍会的最后,优电联盟有限公司现场采用竞拍方式来进行募股。此次竞拍1000股,最小购买1股,最大购买500股。1股价值100万元,总金额共10亿元。最后,现场通过竞拍,意向认购到价值多达28亿元的股份。</p>";

$pics = array(
		array(
				'url' => 'upload/123.jpg'
		),
		array(
				'url' => 'upload/123.jpg'
		),
		array(
				'url' => 'upload/123.jpg'
		)
		
);

function replaceImg($content , $pics) {
		if( empty($pics) ) {
			return $content;
		}
		foreach ($pics as $v) {
			$content = preg_replace('/<!--IMG#\d-->/i', $v['url'] , $content);
		}
		return $content;
	}

$content = replaceImg($content , $pics);
header("Content-type:html/text;charset:utf8");
echo $content; 
die;

/**
 * @brief strlen_mb 计算字符串长度，支持中文，自动检测编码，UTF-8与GBK测试通过
*
* @param $str
*
* @return
*/
function strlen_mb($str){
	$mb_len = mb_detect_encoding($str) == 'UTF-8' ? 2 : 1;
	$patt = '/([\x00-\x7f]|[\x80-\xff].{' . $mb_len . '})/';
	$match = preg_match_all($patt, $str, $groups);
	if($groups){
		return count($groups[0]);
	}else{
		return false;
	}
}

/**
 * @brief substr_mb 截取字符串，中文防乱码，自动检测编码，UTF-8与GBK测试通过
 *
 * @param $str
 * @param $start
 * @param $len
 *
 * @return
 */
function substr_mb($str, $start, $len){
	$mb_len = mb_detect_encoding($str) == 'UTF-8' ? 2 : 1;
	$patt = '/([\x00-\x7f]|[\x80-\xff].{' . $mb_len . '}){' . $len . '}/';
	preg_match($patt, $str, $groups);
	if($groups){
		return $groups[0];
	}else{
		return false;
	}
}

echo '<meta charset=utf-8>';
$str = '北京dd欢迎你';
for($i = 0; $i <= strlen_mb($str); $i++){
	var_dump(substr_mb($str, 0, $i));
}

function cutHighlightContent( $content ,$len = 20){
	$content = '我的<em>php</em>你的阿萨德飞萨芬士大夫士大夫<em>php</em>它的';
	$content = preg_replace('/.*?(<em>.*?<\/em>).*/', '$1...' ,$content);
	return $content;
}
// $content = '<em>php</em>';
// echo cutHighlightContent($content);
// phpinfo();
/* $today =  date('Y-m-d');

$now = time($today);
// echo $today.'-'.$now;
// echo "\n ".time('2016-05-18 0:0:0');


echo strtotime($today); */

// echo urlencode("update user set nickname='xuanwen'");

/* function getAge( $age , $count ){
	if( $count==0 ){
		return $age;
	}
// 	echo $age;
	$age += 2;
	return getAge( $age , --$count );
}
$age = getAge(10,8);
echo $age; */

//二进制
// $s = 070;
// echo $s;

/* function convert( $num , $sum=0 ){
	$len = strlen($num);
	$sum += intval($num/pow(10,$len-1) )*pow(8,$len-1);
	if( $len==1 ){ return $sum;}
	$num = $num%pow(10,$len-1);
	return convert($num , $sum);
}
echo convert(361); */

/* function convert( $num ,$sum='' ){
	$len = strlen($num);
	$sum .= intval($num/pow(8,$len-1));
	if( $len == 1 ){ return $sum;}
	$num = $num%pow(8,$len-1); 
	return convert( $num , $sum );
}
echo convert(361); */

//十进制转八进制
/* function convert( $num ,$sum=0 ){
	$len = strlen($num);
	$sum += intval($num/pow(8,$len-1))*pow(10,$len-1);
	if( $len == 1 ){ return $sum;}
	$num = $num%pow(8,$len-1);
	return convert( $num , $sum );
}
echo convert(361);  */

/* function convert( $num  , $source , $aim ,$sum=0 ){
	$len = strlen($num);
	$sum += intval($num/pow($aim,$len-1))*pow($source,$len-1);
	if( $len == 1 ){ return $sum;}
	$num = $num%pow($aim,$len-1);
	return convert( $num , $source , $aim ,$sum );
}
echo convert(361,8,10); */

/* function convert( $num  , $aim ,$sum='' ){
	$sum .= $num%$aim;
	$num = intval($num/$aim);
	if( $num == 0 ){ return $sum; }
	return convert( $num , $aim , $sum );
}
echo strrev(convert(371,8)); */

/* function convert( $num  , $aim ,$sum='' ){
	
	$temp = log($aim , 2);
	$sum .= $num%$aim;
	$num = $num>>$temp;
	if( $num == 0 ){ return $sum; }
	return convert( $num , $aim , $sum );
}
echo convert(10,2);
 */

$arr1 = array(
		1,2
);
$arr2 = array();

print_r(array_diff($arr1 , $arr2) );

// echo 10<<1;
// echo 10>>1;

?>