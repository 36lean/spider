
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h2 class="post-title"><span><?php the_title(); ?></span></h2>
		
		<div class="postmeta"><?php themezee_display_postmeta(); ?></div>
			
		<div class="entry clearfix">
			<?php the_content(); ?>
			<!-- <?php trackback_rdf(); ?> -->
			<div class="page-links"><?php wp_link_pages(); ?></div>			
		</div>
		
		<div class="postinfo"><?php themezee_display_postinfo_single(); ?></div>

	</article>