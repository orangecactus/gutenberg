<?php

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class Class_Templates {
	
	public function __construct() {
		
    }
	
	public function run() {	
		if ( is_admin() ) {
			add_action('init', array($this,'sort_templates'));
		}else{
			add_action('wp', array($this,'sort_templates'));
		}
	}
	
	public function sort_templates(){		
			
		$theme = wp_get_theme();
		$templates = $theme->get_page_templates();	
		
		foreach($templates as $template=>$key){			
			$class 		= 'Class_'.$key;
			$dir		= THEME_ABSPATH.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.strtolower($key).DIRECTORY_SEPARATOR.'class.php';		
			if(file_exists($dir)){
				require_once $dir;					
				(new $class())->init($template, $key);
			}
		}	
	}	
}