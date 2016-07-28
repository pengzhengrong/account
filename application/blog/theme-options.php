<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'nhp-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'nhp-opts');

//Setup custom links in the footer for share icons
//$args['share_icons']['twitter'] = array(
//										'link' => 'http://twitter.com/mythemeshopteam',
//											'title' => 'Follow Us on Twitter',
//											'img' => NHP_OPTIONS_URL.'img/glyphicons/twitter.png'
//											);
//$args['share_icons']['linked_in'] = array(
//											'link' => 'http://www.facebook.com/mythemeshop',
//											'title' => 'Like us on Facebook',
//											'img' => NHP_OPTIONS_URL.'img/glyphicons/facebook.png'
//											);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'truepixel';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('TruePixel', 'nhp-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('TruePixel', 'nhp-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 62;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Support', 'nhp-opts'),
							'content' => __('<p>If you are facing any problem with our theme or theme option panel, head over to our <a href="http://community.mythemeshop.com">Support Forum</a></p>', 'nhp-opts')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-3',
							'title' => __('Credit', 'nhp-opts'),
							'content' => __('<p>Options Panel created using the <a href="http://leemason.github.com/NHP-Theme-Options-Framework/" target="_blank">NHP Theme Options Framework</a> Version 1.0.5</p>', 'nhp-opts')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Earn Money', 'nhp-opts'),
							'content' => __('<p>Earn 50% commision on every sale by refering your friends and readers. Join our <a href="http://mythemeshop.com/affiliate-program/">Affiliate Program</a>.</p>', 'nhp-opts')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'nhp-opts');



