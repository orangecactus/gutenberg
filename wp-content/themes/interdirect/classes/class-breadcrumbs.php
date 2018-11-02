<?php

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

abstract class Class_Breadcrumbs {
	
	public function __construct() {
		
    }

	// Breadcrumbs
	public static function custom_breadcrumbs() {
		   
		// Settings
		$breadcrums_id      = 'breadcrumbs';
		$breadcrums_class   = 'breadcrumbs medium-12 large-12 columns show-for-medium-up';
		$home_title         = '<i class="fa fa-home"></i>';
		  
		// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
		$custom_taxonomy    = 'product_cat';
		   
		// Get the query & post information
		global $post,$wp_query;
		   
		// Do not display on the homepage
		if ( !is_front_page() ) {
		   
			// Build the breadcrums
			echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
			   
			// Home page
			echo '<li class="home" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="'.get_home_url().'" itemprop="url">
						<span itemprop="title">
							Home        
						</span>
					</a>
				</li>';
				
				
			   
			if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
				  
				echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">					
						<span itemprop="title">'.post_type_archive_title($prefix, false).'</span>					
					</li>';
				
				echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
			
			
			}else if (is_singular( 'event' )){
				
				// If post is a custom post type				
				$taxonomyName 	= get_query_var( 'taxonomy' );
				$taxomony 		= get_taxonomy($taxonomyName );
				$term_slug 		= get_query_var( 'term' );
				$post_type		= $post->post_type;
				
				
				// If it is a custom post type display name and link
				if(isset($post_type) && $post_type != 'post') {					
				  	echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="/'.$taxonomyName.'/'.$term_slug .'" title="' . $taxonomyName . '">
								<span itemprop="title">'.$taxonomyName.'</span>'.'	
							</a>				
						</li>';
				} 
				
				echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'. $post->post_title.'</span>											
						</li>';
			
			} else if ( is_archive() && is_tax() && !is_category() && !is_tag() || is_singular( 'event' ) ) {				
				
				// If post is a custom post type				
				$taxonomyName 	= get_query_var( 'taxonomy' );
				$taxomony 		= get_taxonomy($taxonomyName );
				$term_slug 		= get_query_var( 'term' );
				
				// If it is a custom post type display name and link
				if($post == null) {					
				  	echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="/'.$taxonomyName.'/'.$term_slug .'" title="' . $taxonomyName . '">
								<span itemprop="title">'.$taxonomyName.'</span>'.'	
							</a>				
						</li>';
				}
				  
				$custom_tax_name = get_queried_object()->name;
				echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'. $custom_tax_name.'</span>											
						</li>';
				  
			} else if ( is_single() ) {
				// If post is a custom post type
				$post_type = get_post_type();
				  
				// If it is a custom post type display name and link
				if($post_type != 'post') {
					  
					$post_type_object = get_post_type_object($post_type);
					$post_type_archive = get_post_type_archive_link($post_type);				  
					echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="'.$post_type_archive.'" title="' . $post_type_object->labels->name . '">
								<span itemprop="title">'.$post_type_object->labels->name.'</span>'.'	
							</a>				
						</li>';				  
				}
				  
				// Get post category info
				$category = get_the_category();
				 
				if(!empty($category)) {
					
					
				  
					// Get last category post is in
					$array_val = array_values($category);
					$last_category = end($array_val);
					  
					// Get parent any categories and create array
					$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
					$cat_parents = explode(',',$get_cat_parents);
					  
					// Loop through parent categories and store in variable $cat_display
					$cat_display = '';
					foreach($cat_parents as $parents) {						
						$cat_display .= '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
								<a href="/news" title="news">
									<span itemprop="title">news</span>'.'											
								</a>
						</li>';							
					}
				 
				}
				  
				// If it's a custom post type within a custom taxonomy
				$taxonomy_exists = taxonomy_exists($custom_taxonomy);
				if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
					   
					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					$cat_id         = $taxonomy_terms[0]->term_id;
					$cat_nicename   = $taxonomy_terms[0]->slug;
					$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
					$cat_name       = $taxonomy_terms[0]->name;
				   
				}
				  
				// Check if the post is in a category
				if(!empty($last_category)) {
					
					echo $cat_display;
					echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'.get_the_title().'</span>
						</li>';	
						 
				// Else if post is in a custom taxonomy
				} else if(!empty($cat_id)) {					  
						echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="'.$cat_link.'" title="' . $cat_nam . '">
								<span itemprop="title">'.$cat_nam.'</span>'.'	
							</a>				
						</li>
						<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'.get_the_title().'</span>			
						</li>';				  
				  
				} else {	echo 'a';				  
					  echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'.get_the_title().'</span>			
						</li>';
				}
				  
			} else if ( is_category() ) {				   
				// Category page
				 echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'.single_cat_title('', false).'</span>			
						</li>';
				   
			} else if ( is_page() ) {
				
				// Standard page
				if( $post->post_parent ){
					   
					// If child page, get parents 
					$anc = get_post_ancestors( $post->ID );
					   
					// Get parents in the right order
					$anc = array_reverse($anc);
					   
					// Parent page loop
					if ( !isset( $parents ) ) $parents = null;
					foreach ( $anc as $ancestor ) {						
						$parents .= '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="'.get_permalink($ancestor).'" title="' . get_the_title($ancestor) . '">
								<span itemprop="title">'.get_the_title($ancestor).'</span>'.'	
							</a>				
						</li>';						
					}
					   
					// Display parent pages
					echo $parents;
					// Current page
					    echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'. get_the_title() .'</span>			
						</li>';
				} else {					   
					  echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'. get_the_title() .'</span>			
						</li>'; 
				}
				   
			} else if ( is_tag() ) {
				   
				// Tag page
				   
				// Get tag information
				$term_id        = get_query_var('tag_id');
				$taxonomy       = 'post_tag';
				$args           = 'include=' . $term_id;
				$terms          = get_terms( $taxonomy, $args );
				$get_term_id    = $terms[0]->term_id;
				$get_term_slug  = $terms[0]->slug;
				$get_term_name  = $terms[0]->name;
				   
				 echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'. $get_term_name .'</span>			
						</li>'; 
			   	
			   
			} elseif ( is_day() ) {
				   
				// Day archive				   
				echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="'.get_year_link( get_the_time('Y') ).'" title="' . get_the_time('Y') . ' Archives">
								<span itemprop="title">'.get_the_time('Y').' Archives</span>'.'	
							</a>				
						</li>
						<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="'.get_month_link( get_the_time('Y'), get_the_time('m') ).'" title="' . get_the_time('M') . ' Archives">
								<span itemprop="title">'.get_the_time('M').' Archives</span>'.'	
							</a>				
						</li>
						
						<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">' . get_the_time('jS') . ' '. get_the_time('M').' Archives</span>			
						</li>';	
					   
			} else if ( is_month() ) {
				   
				// Month Archive
				   
					echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<a href="'.get_year_link( get_the_time('Y') ).'" title="' . get_the_time('Y') . ' Archives">
								<span itemprop="title">'.get_the_time('Y').' Archives</span>'.'	
							</a>				
						</li>
						<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'.get_the_time('M').' Archives</span>			
						</li>';	
				   
				   
				   
				   
			} else if ( is_year() ) {
				   
				// Display year archive
				echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">'.get_the_time('Y') . ' Archives</span>			
						</li>';	   
				   
			} else if ( is_author() ) {
				   
				// Auhor archive
				   
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );				   
				 
			   	// Display year archive
				echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">Author: ' . $userdata->display_name . ' Archives</span>			
						</li>';	  
			   
			} else if ( get_query_var('paged') ) {
				   
				// Paginated archives
				 echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">' . __('Page') . ' ' . get_query_var('paged') . '</span>			
						</li>';	    
			} else if ( is_search() ) {
			   
				// Search results page
				echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
			   
			   echo '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	
							<span itemprop="title">Search results for: ' . get_search_query() . ' Archives</span>			
						</li>';	
			   
			} elseif ( is_404() ) {
				   
				// 404 page
				echo '<li>' . 'Error 404' . '</li>';
			}
		   
			echo '</ul>';
			   
		}
		   
	}
}