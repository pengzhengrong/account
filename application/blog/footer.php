<?php $options = get_option('truepixel'); ?>
		</div><!--.page-->
	</div><!--#content_box-->
</div><!--.container-->

	<div class="copyrights">
		<div class="page">
            <nav class="footer-navigation">
                <?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu', 'container' => '' ) ); ?>
                <?php } else { ?>
                <ul class="footer-menu">
                    <li class="footer-home-tab"><a href="<?php echo home_url(); ?>">首页</a></li>
                    <?php wp_list_categories('title_li='); ?>
                </ul>
                <?php } ?><!--#nav-primary-->
            </nav>
			<?php mts_copyrights_credit(); ?>
		</div>
	</div>
<?php mts_footer(); ?>
<?php wp_footer(); ?>

<div id="page_left_ad" style="padding: 0px; display: block; visibility: visible; border: medium none; background: none repeat scroll 0% 0% transparent; float: none; overflow: hidden; position: fixed; width: 126px; height: 360px; line-height: 360px; z-index: 2147483646; left: 83px; top: 78px;">
    <div id="page_left_line">
        <?php if ($options['mts_left_adcode'] != '') { ?>
            <?php echo $options['mts_left_adcode'];?>
        <?php }else{ ?>
            <img src="<?php bloginfo('template_url');?>/images/ad/300_120_ad.jpg" />
        <?php }?>
    </div>
</div>
<div id="page_right_ad" style="padding: 0px; display: block; visibility: visible; border: medium none; background: none repeat scroll 0% 0% transparent; float: none; overflow: hidden; position: fixed; width: 126px; height: 360px; line-height: 360px; z-index: 2147483646; right: 83px; top: 78px;">
    <div id="page_right_line">
        <?php if ($options['mts_right_adcode'] != '') { ?>
            <?php echo $options['mts_right_adcode'];?>
        <?php }else{ ?>
            <img src="<?php bloginfo('template_url');?>/images/ad/300_120_ad.jpg" />
        <?php }?>
    </div>
</div>
</body>
</html>