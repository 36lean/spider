<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @since 1.0.0
 */
$bavotasan_theme_options = bavotasan_theme_options();
$class = ( is_home() || is_archive() || is_search() ) ? 'masonry' : '';
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
		<h3 class="post-format"><?php _e( 'Link', 'carton' ); ?></h3>

	    <div class="entry-content">
		    <?php the_content( __( 'Read more &rarr;', 'carton' ) ); ?>
	    </div><!-- .entry-content -->

	    <?php get_template_part( 'content', 'footer' ); ?>
	</article>