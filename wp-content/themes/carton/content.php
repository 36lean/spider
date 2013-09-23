<?php
$format = get_post_format();
$class = ( is_home() || is_archive() || is_search() ) ? 'masonry' : '';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	    <?php get_template_part( 'content', 'header' ); ?>

	    <div class="entry-content">
		    <?php
			$bavotasan_theme_options = bavotasan_theme_options();
			if ( empty( $format ) && ( ! is_single() || is_search() || is_archive() ) ) {
				if( has_post_thumbnail() ) {
					echo '<a href="' . get_permalink() . '" class="image-anchor">';
					the_post_thumbnail( 'medium', array( 'class' => 'alignleft img-thumbnail' ) );
					echo '</a>';
				}
				the_excerpt();
			} else {
				the_content( __( 'Read more &rarr;', 'carton' ) );
			}
			?>
	    </div><!-- .entry-content -->

	    <?php get_template_part( 'content', 'footer' ); ?>
	</article><!-- #post-<?php the_ID(); ?> -->