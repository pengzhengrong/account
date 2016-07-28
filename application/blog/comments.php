<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
return;
}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<div id="comments">
<div class="total-comments"><?php comments_number('无评论', '最新评论', '最新评论' );?></div>

<ol class="commentlist">
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>

<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
 
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
</ol>
</div>
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"></p>
 
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
<div id="commentsAdd">
<div id="respond" class="box m-t-6">
<?php
$params = array (
    'comment_notes_after' => '',
);
comment_form($params); 
?>
</div> 
</div>
<?php endif; // if you delete this the sky will fall on your head ?>