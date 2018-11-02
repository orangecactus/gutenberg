<div class="wrap">
	<div id="primary" class="content-area blockHeight">
		<main id="main" class="site-main" role="main">
            
            <!-- Breadcrumbs -->
            <div id="breadBin" class="columns">
				<?php Class_Breadcrumbs::custom_breadcrumbs(); ?>			
        	</div>
            <!-- breadcrumbs end -->
    
          <div id="content_hold" class="small-12 columns">
          
              <!-- mainPageTitle -->		
              <div id="mainPageTitle" class="small-12 medium-9">
                  <h1 class="titleHighlight"><?php the_title(); ?></h1>
              </div>	
              
              <div id="column02" class="small-12 columns">  
              
                  <div class="userContent" id="userContent">
                      <?php while ( have_posts() ) : the_post(); the_content(); endwhile; wp_reset_query();	 ?>
                  </div><!-- #usercontent -->
				  <?php  
					  if(get_post_meta( $post->ID, 'showchildren', true )==1){
							get_template_part( 'includes/inc', 'children' ); 
					  }
					?>                  
               </div><!-- #column02 -->    
              
        </div><!-- #content_hold -->
            
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

