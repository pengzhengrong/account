<?php
/**
 * Template Name: Page Without Sidebar
 */
?>
<?php get_header(); ?>
<div id="content" class="hfeed">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="page-single post_box">
			<article>
				<div class="headline_area">
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</div><!--.headline_area-->
				<div class="format_text entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				</div><!--.post-content .page-content -->
			</article>
		</div><!--#post-# .post-->
		<?php comments_template( '', true ); ?>
	<?php endwhile; ?>
	<div class="top"><a href="#top"><?php _e('Back to Top ','mythemeshop'); ?>&uarr;</a></div>
</div><!--#content-->
<?php get_footer(); ?>