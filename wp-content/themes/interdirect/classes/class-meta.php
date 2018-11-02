<?php

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class Class_Meta {
	
	public function __construct() {
		
    }
	
	public function run() {	
		add_action('add_meta_boxes', array($this,'common_meta'));		
		add_action('save_post', array($this, 'common_save'), 10, 2 );		
	}
	
	public function common_meta(){
		global $post;			
		add_meta_box('summary_meta', 'Summary', array($this,'summary_display'), 'page', 'normal', 'high');			
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		 );		
		$parent = new WP_Query( $args );			
		if ( $parent->have_posts() ) {	
			add_meta_box('children_meta', 'Show child pages', array($this,'children_display'), 'page', 'side', 'low');
		}
	}	
	
	public function common_save( $post_id, $post ) {		
		$this->save($post_id, $post, 'summary', 'pageSummary', isset( $_POST['pageSummary'] ) ? $_POST['pageSummary'] : '');
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		 );		
		$parent = new WP_Query( $args );			
		if ( $parent->have_posts() ) {	
			$this->save($post_id, $post, 'children', 'showchildren', isset( $_POST['showchildren'] ) ? 1 : 0);		
		}		
	}
	
	public function save( $post_id, $post, $nonce, $key, $value) {			
		if ( !isset( $_POST[$nonce.'_nonce'] ) || !wp_verify_nonce( $_POST[$nonce.'_nonce'], $nonce.'_meta' )){			
			return $post_id;
	  	}	
	   	$post_type = get_post_type_object( $post->post_type );	
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ){				
			return $post_id;
		}	
		delete_post_meta( $post_id, $key);
		if ( '' != $value){	
			add_post_meta( $post_id, $key, $value, true );	
		}		
	}		
	
	//META DISPLAYS
	public function summary_display( $post ) { 
		include_once(SM_ABSPATH.DIRECTORY_SEPARATOR.'metas'.DIRECTORY_SEPARATOR.'summary.php');		
	}	
	public function children_display( $post ) { 
		include_once(SM_ABSPATH.DIRECTORY_SEPARATOR.'metas'.DIRECTORY_SEPARATOR.'children.php');		
	}
}
