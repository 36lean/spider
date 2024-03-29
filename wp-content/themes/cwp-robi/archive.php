<?php get_header(); ?>
<div id="archivetitle"><h1>
	  <?php if (have_posts()) : ?>
 	 
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
	  <?php _e('Category:','cwp'); ?> <?php single_cat_title(); ?>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	  <?php _e('Tag:','cwp'); ?> <?php single_tag_title(); ?>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	  <?php _e('Archive:','cwp'); ?>  <?php echo get_the_date('F jS, Y'); ?>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	  <?php _e('Archive:','cwp'); ?>  <?php echo get_the_date('F, Y'); ?>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	  <?php _e('Archive:','cwp'); ?>  <?php echo get_the_date('Y'); ?>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
 	  <?php } ?>
	  </h1></div>
	  <div class="clearfix"></div>
<section id="content">

	<?php while (have_posts()) : the_post();  //Get posts
			$titlupost = get_the_title();
			$posturl = get_permalink();
	?>
			<article class="item">
				<div class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
				<div class="image">
				<?php 
					$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					if(isset($feat_image[0])):
						echo '<a href='.$posturl.' title="'.$titlupost.'"><img src='.$feat_image[0].' alt="'.$titlupost.'"></a>';
					endif;	
				?>
				</div>
				<div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
				<div class="excerpt"><?php the_excerpt(); ?></div>
				<div class="readmore"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php _e('More','cwp'); ?></a></div>
			</article><!--index article end-->
	<?php endwhile;		
		/* Use PageNavi*/ else : ?>
	
		<?php _e('404 Not Found','cwp'); ?>
	<?php endif; ?>
			<?php
				$p = get_previous_posts_link( __( 'Previous page','cwp' ) ); 
				$n = get_next_posts_link( __( 'Next page','cwp' ) ); 
				
				if($p || $n) :
					echo '<article class="item">';
					if($p) :
						echo '<div class="prev">'.$p.'</div>'; 
					endif;
					if($n) :
						echo '<div class="next">'.$n.'</div>'; 
					endif;
					echo '</article>';
				endif;	
			?>
		</section><!--#content end-->

<?php get_footer(); ?>