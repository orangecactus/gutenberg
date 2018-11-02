<?php

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class Class_Meta_Theme {
	
	public function __construct() {
    }
	
	public function run() {		
		add_action('post_edit_form_tag', array($this,'update_edit_form'));
	}	
	
	function update_edit_form() {
		echo ' enctype="multipart/form-data"';
	}	
	
}