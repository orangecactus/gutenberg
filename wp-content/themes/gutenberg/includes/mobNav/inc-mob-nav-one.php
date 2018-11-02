<nav class="mobileNav small-12 columns noPad">
	<?php	wp_nav_menu( array( 
        'items_wrap' => '<ul class="vertical menu drilldown" data-drilldown>%3$s</ul> ',
        'theme_location' => 'my-custom-menu', 
        'container_class' => 'custom-menu-class')
        
        ); 
    ?>	
</nav>

