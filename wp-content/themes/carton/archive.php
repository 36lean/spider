<?php get_header(); ?>

	<section id="primary">

		<?php if ( have_posts() ) : ?>

			<header id="archive-header">
				<?php
				if ( is_category() || is_author() )
					echo '<hgroup>';
				?>
				<h1 class="page-title">
					<?php if ( is_category() ) : ?>
						<?php echo'<span>' . single_cat_title( '', false ) . '</span>'; ?>
					<?php elseif ( is_author() ) : ?>
						<?php printf( __( 'Author Archive for %s', 'carton' ), '<span>' . get_the_author_meta( 'display_name', get_query_var( 'author' ) ) . '</span>' ); ?>
					<?php elseif ( is_tag() ) : ?>
						<?php printf( __( 'Tag Archive for %s', 'carton' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
					<?php elseif ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: %s', 'carton' ), '<span>' . get_the_date() . '</span>' ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: %s', 'carton' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'carton' ) ) . '</span>' ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: %s', 'carton' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'carton' ) ) . '</span>' ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', 'carton' ); ?>
					<?php endif; ?>
				</h1><!-- .page-title -->
				<?php
				if ( is_category() ) :
					if ( $category_description = category_description() )
						echo '<h2 class="archive-meta">' . $category_description . '</h2>';
				endif;

				if ( is_author() ) :
					$curauth = ( get_query_var('author_name') ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var(' author' ) );
					if ( isset( $curauth->description ) )
						echo '<h2 class="archive-meta">' . $curauth->description . '</h2>';
				endif;

				if ( is_category() || is_author() )
					echo '</hgroup>';
				?>
			</header><!-- #archive-header -->

			<div id="boxes" class="js-masonry" data-masonry-options='{ "columnWidth": <?php echo $bavotasan_theme_options['column_width']; ?>, "itemSelector": ".masonry" }'>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			</div>

			<?php bavotasan_content_nav(); ?>

		<?php endif; ?>

	</section><!-- #primary.c8 -->

<?php get_footer(); ?>