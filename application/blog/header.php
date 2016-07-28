<!DOCTYPE html>
<!--cos-html-cache-safe-tag-->
<?php $options = get_option('truepixel'); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?>-分享是一种态度</title>
	<?php mts_meta(); ?>
<meta name="Keywords" content="分享，必分享，必分享网，爱分享" >
<meta name="Description" content="分享是一种态度，也是一种高度；分享是一种享受，也是被享受；必看，必分享。" >

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunmargin:0;k/html5.js"></script>
	<![endif]-->
	<?php mts_head(); ?>
	<?php wp_head(); ?>

</head>
<?php flush(); ?>
<body <?php body_class('main'); ?>>
	<div id="header_area">
		<nav class="main-navigation">
			<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>
			<?php } else { ?>
				<ul class="menu">
					<li class="home-tab"><a href="<?php echo home_url(); ?>">首页</a></li>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			<?php } ?><!--#nav-primary-->
		</nav>
		<div class="page">
			<header id="header">
				<?php if ($options['mts_logo'] != '') { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="logo">
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo">
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } else { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="logo">
								<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo">
								<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } ?><!-- END #logo -->
				<?php if ( ! dynamic_sidebar( 'Header' ) ) : ?><?php endif ?>
			</header><!--#header-->
		</div><!--.page-->
		<nav class="secondary-navigation">
			<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
				<?php $str = wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu', 'container' => '' ,'echo'=>false) ); ?>
                <?php echo $str = str_replace('</ul>','',$str);?>
                <form style="float:right;margin:0;" method="get" id="searchform" class="search-form" action="<?php echo home_url(); ?>" _lpchecked="1">
                    <fieldset>
                        <input type="text" name="s" id="s" value="搜索一下" onfocus="if(this.value=='搜索一下')this.value='';" x-webkit-speech onwebkitspeechchange="transcribe(this.value)">
                        <input id="search-image" class="sbutton" type="image" src="<?php echo get_template_directory_uri(); ?>/images/search.png" style="border:0; vertical-align: top;">
                    </fieldset>
                </form>
                <?php echo "</ul>"; ?>
			<?php } else { ?>
				<ul class="menu">
					<li class="home-tab"><a href="<?php echo home_url(); ?>">首页</a></li>
					<?php wp_list_categories('title_li='); ?>
                    <li style="float:right;margin:0;">
                    <form style="float:right;margin:0;" method="get" id="searchform" class="search-form" action="<?php echo home_url(); ?>" _lpchecked="1">
                        <fieldset>
                            <input type="text" name="s" id="s" value="搜索一下" onfocus="if(this.value=='搜索一下')this.value='';" x-webkit-speech onwebkitspeechchange="transcribe(this.value)">
                            <input id="search-image" class="sbutton" type="image" src="<?php echo get_template_directory_uri(); ?>/images/search.png" style="border:0; vertical-align: top;">
                        </fieldset>
                    </form>
                    <li>
				</ul>
			<?php } ?><!--#nav-primary-->


		</nav>

	</div><!--#header_area-->
	<div id="content_area">
		<div class="page">
            <div id="page_ad">
                <div id="page_ad_line">
                <?php if ($options['mts_nav_adcode'] != '') { ?>
                            <?php echo $options['mts_nav_adcode'];?>
                <?php }else{ ?>
                    <img src="<?php bloginfo('template_url');?>/images/ad/960_90_ad.jpg" />
                <?php }?>
                </div>
             </div>
			<div id="content_box">

