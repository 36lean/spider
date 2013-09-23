<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * @package The Skeleton
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php responsive_skeleton_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">

<?php
if(get_post_meta(get_the_ID(), "_related-video", true) != '') {

$embed_code = wp_oembed_get(''.get_post_meta(get_the_ID(), "_related-video", true).'',  
                                 array( 'width'=> '100%', 'height'=> '100%' ) ); 

echo '<div class="fluid-width-video-wrapper">'.$embed_code.'</div>'; 
}
?>


                    <?php if ( has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif; ?>

		<?php the_excerpt(); ?><span class="read_more"><a href="<?php the_permalink(); ?>">&rarr;</a></span>

	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">

<?php
if(get_post_meta(get_the_ID(), "_related-video", true) != '') {

$embed_code = wp_oembed_get(''.get_post_meta(get_the_ID(), "_related-video", true).'',  
                                 array( 'width'=> '100%', 'height'=> '100%' ) ); 

echo '<div class="fluid-width-video-wrapper">'.$embed_code.'</div>'; 
}
?>


                    <?php if ( has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif; ?>

		<?php the_excerpt(); ?><span class="read_more"><a href="<?php the_permalink(); ?>">&rarr;</a></span>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'the-skeleton' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'the-skeleton' ) );
				if ( $categories_list && responsive_skeleton_categorized_blog() ) :
			?><hr>
                        <div class="cat-links-wrapper">
			<span class="cat-links">
				<?php printf( __( 'Published in %1$s', 'the-skeleton' ), $categories_list ); ?>
			</span></div>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'the-skeleton' ) );
				if ( $tags_list ) :
			?>
                        <div class="tag-links-wrapper">
			<span class="tags-links">
				<?php printf( __( 'Tagged under %1$s', 'the-skeleton' ), $tags_list ); ?>
			</span></div>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?><hr>

<div class="comment-link-wrapper">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'the-skeleton' ), __( '1 Comment', 'the-skeleton' ), __( '% Comments', 'the-skeleton' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'the-skeleton' ), '<span class="edit-link">', '</span>' ); ?></div>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->