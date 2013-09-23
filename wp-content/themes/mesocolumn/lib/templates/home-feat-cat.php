<?php
global $post;
$archive_excerpt = get_theme_option('post_custom_excerpt');
if($archive_excerpt == '0') { $archive_excerpt = '0'; } else if( empty($archive_excerpt) ) { $archive_excerpt = '30'; }

$featcat1 = get_theme_option('side_feat_cat1');
$featcat2 = get_theme_option('side_feat_cat2');
$featcat3 = get_theme_option('side_feat_cat3');
$featcat4 = get_theme_option('side_feat_cat4');
$featcat5 = get_theme_option('side_feat_cat5');
$featcat6 = get_theme_option('side_feat_cat6');

$featcat1_name = get_category_by_slug($featcat1)->cat_name;
$featcat2_name = get_category_by_slug($featcat2)->cat_name;
$featcat3_name = get_category_by_slug($featcat3)->cat_name;
$featcat4_name = get_category_by_slug($featcat4)->cat_name;
$featcat5_name = get_category_by_slug($featcat5)->cat_name;
$featcat6_name = get_category_by_slug($featcat6)->cat_name;

$featcat1_count = get_theme_option('side_feat_cat1_count');
$featcat2_count = get_theme_option('side_feat_cat2_count');
$featcat3_count = get_theme_option('side_feat_cat3_count');
$featcat4_count = get_theme_option('side_feat_cat4_count');
$featcat5_count = get_theme_option('side_feat_cat5_count');
$featcat6_count = get_theme_option('side_feat_cat6_count');

$category_id1 = get_category_by_slug($featcat1)->term_id;
$category_id2 = get_category_by_slug($featcat2)->term_id;
$category_id3 = get_category_by_slug($featcat3)->term_id;
$category_id4 = get_category_by_slug($featcat4)->term_id;
$category_id5 = get_category_by_slug($featcat5)->term_id;
$category_id6 = get_category_by_slug($featcat6)->term_id;

$cat1_count = dez_get_cat_post_count($category_id1);
$cat2_count = dez_get_cat_post_count($category_id2);
$cat3_count = dez_get_cat_post_count($category_id3);
$cat4_count = dez_get_cat_post_count($category_id4);
$cat5_count = dez_get_cat_post_count($category_id5);
$cat6_count = dez_get_cat_post_count($category_id6);

$icon_name = "";
$icon_time = "";
$icon_comment = '<i class="icon-comment-alt"></i>';

//featcat1
if($featcat1 && $featcat1 != 'Choose a category'):
$my_query1 = new WP_Query('cat='. $category_id1 . '&' . 'offset=' . '&' . 'showposts=' . $featcat1_count); ?>

<aside class="home-feat-cat post_tn_cat_color_<?php echo dez_get_strip_variable($category_id1); ?>">
<h4 class="homefeattitle feat_tn_cat_color_<?php echo dez_get_strip_variable($category_id1); ?>"><a href="<?php echo get_category_link( $category_id1 ); ?>"><?php echo stripcslashes($featcat1_name); ?></a>&nbsp;&nbsp;<a title="Get Feed for <?php echo $featcat1; ?>" href="<?php echo rtrim( get_category_link( $category_id1 ), '/'); ?>/feed/"><img class="home-feat-rss" src="<?php echo get_template_directory_uri(); ?>/images/rss2.png" alt="<?php _e('Get Feed for', TEMPLATE_DOMAIN); ?> <?php echo $featcat1; ?>" /></a></h4>
<div class="homefeat">

<?php $hfc1 = 0; while ($my_query1->have_posts()) : $my_query1->the_post(); $do_not_duplicate = $post->ID; ?>

