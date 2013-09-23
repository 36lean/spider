<?php get_header(); ?>
	<!-- BEGIN PAGE -->
	<div id="page">
    <div id="page-inner" class="clearfix">
<?php if (wrockmetro_get_option('wrockmetro_banner' ) =='1' ) {load_template(get_template_directory() . '/includes/banner-top.php'); } ?><div id="content">
<?php wrockmetro_breadcrumbs(); ?>
			<?php if (have_posts()) : ?>
			
			<?php while(have_posts())  : the_post(); ?>
			<?php get_template_part('/includes/post'); ?>
			<?php endwhile; ?>
			<?php else : ?>
				<div class="post">
					<div class="posttitle">
						<h2><?php _e('404 Error&#58; Not Found', 'wrockmetro'); ?></h2>
						<span class="posttime"></span>
					</div>
				</div>
			<?php endif; ?>
			<?php load_template (get_template_directory() . '/includes/pagenav.php'); ?>			
	      										
		</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
