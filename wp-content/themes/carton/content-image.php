<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @since 1.0.0
 */
$bavotasan_theme_options = bavotasan_theme_options();
$class = ( is_home() || is_archive() || is_search() ) ? 'masonry' : '';
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	    <?php get_template_part( 'content', 'header' ); ?>

	    <div class="entry-content">
	        <?php
			if( has_post_thumbnail() && ! is_single() )
				the_post_thumbnail( 'large', array( 'class' => 'alignnone img-thumbnail' ) );
			else
				the_content( __( 'Read more &rarr;', 'carton' ) );
			?>
	    </div><!-- .entry-content -->

	    <?php get_template_part( 'content', 'footer' ); ?>
	</article>