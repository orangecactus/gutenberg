<?php

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class Class_Setup {
	
	public function __construct() {
		global $installcomplete ;
    }
	
	public function run() {			
		//Install the standard pages for SM
		$this->installsm();
	}
	
	
	
	public function installsm(){		
		add_action('update_option_idtheme_installsm', function( $option_name, $option_value ) {   
   			if($option_value==1&&!get_page_by_title('information')){				
				 
				//CREATE INFORMATION
				$informationid = wp_insert_post(array(
					'post_type'		=> 'page',
					'post_title'    => 'information',
					'post_content'  => '',
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id()
				));
				
				//CREATE CHILD PAGES				
				wp_insert_post(array(
					'post_parent'	=> $informationid,
					'post_type'		=> 'page',
					'post_title'    => 'Terms & Conditions',
					'post_content'  => '',
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id(),
					'page_template' => 'template-custom.php'
				));
					
				$privacyid = wp_insert_post(array(
					'post_parent'	=> $informationid,
					'post_type'		=> 'page',
					'post_title'    => 'Privacy Policy',
					'post_content'  => '',
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id()
				));	
				
				update_option("wp_page_for_privacy_policy", $privacyid,true);	
				
				wp_insert_post(array(
					'post_parent'	=> $informationid,
					'post_type'		=> 'page',
					'post_title'    => 'Cookie Policy',
					'post_content'  => '',
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id()
				));				
				
				$installcomplete  = true;
				
			}  	
		}, 10, 2);
	}
}
