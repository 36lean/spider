<?php
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);
$post_count = 1;
	if ($tags) {
    $related_num = get_theme_option('related_count');
    $related_num = isset($related_num) ? $related_num : "3";
    $tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	$args=array(
	'tag__in' => $tag_ids,
	'post__not_in' => array($post->ID),
	'posts_per_page'=>$related_num, // Number of related posts to display.
	'ignore_sticky_posts'=>1
	);

	$my_query = new wp_query( $args );

    if( $my_query->have_posts() ) {
    echo '<div id="post-related">' . '<h4>' . __('Related Posts', TEMPLATE_DOMAIN) . '</h4>';
	while( $my_query->have_posts() ) {
	$my_query->the_post();
    $thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
	?>
<div class="feat-cat-meta post-<?php the_ID(); ?><?php if($post_count == 2 || $post_count == 5) { echo ' feat-center'; } ?>">
<div class="related-post-thumb">
<?php echo dez_get_featured_post_image($thepostlink, "</a>", 250, 250, "aligncenter", "thumbnail",dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</div>
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
</div>
 <?php $post_count++;
  }
  $post = $orig_post;
  wp_reset_query();
echo '</div>';
}

}  else {

get_template_part( 'lib/templates/related-by-cats' );

}

?>
