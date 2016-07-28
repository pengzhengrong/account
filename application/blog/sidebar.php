<aside class="sidebar">
	<div id="sidebars">
		<div class="sidebar">
			<ul class="sidebar_list">
				<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>
					<li id="sidebar-search" class="widget">
						<h3><?php _e('搜索', 'mythemeshop'); ?></h3>
						<?php get_search_form(); ?>
					</li>
					<li id="sidebar-archives" class="widget">
						<h3><?php _e('归档', 'mythemeshop') ?></h3>
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div><!--sidebars-->
</aside>