$sections = array();

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/generalsetting.png',
				'title' => __('设置', 'nhp-opts'),
				'desc' => __('<p class="description">本页面包括主题全部设置</p>', 'nhp-opts'),
				'fields' => array(
				
					array(
						'id' => 'mts_logo',
						'type' => 'upload',
						'title' => __('logo设置', 'nhp-opts'),
						'sub_desc' => __('Upload your logo <strong>(165 x 60 px)</strong> 插入图片', 'nhp-opts')
						),
					array(
						'id' => 'mts_favicon',
						'type' => 'upload',
						'title' => __('站标', 'nhp-opts'),
						'sub_desc' => __('Upload a <strong>16 x 16 px</strong> 可以点击下面这个站点 <a href="http://www.favicon.cc/" target="blank" rel="nofollow">http://www.favicon.cc/</a>来制作您的站标', 'nhp-opts')
						),
					array(
						'id' => 'mts_feedburner',
						'type' => 'text',
						'title' => __('FeedBurner 地址', 'nhp-opts'),
						'sub_desc' => __('Enter your FeedBurner\'s URL here, ex: <strong>http://feeds.feedburner.com/mythemeshop</strong> and your main feed (http://example.com/feed) will get redirected to the FeedBurner ID entered here.)', 'nhp-opts'),
						'validate' => 'url'
						),
					array(
						'id' => 'mts_twitter_username',
						'type' => 'text',
						'title' => __('Twitter 账户', 'nhp-opts'),
						'sub_desc' => __('输入你的用户名.', 'nhp-opts')
						),
					array(
						'id' => 'mts_header_code',
						'type' => 'textarea',
						'title' => __('插入顶部代码', 'nhp-opts'),
						'sub_desc' => __('Enter the code which you need to place <strong>before closing </head> tag</strong>. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'nhp-opts')
						),
					array(
						'id' => 'mts_analytics_code',
						'type' => 'textarea',
						'title' => __('插入底部代码', 'nhp-opts'),
						'sub_desc' => __('Enter the codes which you need to place in your footer. <strong>(ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)</strong>.', 'nhp-opts')
						),
					array(
						'id' => 'mts_copyrights',
						'type' => 'textarea',
						'title' => __('版权设置', 'nhp-opts'),
						'sub_desc' => __('You can change or remove our link from footer and use your own custom text. (Link back is always appreciated)', 'nhp-opts'),
						'std' => '<a href="'.get_bloginfo('url').'/" title="'.get_bloginfo('description').'" rel="nofollow">'.get_bloginfo('name').'</a> Copyright &copy; '.date("Y").''
						),
					array(
						'id' => 'mts_featured_slider',
						'type' => 'checkbox_hide_below',
						'title' => __('首页幻灯片', 'nhp-opts'),
						'sub_desc' => __('<strong>Enable or Disable</strong> a homepage slider by using this check box. This slider will show 3 recent articles from the selected category.', 'nhp-opts'),
						),
					array(
						'id' => 'mts_featured_slider_cat',
						'type' => 'cats_select',
						'title' => __('幻灯片所属分类', 'nhp-opts'),
						'sub_desc' => __('Select a category from the drop-down menu, latest three articles from this category will be show <strong>big thumbnail</strong>.', 'nhp-opts'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_pagenavigation',
						'type' => 'checkbox',
						'title' => __('分页', 'nhp-opts'),
						'sub_desc' => __('Enable or disable paginated navigation, which replaces the <strong>"Older Posts"</strong> and <strong>"Newer Posts"</strong> links with helpful numbered page links.', 'nhp-opts'),
						'std' => '1'
						),	
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/stylesetting.png',
				'title' => __('样式设置选项', 'nhp-opts'),
				'desc' => __('<p class="description">Control the visual appearance of your theme, such as colors, layout and patterns, from here.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'mts_color_scheme',
						'type' => 'color',
						'title' => __('颜色设置', 'nhp-opts'),
						'sub_desc' => __('Theme comes with unlimited color schemes for your theme\'s styling.', 'nhp-opts'),
						'std' => '#E03F00'
						),
					array(
						'id' => 'mts_layout',
						'type' => 'radio_img',
						'title' => __('架构设置', 'nhp-opts'),
						'sub_desc' => __('Choose from <strong>2 different layouts</strong> for your site.', 'nhp-opts'),
						'options' => array(
										'sclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/sc.png'),
										'cslayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cs.png')
											),//Must provide key => value(array:title|img) pairs for radio options
						'std' => 'sclayout'
						),
					array(
						'id' => 'mts_bg_color',
						'type' => 'color',
						'title' => __('背景设置', 'nhp-opts'),
						'sub_desc' => __('Pick any color using the <strong>color picker</strong>, or enter a hex color value in the input field to make it the site background color for your theme.', 'nhp-opts'),
						'std' => '#F0F2F3'
						),
					array(
						'id' => 'mts_bg_pattern',
						'type' => 'radio_img',
						'title' => __('背景图片', 'nhp-opts'),
						'sub_desc' => __('Choose from any of <strong>37</strong> awesome background patterns for your site\'s background.', 'nhp-opts'),
						'options' => array(
										'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
										'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
										'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
										'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
										'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
										'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
										'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
										'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
										'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
										'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
										'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
										'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
										'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
										'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
										'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
										'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
										'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
										'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
										'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
										'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
										'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
										'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
										'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
										'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
										'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
										'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
										'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
										'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
										'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
										'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
										'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
										'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
										'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
										'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
										'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
										'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
										'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
										'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
										'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png')
											),//Must provide key => value(array:title|img) pairs for radio options
						'std' => 'pattern3'
						),
					array(
						'id' => 'mts_bg_pattern_upload',
						'type' => 'upload',
						'title' => __('自定义背景图片', 'nhp-opts'),
						'sub_desc' => __('Upload your own custom background image or pattern.', 'nhp-opts')
						),
					array(
						'id' => 'mts_custom_css',
						'type' => 'textarea',
						'title' => __('自定义CSS', 'nhp-opts'),
						'sub_desc' => __('You can enter your own custom CSS here to further customize your theme. This will override the default CSS used on your site.', 'nhp-opts')
						),
					array(
						'id' => 'mts_lightbox',
						'type' => 'button_set',
						'title' => __('Lightbox特效', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'nhp-opts'),
						'std' => '0'
						),																					
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/singlepost.png',
				'title' => __('文章页面', 'nhp-opts'),
				'desc' => __('<p class="description">From here, you can control the appearance and functionality of your single posts page.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'mts_headline_meta',
						'type' => 'button_set',
						'title' => __('文章Meta信息.', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to Show or Hide Post Meta Info <strong>Author name and Categories</strong>.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_breadcrumb',
						'type' => 'button_set',
						'title' => __('面包屑导航', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_author_comment',
						'type' => 'button_set',
						'title' => __('高亮管理员评论', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to highlight author comments.', 'nhp-opts'),
						'std' => '0'
						),
					array(
						'id' => 'mts_related_posts',
						'type' => 'button_set',
						'title' => __('相关文章', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to show related posts with thumbnails below the content area in a post.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_tags',
						'type' => 'button_set',
						'title' => __('文章关键字tags链接', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button if you want to show a tag cloud below the related posts.', 'nhp-opts'),
						'std' => '0'
						),
					array(
						'id' => 'mts_author_box',
						'type' => 'button_set',
						'title' => __('作者BOX', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button if you want to display author information below the article.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_comment_date',
						'type' => 'button_set',
						'title' => __('在评论中的日期', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to show the date for comments.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_image_border',
						'type' => 'button_set',
						'title' => __('图片边框', 'nhp-opts'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to Enable or Disable the <strong>thick border</strong> around the images on single posts.', 'nhp-opts'),
						'std' => '1'
						)
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/fontsetting.png',
				'title' => __('字体', 'nhp-opts'),
				'desc' => __('<p class="description">Typography is an important part of blog design, so from here, you can control the fonts and text on your site.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'mts_google_title_font',
						'type' => 'text',
						'title' => __('谷歌字体', 'nhp-opts'),
						'sub_desc' => __('Enter your favorite Google webfont name here. Browse fonts <a href="http://www.google.com/webfonts/" target="_blank">here</a>. (This will override below font.)', 'nhp-opts'),
						),
					array(
						'id' => 'mts_title_font',
						'type' => 'select',
						'title' => __('文章的标题字体', 'nhp-opts'),
						'sub_desc' => __('Pick from the <strong>top 30 most popular fonts</strong> for your titles.', 'nhp-opts'),
						'options' => array( "Oswald" => "Oswald", "Signika" => "Signika", "Open Sans Condensed" => "Open Sans Condensed", "Droid Serif" => "Droid Serif", "Noticia Text" => "Noticia Text", "Bree Serif" => "Bree Serif", "Yanone Kaffeesatz" => "Yanone Kaffeesatz", "Ubuntu" => "Ubuntu", "Merriweather" => "Merriweather", "Cuprum" => "Cuprum", "Lobster" => "Lobster", "Molengo" => "Molengo", "Raleway" => "Raleway", "EB Garamond" => "EB Garamond", "Gill Sans" => "Gill Sans", "Allerta" => "Allerta", "Arvo" => "Arvo", "Dancing Script" => "Dancing Script", "arial" => "Arial", "Lora" => "Lora", "Rokkitt" => "Rokkitt", "News Cycle" => "News Cycle", "Junge" => "Junge", "Cabin" => "Cabin", "Lekton" => "Lekton", "Goudy Bookletter 1911" => "Goudy Bookletter 1911", "Crimson Text" => "Crimson Text", "PT Sans" => "PT Sans", "Droid Sans" => "Droid Sans", "Quando" => "Quando"),
						'std' => 'Oswald'
						),
					array(
						'id' => 'mts_google_content_font',
						'type' => 'text',
						'title' => __('文章的内容字体', 'nhp-opts'),
						'sub_desc' => __('Enter your favorite Google webfont name here. Browse fonts <a href="http://www.google.com/webfonts/" target="_blank">here</a>. (This will override below font.)', 'nhp-opts')
						),
					array(
						'id' => 'mts_content_font',
						'type' => 'select',
						'title' => __('网站字体', 'nhp-opts'),
						'sub_desc' => __('Pick from the <strong>top 30 most popular fonts</strong> for body/content text.', 'nhp-opts'),
						'options' => array( "Droid Serif" => "Droid Serif", "Droid Sans" => "Droid Sans", "Arial" => "Arial", "Open Sans" => "Open Sans", "Noticia Text" => "Noticia Text", "Signika" => "Signika", "Bree Serif" => "Bree Serif", "Oswald" => "Oswald", "Yanone Kaffeesatz" => "Yanone Kaffeesatz", "Ubuntu" => "Ubuntu", "Merriweather" => "Merriweather", "Cuprum" => "Cuprum", "Lobster" => "Lobster", "Molengo" => "Molengo", "Raleway" => "Raleway", "EB Garamond" => "EB Garamond", "Gill Sans" => "Gill Sans", "Allerta" => "Allerta", "Arvo" => "Arvo", "Dancing Script" => "Dancing Script", "Lora" => "Lora", "Rokkitt" => "Rokkitt", "News Cycle" => "News Cycle", "Junge" => "Junge", "Cabin" => "Cabin", "Lekton" => "Lekton", "Goudy Bookletter 1911" => "Goudy Bookletter 1911", "Crimson Text" => "Crimson Text", "PT Sans" => "PT Sans", "Droid Sans" => "Droid Sans", "Quando" => "Quando"),
						'std' => 'Droid Serif'
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/socialsetting.png',
				'title' => __('社交按钮设置', 'nhp-opts'),
				'desc' => __('<p class="description">Enable or disable social sharing buttons on single posts using these buttons.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'mts_social_buttons',
						'type' => 'button_set',
						'title' => __('Social Media Buttons', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Check this box to show social sharing buttons before an article\'s content text.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_floating_social',
						'type' => 'button_set',
						'title' => __('Floating Social Buttons', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Enable or Disable the Floating social sharing buttons on single posts.', 'nhp-opts'),
						'std' => '1'
						),
					array(
						'id' => 'mts_twitter',
						'type' => 'button_set',
						'title' => __('Twitter', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					array(
						'id' => 'mts_gplus',
						'type' => 'button_set',
						'title' => __('Google Plus', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					array(
						'id' => 'mts_facebook',
						'type' => 'button_set',
						'title' => __('Facebook Like', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					array(
						'id' => 'mts_linkedin',
						'type' => 'button_set',
						'title' => __('LinkedIn', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '0'
						),
					array(
						'id' => 'mts_stumble',
						'type' => 'button_set',
						'title' => __('StumbleUpon', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '0'
						),
					array(
						'id' => 'mts_pinterest',
						'type' => 'button_set',
						'title' => __('Pinterest', 'nhp-opts'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/adsetting.png',
				'title' => __('广告设置', 'nhp-opts'),
				'desc' => __('<p class="description">Now, ad management is easy with our options panel. You can control everything from here, without using separate plugins.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'mts_posttop_adcode',
						'type' => 'textarea',
						'title' => __('在文章标题下面的广告位', 'nhp-opts'),
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below your article title on single posts.', 'nhp-opts')
						),
					array(
						'id' => 'mts_posttop_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'nhp-opts'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad before it expires. Enter 0 to disable this feature.', 'nhp-opts'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text'
						),
					array(
						'id' => 'mts_postend_adcode',
						'type' => 'textarea',
						'title' => __('在文章内容下面的广告位', 'nhp-opts'),
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below the post content on single posts.', 'nhp-opts')
						),
					array(
						'id' => 'mts_postend_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'nhp-opts'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad before it expires. Enter 0 to disable this feature.', 'nhp-opts'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text'
						),
                    array(
                        'id' => 'mts_nav_adcode',
                        'type' => 'textarea',
                        'title' => __('导航栏下方的960*90广告位', 'nhp-opts'),
                        'sub_desc' => __('为了美观，最好是960*90大小的广告位.', 'nhp-opts')
                    ),
                    array(
                        'id' => 'mts_left_adcode',
                        'type' => 'textarea',
                        'title' => __('左对联的360*120广告位', 'nhp-opts'),
                        'sub_desc' => __('为了美观，最好是360*120大小的广告位.竖条状，对联广告', 'nhp-opts')
                    ),
                    array(
                        'id' => 'mts_right_adcode',
                        'type' => 'textarea',
                        'title' => __('右对联的360*120广告位', 'nhp-opts'),
                        'sub_desc' => __('为了美观，最好是360*120大小的广告位.竖条状，对联广告', 'nhp-opts')
                    )
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/navsetting.png',
				'title' => __('分页设置', 'nhp-opts'),
				'desc' => __('<p class="description"><div class="controls"><b>Navigation settings can now be modified from the <a href="nav-menus.php">Menus Section</a>.</b><br></div></p>', 'nhp-opts')
				);
				
				
	$tabs = array();
	
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('主题文档', 'nhp-opts'),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>