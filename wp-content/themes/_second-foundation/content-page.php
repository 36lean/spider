<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _sf
 */
?>
<?php do_action( 'tha_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php do_action( 'tha_entry_top' ); ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail()) : ?>
			<div class="large-6 columns">
			<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
			</div>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_sf' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', '_sf' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
<?php do_action( 'tha_entry_bottom' ); ?>
</article><!-- #post-## -->
<?php do_action( 'tha_entry_after' ); ?>