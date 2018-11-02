<?php

	if(!isset($templatename)){
		$templatename = "article";	
	}
	
	/*
	ob_start();
	include THEME_ABSPATH . 'templates'.DIRECTORY_SEPARATOR.$templatename.DIRECTORY_SEPARATOR.'view.php';
	$view = ob_get_contents(); // get contents of buffer
	ob_end_clean();
	*/
	
	get_header(); 	
	
	include_once THEME_ABSPATH.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$templatename.DIRECTORY_SEPARATOR.'view.php';
			
	get_footer();
?>