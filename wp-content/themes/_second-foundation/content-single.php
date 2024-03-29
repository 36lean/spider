<?php
/**
 * @package _sf
 */
?>
<?php do_action( 'tha_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php do_action( 'tha_entry_top' ); ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php _sf_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() && ! has_post_format('gallery')  && ! has_post_format('image') ) : ?>
			<div class="large-3 columns post-thumbnail">
			<a href="<?php $id= get_post_thumbnail_id(); $src= wp_get_attachment_image_src( $id, 'large'); echo $src[0];  ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
			</div>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_sf' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', '_sf' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', '_sf' ) );

			if ( ! _sf_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_sf' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_sf' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_sf' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_sf' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', '_sf' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
<?php do_action( 'tha_entry_bottom' ); ?>
</article><!-- #post-## -->
<?php do_action( 'tha_entry_after' ); ?>