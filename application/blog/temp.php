<?php if($options['mts_author_box'] == '1') { ?>
    <div class="postauthor" style="display: none;">
        <?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' );  } ?>
        <h4><?php _e('Written by ','mythemeshop'); ?><a href="<?php the_author_meta( 'user_url' ); ?>" rel="me"><?php the_author_meta( 'nickname' ); ?></a></h4>
        <p><?php the_author_meta('description') ?>
        <div id="author-link">
            <p><?php _e('View all posts by: ', 'mythemeshop'); the_author_posts_link() ?></p>
        </div><!--#author-link-->
        </p><!--#author-description -->
    </div><!--.postauthor-->
<?php } ?>

<?php if($options['mts_social_buttons'] == '1') { ?>
    <div class="shareit">

    </div>
<?php } ?><!--Shareit-->

<?php if($options['mts_twitter'] == '1') { ?>
    <!-- Twitter -->
    <span class="share-item twitterbtn">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $options['mts_twitter_username']; ?>">Tweet</a>
							</span>
<?php } ?>
<?php if($options['mts_gplus'] == '1') { ?>
    <!-- GPlus -->
    <span class="share-item gplusbtn">
							<g:plusone size="medium"></g:plusone>
							</span>
<?php } ?>
<?php if($options['mts_facebook'] == '1') { ?>
    <!-- Facebook -->
    <span class="share-item facebookbtn">
							<div id="fb-root"></div>
							<div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
							</span>
<?php } ?>
<?php if($options['mts_linkedin'] == '1') { ?>
    <!--Linkedin -->
    <span class="share-item linkedinbtn">
							<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>
							</span>
<?php } ?>
<?php if($options['mts_stumble'] == '1') { ?>
    <!-- Stumble -->
    <span class="share-item stumblebtn">
							<su:badge layout="1"></su:badge>
							<script type="text/javascript">
                                (function() {
                                    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
                                    li.src = window.location.protocol + '//platform.stumbleupon.com/1/widgets.js';
                                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
                                })();
                            </script>
							</span>
<?php } ?>
<?php if($options['mts_pinterest'] == '1') { ?>
    <!-- Pinterest -->
    <span class="share-item pinbtn">
							<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
							<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
							</span>
<?php } ?>

<!--start Social Buttons-->
<div class="searchComIcons">
    <?php if($options['mts_facebook_username'] != '') { ?>
        <a href="<?php echo $options['mts_facebook_username']; ?>" rel="me" target="_blank"><div class="iFb"></div></a>
    <?php } ?>
    <?php if($options['mts_twitter_username'] != '') { ?>
        <a href="http://twitter.com/<?php echo $options['mts_twitter_username']; ?>" rel="me" target="_blank"><div class="iTw"></div></a>
    <?php } ?>
    <?php if($options['mts_google_plus'] != '') { ?>
        <a href="<?php echo $options['mts_google_plus']?>"><div class="iGl"></div></a>
    <?php } ?>
    <?php if($options['mts_linked'] != '') { ?>
        <a href="<?php echo $options['mts_linked']?>"><div class="iIn"></div></a>
    <?php } ?>
    <?php if($options['mts_pinterest_username'] != '') { ?>
        <a href="<?php echo $options['mts_pinterest_username']?>"><div class="iPinterest"></div></a>
    <?php } ?>
    <?php if($options['mts_feedburner'] != '') { ?>
        <a href="<?php echo $options['mts_feedburner']?>"><div class="iRss"></div></a>
    <?php } ?>
</div>
<!--end Social Buttons-->





<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"ttt","bdMini":"2","bdMiniList":false,"bdPic":"tttttttttttttttttttttt","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>




<script>
    window._bd_share_config_<?php the_ID();?>={
        "common":{
            "bdSnsKey":{},
            "bdText":"<?php the_title();?>",
            "bdMini":"2","bdPic":"",
            "bdStyle":"0","bdSize":"16"},
        "share":{"tag" : "share_<?php the_ID();?>"},
        "selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}
    };
</script>

<a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone"></a><a href="#" class="bds_tsina" data-cmd="tsina"></a><a href="#" class="bds_tqq" data-cmd="tqq"></a><a href="#" class="bds_renren" data-cmd="renren"></a><a href="#" class="bds_weixin" data-cmd="weixin"></a>