<?php if( $hfc1 < 1 ) { ?>

<article class="<?php if( $cat1_count <= 1 ): ?>feat-is-single <?php endif; ?>feat-post fpost feat-<?php echo $post->ID; ?> fp<?php echo $hfc1; ?>">

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('<div class="feat-thumb">','</div>',480, 200, 'alignleft', 'featured-post-img',dez_get_singular_cat('false'),the_title_attribute('echo=0'),false); ?>
</a>

<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>

<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<div class="feat-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>

</article>


<?php } else { ?>

<article <?php post_class('feat-post apost'. ' fp'.$hfc1); ?>>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>
<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<?php if($archive_excerpt != '0') { ?><div class="feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>

</div>

</article>

<?php } ?>

<?php $hfc1++; endwhile; wp_reset_postdata(); ?>

</div>
</aside>

<?php endif;





//featcat2
if($featcat2 && $featcat2 != 'Choose a category'):
$my_query2 = new WP_Query('cat='. $category_id2 . '&' . 'offset=' . '&' . 'showposts='.$featcat2_count); ?>

<aside class="home-feat-cat post_tn_cat_color_<?php echo dez_get_strip_variable($category_id2); ?>">
<h4 class="homefeattitle feat_tn_cat_color_<?php echo dez_get_strip_variable($category_id2); ?>"><a href="<?php echo get_category_link( $category_id2 ); ?>"><?php echo stripcslashes($featcat2_name); ?></a>&nbsp;&nbsp;<a title="Get Feed for <?php echo $featcat2; ?>" href="<?php echo rtrim( get_category_link( $category_id2 ), '/'); ?>/feed/"><img class="home-feat-rss" src="<?php echo get_template_directory_uri(); ?>/images/rss2.png" alt="<?php _e('Get Feed for', TEMPLATE_DOMAIN); ?> <?php echo $featcat2; ?>" /></a></h4>
<div class="homefeat">

<?php $hfc2 = 0; while ($my_query2->have_posts()) : $my_query2->the_post(); $do_not_duplicate = $post->ID; ?>

<?php if( $hfc2 < 1 ) { ?>

<article class="<?php if( $cat2_count <= 1 ): ?>feat-is-single <?php endif; ?>feat-post fpost feat-<?php echo $post->ID; ?> fp<?php echo $hfc2; ?>">

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('<div class="feat-thumb">','</div>',480, 200, 'alignleft', 'featured-post-img',dez_get_singular_cat('false'),the_title_attribute('echo=0'),false); ?>
</a>

<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>

<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<div class="feat-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>

</article>


<?php } else { ?>

<article <?php post_class('feat-post apost'. ' fp'.$hfc2); ?>>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>
<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>
<?php if($archive_excerpt != '0') { ?><div class="feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>
</div>

</article>

<?php } ?>

<?php $hfc2++; endwhile; wp_reset_postdata(); ?>

</div>
</aside>

<?php endif;







//featcat3
if($featcat3 && $featcat3 != 'Choose a category'):
$my_query3 = new WP_Query('cat='. $category_id3 . '&' . 'offset=' . '&' . 'showposts='.$featcat3_count); ?>

<aside class="home-feat-cat post_tn_cat_color_<?php echo dez_get_strip_variable($category_id3); ?>">
<h4 class="homefeattitle feat_tn_cat_color_<?php echo dez_get_strip_variable($category_id3); ?>"><a href="<?php echo get_category_link( $category_id3 ); ?>"><?php echo stripcslashes($featcat3_name); ?></a>&nbsp;&nbsp;<a title="Get Feed for <?php echo $featcat3; ?>" href="<?php echo rtrim( get_category_link( $category_id3 ), '/'); ?>/feed/"><img class="home-feat-rss" src="<?php echo get_template_directory_uri(); ?>/images/rss2.png" alt="<?php _e('Get Feed for', TEMPLATE_DOMAIN); ?> <?php echo $featcat3; ?>" /></a></h4>
<div class="homefeat">

<?php $hfc3 = 0; while ($my_query3->have_posts()) : $my_query3->the_post(); $do_not_duplicate = $post->ID; ?>

<?php if( $hfc3 < 1 ) { ?>

<article class="<?php if( $cat3_count <= 1 ): ?>feat-is-single <?php endif; ?>feat-post fpost feat-<?php echo $post->ID; ?> fp<?php echo $hfc3; ?>">

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('<div class="feat-thumb">','</div>',480, 200, 'alignleft','featured-post-img',dez_get_singular_cat('false'),the_title_attribute('echo=0'),false); ?>
</a>

<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>

<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<div class="feat-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>

</article>


<?php } else { ?>

<article <?php post_class('feat-post apost'. ' fp'.$hfc3); ?>>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>
<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>
<?php if($archive_excerpt != '0') { ?><div class="feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>
</div>

</article>

<?php } ?>

<?php $hfc3++; endwhile; wp_reset_postdata(); ?>

</div>
</aside>

<?php endif;



//featcat4
if($featcat4 && $featcat4 != 'Choose a category'):
$my_query4 = new WP_Query('cat='. $category_id4 . '&' . 'offset=' . '&' . 'showposts='.$featcat4_count); ?>

<aside class="home-feat-cat post_tn_cat_color_<?php echo dez_get_strip_variable($category_id4); ?>">
<h4 class="homefeattitle feat_tn_cat_color_<?php echo dez_get_strip_variable($category_id4); ?>"><a href="<?php echo get_category_link( $category_id4 ); ?>"><?php echo stripcslashes($featcat4_name); ?></a>&nbsp;&nbsp;<a title="Get Feed for <?php echo $featcat4; ?>" href="<?php echo rtrim( get_category_link( $category_id4 ), '/'); ?>/feed/"><img class="home-feat-rss" src="<?php echo get_template_directory_uri(); ?>/images/rss2.png" alt="<?php _e('Get Feed for', TEMPLATE_DOMAIN); ?> <?php echo $featcat4; ?>" /></a></h4>
<div class="homefeat">

<?php $hfc4 = 0; while ($my_query4->have_posts()) : $my_query4->the_post(); $do_not_duplicate = $post->ID; ?>

<?php if( $hfc4 < 1 ) { ?>

<article class="<?php if( $cat4_count <= 1 ): ?>feat-is-single <?php endif; ?>feat-post fpost feat-<?php echo $post->ID; ?> fp<?php echo $hfc4; ?>">

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('<div class="feat-thumb">','</div>',480, 200, 'alignleft', 'featured-post-img',dez_get_singular_cat('false'),the_title_attribute('echo=0'),false); ?>
</a>

<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>

<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<div class="feat-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>

</article>


<?php } else { ?>

<article <?php post_class('feat-post apost'. ' fp'.$hfc4); ?>>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>
<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>
<?php if($archive_excerpt != '0') { ?><div class="feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>
</div>
</article>

<?php } ?>

<?php $hfc4++; endwhile; wp_reset_postdata(); ?>

</div>
</aside>

<?php endif;




//featcat4
if($featcat5 && $featcat5 != 'Choose a category'):
$my_query5 = new WP_Query('cat='. $category_id5 . '&' . 'offset=' . '&' . 'showposts='.$featcat5_count); ?>

<aside class="home-feat-cat post_tn_cat_color_<?php echo dez_get_strip_variable($category_id5); ?>">
<h4 class="homefeattitle feat_tn_cat_color_<?php echo dez_get_strip_variable($category_id5); ?>"><a href="<?php echo get_category_link( $category_id5 ); ?>"><?php echo stripcslashes($featcat5_name); ?></a>&nbsp;&nbsp;<a title="Get Feed for <?php echo $featcat5; ?>" href="<?php echo rtrim( get_category_link( $category_id5 ), '/'); ?>/feed/"><img class="home-feat-rss" src="<?php echo get_template_directory_uri(); ?>/images/rss2.png" alt="<?php _e('Get Feed for', TEMPLATE_DOMAIN); ?> <?php echo $featcat5; ?>" /></a></h4>
<div class="homefeat">

<?php $hfc5 = 0; while ($my_query5->have_posts()) : $my_query5->the_post(); $do_not_duplicate = $post->ID; ?>

<?php if( $hfc5 < 1 ) { ?>

<article class="<?php if( $cat5_count <= 1 ): ?>feat-is-single <?php endif; ?>feat-post fpost feat-<?php echo $post->ID; ?> fp<?php echo $hfc5; ?>">

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('<div class="feat-thumb">','</div>',480, 200, 'alignleft', 'featured-post-img',dez_get_singular_cat('false'),the_title_attribute('echo=0'),false); ?>
</a>

<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>

<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<div class="feat-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>

</article>


<?php } else { ?>

<article <?php post_class('feat-post apost'. ' fp'.$hfc5); ?>>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>
<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>
<?php if($archive_excerpt != '0') { ?><div class="feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>
</div>
</article>

<?php } ?>

<?php $hfc5++; endwhile; wp_reset_postdata(); ?>

</div>
</aside>

<?php endif;




//featcat6
if($featcat6 && $featcat6 != 'Choose a category'):
$my_query6 = new WP_Query('cat='. $category_id6 . '&' . 'offset=' . '&' . 'showposts='.$featcat6_count); ?>

<aside class="home-feat-cat post_tn_cat_color_<?php echo dez_get_strip_variable($category_id6); ?>">
<h4 class="homefeattitle feat_tn_cat_color_<?php echo dez_get_strip_variable($category_id6); ?>"><a href="<?php echo get_category_link( $category_id6 ); ?>"><?php echo stripcslashes($featcat6_name); ?></a>&nbsp;&nbsp;<a title="Get Feed for <?php echo $featcat6; ?>" href="<?php echo rtrim( get_category_link( $category_id6 ), '/'); ?>/feed/"><img class="home-feat-rss" src="<?php echo get_template_directory_uri(); ?>/images/rss2.png" alt="<?php _e('Get Feed for', TEMPLATE_DOMAIN); ?> <?php echo $featcat6; ?>" /></a></h4>
<div class="homefeat">

<?php $hfc6 = 0; while ($my_query6->have_posts()) : $my_query6->the_post(); $do_not_duplicate = $post->ID; ?>

<?php if( $hfc6 < 1 ) { ?>

<article class="<?php if( $cat6_count <= 1 ): ?>feat-is-single <?php endif; ?>feat-post fpost feat-<?php echo $post->ID; ?> fp<?php echo $hfc6; ?>">

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('<div class="feat-thumb">','</div>',480, 200, 'alignleft', 'featured-post-img',dez_get_singular_cat('false'),the_title_attribute('echo=0'),false); ?>
</a>

<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>

<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>

<div class="feat-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>

</article>


<?php } else { ?>

<article <?php post_class('feat-post apost'. ' fp'.$hfc6); ?>>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h1 class="feat-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h1>
<div class="feat-meta"><span class="feat_author"><?php the_author_posts_link(); ?></span><span class="feat_time"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span></div>
<?php if($archive_excerpt != '0') { ?><div class="feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>
</div>
</article>

<?php } ?>

<?php $hfc6++; endwhile; wp_reset_postdata(); ?>

</div>
</aside>

<?php endif;


?>