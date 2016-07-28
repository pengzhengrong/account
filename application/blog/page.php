<?php get_header(); ?>
<div id="content" class="hfeed">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="page-single post_box">
			<article>
				<div class="headline_area">
									</div><!--.headline_area-->
				<div class="format_text entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				</div><!--.post-content .page-content -->
			</article>
		</div><!--#post-# .post-->
			<?php endwhile; ?>
	</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>