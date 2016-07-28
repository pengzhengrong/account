
<?php 
$content = "<!--AUDIO#0--><!--AUDIO#1--><!--AUDIO#2--><!--VIDEO#0--><!--VIDEO#1--><!--VIDEO#2--><p style=\"text-align:center;\"><!--IMG#0--></p>\r\n<p>海南网台12月8日消息(记者高文婷)12月8日下午3点,2015海南农民创业创新互联网+大会第二部分&ldquo;互联网农业小镇优电联盟优质特色农产品订单竞拍会&rdquo;开始。</p>\r\n<p>在现场,来自海南各地10余家农产品生产商与近30家电商通过&ldquo;优电平台&rdquo;参与竞拍。黄灯笼、文昌鸡、无核荔枝干等多样农产品被拍出,许多商品在不到三分钟内就所剩无几。其中,50万斤特级无核荔枝干在不到2秒的时间内就被抢购一空,成为目前竞拍现场最快结束竞拍的产品。</p>\r\n<p>据介绍,嘉宾在现场可以通过手机微信扫描二维码,进入&ldquo;优电联盟竞拍系统&rdquo;的界面,便可进行优质农产品竞拍。</p>\r\n<p style=\"text-align:center;\"><!--IMG#1--></p>\r\n<p style=\"text-align:center;\"><!--IMG#2--></p>\r\n<p>据统计,竞拍会上的15种商品成交额达13.94亿元,优电联盟平台上的销售额达16.03亿元,成交额为29.98亿元。在竞拍会的最后,优电联盟有限公司现场采用竞拍方式来进行募股。此次竞拍1000股,最小购买1股,最大购买500股。1股价值100万元,总金额共10亿元。最后,现场通过竞拍,意向认购到价值多达28亿元的股份。</p>";

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
	$content = preg_replace('/<!--AUDIO#\d-->/', '', $content);
// 	$content = preg_replace('/<!--VIDEO#\d-->/', '', $content);
	return $content;
}

$content = replaceImg($content , $pics);
?>
<!doctype html>
<html lang="zh-cn">
<head>

    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
 />
        <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>分享测试</title>
</head>
<body>
hello
</body>
</html>



