<?php get_header(); ?>
<?php $options = get_option('truepixel'); ?>
<div id="content" class="single">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article class="article">
		<div id="post-<?php the_ID(); ?>" <?php post_class('post_box'); ?>>
			<?php if ($options['mts_breadcrumb'] == '1') { ?>
				<div class="breadcrumb"><?php the_breadcrumb(); ?></div>
			<?php } ?>
			<header>
				<div class="headline_area">
					<h2 class="entry-title"><?php the_title(); ?></h2>

					<?php if($options['mts_headline_meta'] == '1') { ?>
					<div class="headline_meta">
						<p class="theauthor"><?php _e('作者 ', 'mythemeshop'); the_author_posts_link(); ?></p>
						<p class="themeta">
							<span class="thetime"><?php the_time('Y-m-d'); ?></span>
							<span class="thecategories"><?php the_category(', ') ?></span>
							<span class="thecomments"><a href="<?php comments_link(); ?>"><?php comments_number('无评论','1条评论','%条评论'); ?>  </a></span>
脚印:<?php if(function_exists('the_views')) { the_views(); } ?>
<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a></div>						</p>
					</div>
					<?php } ?>
				</div><!--.headline_area-->
			</header>

			<?php if ($options['mts_posttop_adcode'] != '') { ?>
				<?php $toptime = $options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
					<div class="topad">
						<?php echo $options['mts_posttop_adcode']; ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="format_text entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages('before=<div class="pagination2">&after=</div>'); ?>
			</div><!--.format_text entry-content-->
            <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more">喜欢就和朋友一起分享吧：</a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone">QQ空间</a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina">新浪微博</a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq">腾讯微博</a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren">人人网</a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin">微信</a></div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
            <?php if ($options['mts_postend_adcode'] != '') { ?>
				<?php $endtime = $options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
					<div class="bottomad">
						<?php echo $options['mts_postend_adcode'];?>
					</div>
				<?php } ?>
			<?php } ?> 
			<?php if($options['mts_related_posts'] == '1') { ?>	
				<div class="related-posts">
					<?php $categories = get_the_category($post->ID); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					$args=array(
						'category__in' => $category_ids,
						'post__not_in' => array($post->ID),
						'showposts'=>3,
						'orderby' => rand,
						'caller_get_posts'=>1
					);
					$my_query = new wp_query( $args ); if( $my_query->have_posts() ) { echo '<h3>'.__('相关文章','mythemeshop').'</h3><ul>'; while( $my_query->have_posts() ) { ++$counter;
					if($counter == 3) {
						$postclass = 'last';
						$counter = 0;
					} else { $postclass = ''; }
					$my_query->the_post();?>
					<li class="<?php echo $postclass; ?>">
						<a rel="nofollow" class="relatedthumb" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
							<span class="rthumb">
								<?php if(has_post_thumbnail()): ?>
									<?php the_post_thumbnail('related', 'title='); ?>
								<?php else: ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/relthumb.png" alt="<?php the_title(); ?>"  width='180' height='120' class="wp-post-image" />
								<?php endif; ?>
							</span>
							<?php if (strlen($post->post_title) > 52) { echo substr(the_title($before = '', $after = '', FALSE), 0, 52) . '...'; } else { the_title(); } ?>
						</a>
					</li>
					<?php } echo '</ul>'; } } wp_reset_query(); ?>
				</div><!-- .related-posts -->
			<?php } ?>
			<?php if($options['mts_tags'] == '1') { ?>
				<div class="tags"><?php the_tags('<span class="tagtext">Tags:</span>',', ') ?></div>
			<?php } ?>
		</div><!-- #post-## -->
	</article>
	<?php comments_template( '', true ); ?>
	<?php endwhile; /* end loop */ ?>
    <div class="pnavigation2">
        <div class="nav-previous"><?php next_post_link('%link', '上一篇', TRUE); ?> </div>
        <div class="nav-next"><?php previous_post_link('%link', '下一篇', TRUE); ?> </div>
    </div>
	<div class="top"><a href="#top"><?php _e('快速向上 ','mythemeshop'); ?>&uarr;</a></div>
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>