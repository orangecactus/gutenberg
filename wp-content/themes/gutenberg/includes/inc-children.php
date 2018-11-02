<?php
	$args = array(
		'post_parent' => $post->ID,
		'post_type' => 'page',
		'orderby' => 'menu_order'
	);	
	$child_query = new WP_Query( $args );
?>

<div id="listingTemplate" class="small-12">

    <ul id="childPageContainer" class="small-12">
       
            <?php while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
                <li class="childPage small-12 medium-6 large-3 columns">
                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo esc_attr(the_title());?>">
                        
                        <div class="listing_content">
                            <span class="title"><?php echo the_title();?></span>
                            <span class="text"><?php echo wp_trim_words(get_post_meta($post->ID, 'pageSummary', true),14);?></span>          
                        </div>
                        <span class="more">Find out more</span>
                        <div class="listing_thumb" style="background:url(<?php echo get_the_post_thumbnail_url() == false ? THEME_URL . 'assets/images/default_image.jpg' : get_the_post_thumbnail_url(); ?>); background-size:cover; background-position:center top;">
                        	<img src="" alt=""/>
                        </div>
                    </a>
                </li>
            <?php endwhile; wp_reset_postdata();?> 
  
    </ul>
</div>