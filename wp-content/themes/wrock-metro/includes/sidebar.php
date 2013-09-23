<div id="sidebar2">	
<?php if (wrockmetro_get_option('wrockmetro_sharebut' ) =='1' ) {load_template(get_template_directory() . '/includes/social.php'); } ?>
<?php if (wrockmetro_get_option('wrockmetro_activate_ltposts' ) =='1' ) {load_template(get_template_directory() . '/includes/ltposts.php'); } ?>
	
	<?php if (!dynamic_sidebar('Sidebar Right') ) : ?>		
	
		
		<?php endif; ?>	

</div> <!-- end div #sidebar -->