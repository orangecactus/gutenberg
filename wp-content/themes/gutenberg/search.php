<?php get_header(); ?>
<div class="row">
	<div id="content_hold">
		
		<?php  _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>"); ?>
      
        
        <div id="searchResults" class="small-12 columns noPad">
         	<ul>
			<?php
            $s		=	get_search_query();
            $args 	= 	array(
                            's' =>$s
                        );
            $the_query = new WP_Query( $args );
                
           
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                       $the_query->the_post();
                             ?>
                                <li>
                                    <h3 class="title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p> If merely dining well on a rich variety of cuisines, drinking fine real ales and wines</p>
                                    <a href="<?php the_permalink(); ?>">View page</a>
                                    
                                </li>
                             <?php
                    }
                    
                    wp_reset_postdata();
                }else{
            ?>
             </ul>       
                        <div class="small-12 columns noPad">
                            <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
                            <div class="alert alert-info">
                              <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                            </div>
                        </div>
                    
            <?php } ?>
		</div><!-- searchResults end -->
	</div><!-- Content_hold end -->
</div>
<?php get_footer(); ?>