<?php get_header(); ?>

<?php do_action( 'bp_before_content' ); ?>

<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ); ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php
$archive_headline = get_theme_option('archive_headline');
if($archive_headline != 'Disable') {
get_template_part( 'lib/templates/headline' );
} ?>

<?php
$archive_excerpt = get_theme_option('post_custom_excerpt');
$excerpt_moretext = get_theme_option('post_excerpt_moretext');
if($archive_excerpt == '0') { $archive_excerpt = '0'; } else if( empty($archive_excerpt) ) { $archive_excerpt = '30'; }
if($excerpt_moretext == '') { $excerpt_moretext = 'Continue Reading &raquo;'; }
$oddpost = 'alt-post'; $postcount = 1; if (have_posts()) : while (have_posts()) :  the_post();
$thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
?>

<?php do_action( 'bp_before_blog_post' ); ?>

<!-- POST START -->
<article <?php post_class($oddpost); ?> id="post-<?php the_ID(); ?>">

<?php echo dez_get_featured_post_image("<div class='post-thumb in-archive'>".$thepostlink, "</a></div>", 300, 300, "alignleft", "medium",dez_get_singular_cat('false'), the_title_attribute('echo=0'), false); ?>

<div class="post-right">
<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<?php get_template_part( 'lib/templates/post-meta-home' ); ?>

<?php do_action( 'bp_before_post_content' ); ?>

<div class="post-content">
<?php echo dez_get_custom_the_excerpt($archive_excerpt); ?>
<?php if($excerpt_moretext != 'disable') { ?>
<div class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo stripcslashes($excerpt_moretext); ?></a></div><?php } ?>
</div>

<?php do_action( 'bp_after_post_content' ); ?>

</div>
</article>
<!-- POST END -->

<?php do_action( 'bp_after_blog_post' ); ?>

<?php
$get_ads_code_one = get_theme_option('ads_code_one');
$get_ads_code_two = get_theme_option('ads_code_two');
if( $get_ads_code_one == '' && $get_ads_code_two == '') { ?>
<?php } else { ?>
<?php if( 2 == $postcount ){ ?>
<div class="adsense-post">
<?php echo stripcslashes(do_shortcode($get_ads_code_one)); ?>
</div>
<?php } elseif( 4 == $postcount ){ ?>
<div class="adsense-post">
<?php echo stripcslashes(do_shortcode($get_ads_code_two)); ?>
</div>
<?php } ?>
<?php } ?>

<?php ($oddpost == "alt-post") ? $oddpost="" : $oddpost="alt-post"; $postcount++; ?>

<?php endwhile; ?>

<?php comments_template( '', true ); ?>

<?php else: ?>

<?php get_template_part( 'lib/templates/result' ); ?>

<?php endif; ?>

<?php get_template_part( 'lib/templates/paginate' ); ?>

</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ); ?>

</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>