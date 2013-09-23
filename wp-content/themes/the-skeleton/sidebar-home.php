<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The Widget Columns for the Front Page.
 *
 * @package The Skeleton
 */
?>
	
    <div id="widgets" class="home-widgets">


        <div class="widget-col-1">
            <?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-home1' ) ) : ?>
			

<aside id="text-4" class="widget widget_text"><h1 class="widget-title">Widget Column 1</h1>			
<div class="textwidget">This is your home Widget Column 1. To configure please go to Appearance &gt; Widgets and choose the widget area named Widgets Column 1 and input as many widgets as you like.
For each widget you can change the title.</div>
		</aside>

              <?php endif; //end of home-widget-1 ?>        
        </div><!-- end of widget-col-1 -->


        <div class="widget-col-2">       
	<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-home2' ) ) : ?>

<aside id="text-5" class="widget widget_text"><h1 class="widget-title">Widget Column 2</h1>			
<div class="textwidget">This is your home Widget Column 2. To configure please go to Appearance &gt; Widgets and choose the widget area named Widgets Column 2 and input as many widgets as you like.
For each widget you can change the title.</div>
		</aside>

			<?php endif; //end of home-widget-2 ?>
        </div><!-- end of widget-col-2 -->



        <div class="widget-col-3">
        <?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-home3' ) ) : ?>

<aside id="text-6" class="widget widget_text"><h1 class="widget-title">Widget Column 3</h1>			<div class="textwidget">This is your home Widget Column 3. To configure please go to Appearance &gt; Widgets and choose the widget area named Widgets Column 3 and input as many widgets as you like.
For each widget you can change the title.</div>
		</aside>



			<?php endif; //end of home-widget-3 ?>
        </div><!-- end of widget-col-3 -->


    </div><!-- end of #widgets -->