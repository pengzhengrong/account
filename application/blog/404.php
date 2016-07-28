<?php get_header(); ?>
<div id="content" class="hfeed">
	<div id="error404" class="post-single post_box">
	<div class="post headline_area">
		<h1><?php _e('Error 404 Not Found', 'mythemeshop'); ?></h1>
	</div>
		<div class="post-content">
			<p><?php _e('Oops! We couldn\'t Found this Page.', 'mythemeshop'); ?></p>
			<p><?php _e('Please check your URL or use the search form below.', 'mythemeshop'); ?></p>
			<?php get_search_form();?>
		</div><!--.post-content--><!--#error404 .post-->
	</div>
	<div class="top"><a href="#top">Back to Top &uarr;</a></div>
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>