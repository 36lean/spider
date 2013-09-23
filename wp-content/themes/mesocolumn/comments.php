<?php do_action( 'bp_before_commentpost' ); ?>

<div id="commentpost">

<?php
if ( have_comments() ) :
$cpage = get_query_var('cpage');
?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<h4 id="comments"><span><?php comments_number(__('No Comments Yet', TEMPLATE_DOMAIN), __('1 Comment Already', TEMPLATE_DOMAIN), __('% Comments Already', TEMPLATE_DOMAIN)); ?></span></h4>

<div id="post-navigator-single">
<div id="rssfeed" class="alignleft"><a title="<?php __('stay updated with', TEMPLATE_DOMAIN); ?> <?php the_title(); ?>" href="<?php echo home_url() ?>/?feed=rss2&amp;p=<?php the_ID(); ?>"><?php _e('Subscribe to comments feed', TEMPLATE_DOMAIN); ?></a></div>
</div>

<?php do_action( 'bp_before_blog_comment_list' ) ?>

<ol class="commentlist">
<?php wp_list_comments('type=comment&callback=dez_get_the_list_comments'); ?>
</ol>

<?php do_action( 'bp_after_blog_comment_list' ) ?>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>


<?php do_action( 'bp_before_blog_ping_list' ); ?>

<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<h4><span><?php echo dez_get_wp_comment_count('pings'); ?></span></h4>
<ol class="pinglist">
<?php wp_list_comments('type=pings&callback=dez_get_the_list_pings'); ?>
</ol>
<?php endif; ?>

<?php do_action( 'bp_after_blog_ping_list' ); ?>


<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' != $post->comment_status) : ?>
 <!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<?php endif; ?>

<?php endif; //check have_comments() ?>

<?php if ('open' == $post->comment_status) : ?>
<?php comment_form(); ?>
<?php else: $comment_notice = get_theme_option('comment_notice'); if($comment_notice != 'Disable'): ?>
<?php if( get_post_type() == 'post' || get_post_type() == 'page' ):
echo "<p class='theme-messages alert'>". __('Sorry, comments are close for this post', TEMPLATE_DOMAIN) . "</p>";
endif; endif; ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>