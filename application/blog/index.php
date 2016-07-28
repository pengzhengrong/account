<?php $options = get_option('truepixel'); ?>
<?php get_header(); ?>
	<div id="content" class="hfeed homepage">
		<?php if (is_home() && !is_paged()) { ?>
			<?php if($options['mts_featured_slider'] == '1') { ?>
				<div class="flex-container">
					<div class="flexslider">
						<ul class="slides">
							<?php $my_query = new WP_Query('cat='.$options['mts_featured_slider_cat'].'&posts_per_page=3'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>">
									<?php the_post_thumbnail('featured',array('title' => '')); ?>
									<p class="flex-caption"><?php the_title(); ?></p>
								</a>
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="article">
				<div class="post-single post_box">
					<header>
						<div class="headline_area">
							<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php if($options['mts_headline_meta'] == '1') { ?>
							<div class="headline_meta">
								<p class="theauthor"><?php _e('作者 ', 'mythemeshop'); the_author_posts_link(); ?></p>
								<p class="themeta"><span class="thetime"><?php the_time('Y-m-d'); ?></span><span class="thecategories"><?php the_category(', ') ?></span><span class="thecomments"><a href="<?php comments_link(); ?>"><?php comments_number('无评论','1条评论','%条评论'); ?></a></span>
脚印:<?php if(function_exists('the_views')) { the_views(); } ?>
</p>
							</div>
							<?php } ?>
						</div><!--.headline_area-->
					</header>
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow"><?php if ( has_post_thumbnail() ) {    $large_image_url_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured');
                            $large_image_url = $large_image_url_array[0];
                            echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; }else{$large_image_url='';} ?></a>
					<div class="format_text entry-content">
						<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"..."); ?>

					</div>

                    <div class="bdsharebuttonbox" style="width: 300px; float:left; margin-bottom:20px;padding-top:10px;" onmouseover="setShare('<?php the_title();?> - <?php echo strip_tags(get_the_excerpt()); ?>', '<?php the_permalink();?>', '<?php echo $large_image_url;?>');">
                        <div class="jiathis_style">
                            <a href="http://www.jiathis.com/share/?uid=2380" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank">分享</a>
                            <span class="jiathis_separator">|</span>
                            <a class="jiathis_button_tsina"></a>
                            <a class="jiathis_button_qzone"></a>
                            <a class="jiathis_button_kaixin001"></a>
                            <a class="jiathis_button_renren"></a>
                        </div>

                    </div>
                    <div class="more" style="float:right;width:200px; margin-bottom:20px;"><a href="<?php the_permalink() ?>" class="readmore"><?php _e('阅读全文','mythemeshop'); ?></a>                 </div>

				</div><!--.post-single-->
			</article>
		<?php endwhile; else: ?>
			<div class="no-results">
				<p><strong><?php _e('不好意思，出错啦。。。.', 'mythemeshop'); ?></strong></p>
				<p><?php _e('抱歉哦，请换个姿势刷新一遍网页或者换个关键字搜索一下', 'mythemeshop'); ?></p>
				<?php get_search_form(); ?>
			</div><!--noResults-->
		<?php endif; ?>
		<?php if ($options['mts_pagenavigation'] == '1') { ?>
			<?php pagination($additional_loop->max_num_pages);?>
		<?php } else { ?>
			<div class="pnavigation2">
				<div class="nav-previous"><?php next_posts_link( __( '&larr; '.'上一页', 'mythemeshop' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( '下一页'.' &rarr;', 'mythemeshop' ) ); ?></div>
			</div>
		<?php } ?>
		<div class="top"><a href="#top"><?php _e('快速向上 ','mythemeshop'); ?>&uarr;</a></div>
	</div><!--#content-->
    <!--单页面使用多分享按钮需要增加的分享参数代码-->
    <script type="text/javascript">
        function setShare(title, url, pic) {
            jiathis_config.title = title;
            jiathis_config.url = url;
            jiathis_config.pic = pic;
        }
        var jiathis_config = {}
    </script>
    <!--分享参数代码结束-->
    <!--分享功能代码统一放到页尾-->
    <script type="text/javascript" src="http://v1.jiathis.com/code/jia.js?uid=2380" charset="utf-8"></script>
    <!--分享功能代码结束-->
	<?php get_sidebar(); ?>
    <?php get_footer(); ?>