{
	"id":1543,
	"sightId":2561,
	"title":"娜允古镇",
	"title_photo":"http://c.tingtoutiao.com/tour/2015-9-8/2015-09-08-10-57-28_400.jpg",
	"content":"娜允古镇位于普洱市孟连傣族拉祜族佤族自治县城，是中国至今还保存着的最后一个傣族古镇，已被列为傣族历史文化名城。迄今已有700多年的历史，“娜允”即傣语“内城”的意思。 娜允古镇的房屋是傣汉两个民族的不同风格合璧的建筑群，在东南亚傣族人民的心目中，是一个神圣的地方，因为历代傣族土司衙门——孟连宣抚司署就设在这里。娜允由“三城两镇”组成，即上中下城和芒方岗、芒方冒。土司时代，上城是土司及家奴居住的地方，中城是官员和家属的居住地，下城则是下级官员的住处，芒方岗和芒方冒这两个小镇是林业官和猎户居住的寨子，孟连宣抚司署位于上城的最高处，上、中城佛寺也巍然屹立在宣抚司署的附近。占地一万多平方米的宣抚司署是云南清代土司的衙署，也是云南18座土司衙门中保存最完好的一座。与土司衙门的富丽堂皇形成对比的是清静悠闲的佛寺，大殿的墙壁上画着艳丽的壁画，记载的是傣族的历史传说。娜允古镇虽然历史悠久却至今仍保留着傣族古城的特色和风韵，蕴涵着丰富多彩的傣族土司文化，以及宗教建筑，饮食、服饰、节日、音乐、舞蹈、民俗等文化、有着珍贵的历史价值和艺术价值，这里自然环境优美，山川秀丽，人杰地灵。 近几年来，境内外少数民族，特别是缅甸、泰国等邻国的傣族客人到娜允古镇访古溯源的也日益增多。",
	"content_photo":"http://c.tingtoutiao.com/tour/2015-9-8/2015-09-08-10-57-28.jpg"
	,"wetsound_path":"http://c.tingtoutiao.com/tour/2015-9-8/2015-09-08-10-57-31_wet.mp3",
	"wetsound_md5":"0bcd6bdb75880392a0c8f02d88895c94",
	"wetsound_size":3049482,
	"wetsound_time":127,
	"onlinetime":"2015-09-08 10:59:03",
	"h_ordinate":"99.55391897517205",
	"v_ordinate":"22.34784075537363",
	"status":0,
	"original_h_ordinate":"99.56042499972123",
	"original_v_ordinate":"22.35389499408462",
	"item_wetvideo_time":0,
	"item_wetvideo_size":0,
	"video_type":0
}


create table `tourism`(
	`id` int(11) unsigned auto_increment,
	`sightId` int(11) unsigned not null default 0,
	`title` varchar(100) not null default '',
	`title_photo` varchar(100) not null default '',
	`content` text not null ,
	`content_photo` varchar(200) not null default '',
	`wetsound_path` varchar(100) not null default '',
	`wetsound_md5` varchar(64) not null default '',
	`wetsound_size` int(11) not null default 0,
	`wetsound_time` int(11) not null default 0,
	`GG_h_coordinate` varchar(30) not null default '',
	`GG_l_coordinate` varchar(30) not null default '',
	`onlinetime` varchar(30) not null default '',
	`h_ordinate` varchar(50) not null default '',
	`v_ordinate` varchar(50) not null default '',
	`status` tinyint(1) not null default 0,
	`original_h_ordinate` varchar(50) not null default '',
	`original_v_ordinate` varchar(50) not null default '',
	`item_wetvideo_time` int(11) not null default 0,
	`item_wetvideo_size` int(11) not null default 0,
	`video_type` int(11) not null default 0,
	`addPicList` varchar(1000) not null default '',
	`sight_description` varchar(100) not null default '', 
	`image_text` text not null,
	`anchors` varchar(400) not null default '',
	primary key(`id`)
)engine=myisam default charset=utf8 auto_increment=1;

-- alter table `tourism`add `addPicList` varchar(1000) not null default '';
-- alter table `tourism`add `title_photo` varchar(100) not null default '' after `title`;






















