<?php

//DEFINITIONS
define( 'SM_ABSPATH', get_parent_theme_file_path());
define( 'SM_URL', trailingslashit(get_template_directory_uri()));
define( 'GOOGLE_API_KEY', 'AIzaSyC1ZWQnPJQjrgWg7NZKD24f2C5f-GuzNd8');

//Change robots.txt for everything other than idlive
if(in_array(SITE_STATE, array("idlocal","idqa", "iddev")) && get_option( 'blog_public' ) == "1"){
	update_option("blog_public","0",true);
}else if(SITE_STATE=='idlive' && get_option( 'blog_public' ) == "0"){
	update_option("blog_public","1",true);
}

//Clean the page of useless things
remove_filter( 'template_redirect','redirect_canonical' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'xmlrpc_enabled', '__return_false' );

// Hide xmlrpc.php in HTTP response headers
add_filter( 'wp_headers', function( $headers ) {
    unset( $headers[ 'X-Pingback' ] );
    return $headers;
}); 
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

function filter_ptags_on_images($content){
    return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function wpb_disable_feed() {
	wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}
 
add_action('do_feed', 'wpb_disable_feed', 1);
add_action('do_feed_rdf', 'wpb_disable_feed', 1);
add_action('do_feed_rss', 'wpb_disable_feed', 1);
add_action('do_feed_rss2', 'wpb_disable_feed', 1);
add_action('do_feed_atom', 'wpb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'wpb_disable_feed', 1);
add_action('do_feed_atom_comments', 'wpb_disable_feed', 1);

//******************************
//LOAD Templates for this site
//******************************

//Load respective templates and their fields
if(file_exists(SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-templates.php')){
	require_once SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-templates.php';	
	(new Class_Templates())->run();	
}


if ( is_admin() ) {
	
	//****************************
	//SITEMACHINE Setup init pages
	//****************************	
	if(file_exists(SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-setup.php')){
		require_once SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-setup.php';	
		(new Class_Setup())->run();
	}
	
	//******************************
	//SITEMACHINE Meta for pages etc
	//******************************	
	if(file_exists(SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-meta.php')){
		require_once SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-meta.php';	
		$global_class_meta = new Class_Meta();
		$global_class_meta->run();	
	}
	
	//******************************
	//THEMECENTRIC Meta for pages etc
	//******************************	
	if(defined("THEME_ABSPATH") && file_exists(THEME_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-meta.php')){
		require_once THEME_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-meta.php';	
		(new Class_Meta_Theme())->run();	
	}	
	
	add_action('admin_enqueue_scripts', function(){	
		
		wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.12.1/themes/redmond/jquery-ui.css' ); 
		wp_register_style( 'idadmin',  get_template_directory_uri() . '/_global/css/_core/admin.css' );
		
		wp_enqueue_style( 'jquery-ui' ); 
   		wp_enqueue_style( 'idadmin' );
		
		//Only load if pn a page
		$pt = get_current_screen()->post_type;
		if($pt=='page'){
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script('meta-js', get_template_directory_uri() . '/_global/js/_core/meta.js', array());	
			wp_enqueue_script('admin-js', get_template_directory_uri() . '/_global/js/_core/admin.js', array('jquery-core'));		
		}	
		 	
	},1);			
	
}else{	
	if(!is_login_page()){
		
		//******************************
		//Frontend files and functions
		//******************************	
		
		if(file_exists(SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-breadcrumbs.php')){
			require_once SM_ABSPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-breadcrumbs.php';	
		}
		
		add_action('wp_enqueue_scripts', function(){	
		
			 global $post;		
			
			//Remove any default jQuery
			wp_deregister_script('jquery'); 
			wp_register_script('jquery', '', '', '', true);	
			wp_deregister_script( 'wp-embed' );
			wp_register_script('wp-embed', '', '', '', true);	
			
			//If not logged in as admin delete the dashicons CSS
			if( !current_user_can('editor') && !current_user_can('administrator') ) { 		
				wp_deregister_style( 'dashicons' ); 
			}
			
			wp_register_script('id-jquery', 		'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js', array());	
			wp_register_script('id-foundation', 	SM_URL . '_global/js/_core/foundation/foundation.js', array());		
			wp_register_script('id-validate', 		SM_URL . '_global/js/plugins/jquery.validate/jquery.validate.js', array());	
			wp_register_script('id-cookie', 		SM_URL . '_global/js/plugins/jquery.cookiecontrol/jquery.cookiecontrol.js', array());				
			wp_register_script('id-js', 			SM_URL . '_global/js/custom/id.js', array());
			wp_register_script('id-clientjs', 		THEME_URL . 'assets/js/custom/client.js', array());
			
			wp_enqueue_script('id-jquery');
			wp_enqueue_script('id-foundation');
			wp_enqueue_script('id-equalizer');
			wp_enqueue_script('id-dropdown');
			wp_enqueue_script('id-offcanvas');
			wp_enqueue_script('id-accordion');
			wp_enqueue_script('id-validate');
			wp_enqueue_script('id-cookie');	
			wp_enqueue_script('id-js');
			wp_enqueue_script('id-clientjs');
			
			wp_localize_script('id-clientjs', 'client', array(
				'postID' 				=> isset($post) ? $post->ID : 0,
				'ajaxurl' 				=> admin_url('admin-ajax.php'),
				'googleapikey' 			=> GOOGLE_API_KEY,
				'gacode' 				=> get_option('idtheme_googleanalyticscode')
				)
			);
			
			wp_register_style( 'id-normalize', 		SM_URL . '_global/css/_core/normalize.css' ); 
			wp_register_style( 'id-foundation', 	SM_URL . '_global/css/_core/foundation.css' ); 
			wp_register_style( 'id-style', 			SM_URL . 'style.css' );
			if(defined('THEME_URL')){
				wp_register_style( 'id-clientstyle',THEME_URL . 'style.css' ); 
			}
			wp_register_style( 'id-font-awesome', 	SM_URL . '_global/css/_core/font-awesome.min.css' ); 
			wp_register_style( 'id-googleapis', 	'https://fonts.googleapis.com/css?family=Open+Sans' ); 			
			wp_register_style( 'id-jquery-ui', 		'http://code.jquery.com/ui/1.12.1/themes/hot-sneaks/jquery-ui.css' ); 
			wp_register_style( 'id-cookiestyle', 	SM_URL . '_global/js/plugins/jquery.cookiecontrol/jquery.cookiecontrol.css' ); 
			
			wp_enqueue_style( 'id-normalize' ); 
			wp_enqueue_style( 'id-foundation' ); 
			wp_enqueue_style( 'id-style' ); 
			wp_enqueue_style( 'id-clientstyle' ); 
			wp_enqueue_style( 'id-font-awesome' ); 
			wp_enqueue_style( 'id-googleapis' ); 	
			wp_enqueue_style( 'id-jquery-ui' ); 
			wp_enqueue_style( 'id-cookiestyle' ); 				
					
		}, 1);
		
		require_once SM_ABSPATH.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-twitter.php';
		require_once SM_ABSPATH.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class-facebook.php';
		
	}	
}


//******************************
//SITEMACHINE UTILITY
//******************************

//Main Settings for the ID Themes
add_action('admin_menu',function(){
	add_options_page( 
		'ID:Settings', 
		'ID:Settings', 
		'manage_options', 
		'id_settings',
		function(){
			include_once( SM_ABSPATH.DIRECTORY_SEPARATOR.'metas'.DIRECTORY_SEPARATOR.'settings.php' );	
		}
	);	
});

add_action( 'admin_init', function() {	
	register_setting( 'idtheme-settings', 'idtheme_googleanalyticscode' );	
	register_setting( 'idtheme-settings', 'idtheme_adminmenu' );	
	register_setting( 'idtheme-settings', 'idtheme_footertext' );	
	register_setting( 'idtheme-settings', 'idtheme_installsm' );		
	add_option( 'idtheme_googleanalyticscode', "" );	
	add_option( 'idtheme_adminmenu', "" );	
	add_option( 'idtheme_footertext', "" );		
	add_option( 'idtheme_installsm', "" );	
});	

//Show admin bar frontend
if(get_option('idtheme_adminmenu')==1){
	add_filter("show_admin_bar", "__return_false");
}

//SETUP EXTERNAL EMAIL
add_action('wp_loaded',function(){
	add_action( 'phpmailer_init', 'mailer_config');	
});

function mailer_config($phpmailer){
  	$phpmailer->isSMTP();
    $phpmailer->Host = 'smtp0.interdirect.co.uk';
    $phpmailer->Port = 25;
}	

add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors($mailer){
	dump($mailer);
	exit();	
  	$fn = ABSPATH . '/mail.log'; // say you've got a mail.log file in your server root
  	$fp = fopen($fn, 'a');
  	fputs($fp, "Mailer Error: " . $mailer->ErrorInfo ."\n");
  	fclose($fp);
}



































