<?php

class Facebook_Class {

	public function init($pagename){
		
		$host 			= 'graph.facebook.com';
		$path 			= '/v2.10/' . $pagename; // api call path
		$qs				= 'access_token=309520549518755|be587a0853b6b61f7ebd7e374a7d4521&fields=fan_count';
		$url 			= "https://$host$path?$qs";
		
		// if you're doing post, you need to skip the GET building above
		// and instead supply query parameters to CURLOPT_POSTFIELDS
		$options = array( 
						  CURLOPT_HEADER => false,
						  CURLOPT_URL => $url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_SSL_VERIFYPEER => false);
		
		// do our business
		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$json = curl_exec($feed);
		curl_close($feed);
		
		return json_decode($json);	
	}
}
