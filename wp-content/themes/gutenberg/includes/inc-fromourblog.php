<div id="blogFeature" class="small-12">
   	<div class="row">
        <div id="mainPageTitle" class="small-12 medium-9">
          <h1 class="titleHighlight">From our blog</h1>
       </div>
        <div class="blogFeatureInner small-12 columns">
            <div class="columns">
                
                <ul>	
                    <?php
                        
                        if ($post->post_parent)	{
                            $ancestors=get_post_ancestors($post->ID);
                            $root=count($ancestors)-1;
                            $parent = $ancestors[$root];
                        } else {
                            $parent = $post->ID;
                        }

                        if ($parent==8){
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 3, // Number of recent posts thumbnails to display
                                'category__not_in' => 3,
                                'post_status' => 'publish' // Show only the published posts
                            ));
                        }elseif ($parent==6){
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 3, // Number of recent posts thumbnails to display
                                'category__not_in' => 5,
                                'post_status' => 'publish' // Show only the published posts
                            ));
                        }else{
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 3, // Number of recent posts thumbnails to display
                                'post_status' => 'publish' // Show only the published posts
                            ));
                        }
                        foreach($recent_posts as $post){ 	?>
                        
                        <li class="small-12 medium-6 large-4 columns left">
                            
                            <a href="<?php echo get_permalink($post['ID']) ?>" title="">
                            
                            <?php 
                            if ( has_post_thumbnail( $post["ID"]) ) {
                            echo  get_the_post_thumbnail($post["ID"],'large');
                            }
        
                            ?>
                            <h4><?php echo $post['post_title'] ?></h4>
                            <p><?php echo wp_trim_words($post['post_content'],30) ?></p>
                            <span class="featureDate">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                10th March 2018
                            </span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
        
                        </li>
        
                    <?php } 
                        wp_reset_postdata();
                    ?>
                </ul>
                
                <a href="" title="See all news..." class="seeAll">
                    <span>See all news...</span>
                </a>
                 
                <div class="columns horizDivider">
                	<hr/>
                </div>    
                        
            </div>    
    	</div>
        
       </div> 
   </div>
   
   