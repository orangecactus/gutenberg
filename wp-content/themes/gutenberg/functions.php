<?php

//DEFINITIONS
define( 'THEME_ABSPATH', get_stylesheet_directory( __FILE__ ));
define( 'THEME_URL', trailingslashit(get_bloginfo('stylesheet_directory')));


//Register custom menu
function wpb_custom_new_menu() {
  	register_nav_menu('my-custom-menu',__( 'Top Nav' ));
	register_nav_menu('footer-nav',__( 'Footer Nav' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

//Remove all the normal widgets - TODO: Discuss these widgets with Helen and if we do want any?
remove_action( 'init', 'wp_widgets_init', 1 );
add_action( 'init', function() { do_action( 'widgets_init' ); }, 1 );	

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 700, 500 );


if ( !is_admin() ) {
	add_action('wp_enqueue_scripts', function(){		
		
		
	},2);
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {	
    return 'class="button"';
}

function wpshock_search_filter( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array('post','page') );
    }
    return $query;
}
add_filter('pre_get_posts','wpshock_search_filter');


function my_add_template_to_posts() {
	$post_type_object = get_post_type_object( 'page' );
	$post_type_object->template = array(
		array( 'core/paragraph', array(
			'placeholder' => 'Add a root-level paragraph',
		) ),
		array( 'core/columns', array(), array(
			array( 'core/column', array(), array(
				array( 'core/image', array() ),
			) ),
			array( 'core/column', array(), array(
				array( 'core/paragraph', array(
					'placeholder' => 'Add a inner paragraph'
				) ),
			) ),
		) )
	);
	$post_type_object->template_lock = 'all';
}
add_action( 'init', 'my_add_template_to_posts' );
