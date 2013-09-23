<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;


/**
 * The Widget Columns for the Footer
 *
 * @package The Skeleton
 */
?>
	
    <div id="footer-widgets" class="footer-widgets">


        <div class="footer-col-1">
            <?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>


            
			

              <?php endif; //end of sidebar-2 ?>        
        </div><!-- end of footer-col-1 -->




        <div class="footer-col-2">       
	<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>




			<?php endif; //end of sidebar-3 ?>
        </div><!-- end of footer-col-2 -->



<div class="footer-col-4">
        <?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-5' ) ) : ?>


           


			<?php endif; //end of sidebar-5 ?>
        </div><!-- end of footer-col-4 -->



        <div class="footer-col-3">
        <?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-4' ) ) : ?>


           
            
             


			<?php endif; //end of sidebar-4 ?>
        </div><!-- end of footer-col-3 -->



    </div><!-- end of #footer-widgets -->