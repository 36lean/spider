<?php get_header(); ?>
	<!-- BEGIN PAGE -->
	<div id="page">
    <div id="page-inner" class="clearfix">

<?php if (wrockmetro_get_option('wrockmetro_banner' ) =='1' ) {load_template(get_template_directory() . '/includes/banner-top.php'); } ?>
		<div id="pagecont">	<?php wrockmetro_breadcrumbs(); ?>
			<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
					<div id="pagepost-<?php the_ID(); ?>" class="pagepost clearfix">					
					<h1><?php the_title(); ?></h1>
					<div class="entry" class="clearfix">
																
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wrockmetro' ), 'after' => '</div>' ) ); ?>
								<!-- <?php trackback_rdf(); ?> -->
							</div> <!-- end div .entry -->
						<?php load_template (get_template_directory() . '/includes/postmeta.php'); ?>
							<div class="comments">
								<?php comments_template(); ?>
							</div> <!-- end div .comments -->
					</div> <!-- end div .post -->

			<?php endwhile; ?>
			<?php else : ?>
				<div class="post">
					<h3><?php _e('404 Error&#58; Not Found', 'wrockmetro'); ?></h3>
				</div>
			<?php endif; ?>
			      										
		</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
