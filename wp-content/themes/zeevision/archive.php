<?php get_header(); ?>

	<div id="wrap" class="container">
		
		<section id="content" class="primary" role="main">

		<h2 id="date-title" class="archive-title">
			<?php // Display Archive Title
			if ( is_date() ) :
				printf( __( 'Monthly Archives: %s', 'zeeVision_language' ), '<span>' . get_the_date( _x( 'F Y', 'date format of monthly archives', 'zeeVision_language' ) ) . '</span>' );
			else :
				_e( 'Archives', 'zeeVision_language' );
			endif;
			?>
		</h2>
		
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'index' );
		
			endwhile;
			
		themezee_display_pagination();

		endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	