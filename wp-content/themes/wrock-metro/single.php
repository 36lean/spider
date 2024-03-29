<?php get_header(); ?><!-- BEGIN PAGE -->
<div id="page">	<div id="page-inner" class="clearfix">
<?php if (wrockmetro_get_option('wrockmetro_banner' ) =='1' ) {load_template(get_template_directory() . '/includes/banner-top.php'); } ?>
		<div id="content"><?php wrockmetro_breadcrumbs(); ?>
			<?php if(have_posts()) : ?>
			<?php while(have_posts())  : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if ( wrockmetro_get_option('wrockmetro_ad2') <> "" ) { echo stripslashes(wrockmetro_get_option('wrockmetro_ad2')); } ?>
			<?php the_content(); ?> </header>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wrockmetro' ), 'after' => '</div>' ) ); ?>
		<span class="postmeta_box">
		<?php get_template_part('/includes/postmeta'); ?><?php  if (get_the_tags()) :?> <span class="tags"><?php if("the_tags") the_tags(''); ?></span><?php endif;?><?php edit_post_link('Edit', ' &#124; ', ''); ?>
	</span><!-- .entry-header -->
	<div class="gap"></div><?php if (wrockmetro_get_option('wrockmetro_author' ) =='1' ) {load_template(get_template_directory() . '/includes/author.php'); } ?>

		<div id="single-nav" class="clearfix">
		<div id="single-nav-left"><?php previous_post_link('&laquo;<strong>%link</strong>'); ?></div>
		<div id="single-nav-right"><?php next_post_link('<strong>%link</strong>&raquo;'); ?></div>
        </div>
        <!-- END single-nav -->
			<div class="comments">	<?php comments_template(); ?>	</div> <!-- end div .comments -->	</article> <!-- end div .post -->
			<?php endwhile; ?>
			<?php else : ?>
				<div class="post">
					<h3><?php _e('404 Error&#58; Not Found', 'wrockmetro' ); ?></h3>
				</div>
			<?php endif; ?>
		</div> <!-- end div #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>