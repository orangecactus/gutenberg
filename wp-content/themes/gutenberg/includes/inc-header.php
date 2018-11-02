	
<header id="headerContainer">	
	
    <div id="header_col01" class="small-12 medium-3 columns headerBlock">
    	<div class="headerInner">
            <a href="/" title="" id="mainLogo">
                <img src="/wp-content/themes/proforma/assets/images/logo_main.png" alt="" class="logo"/>
            </a>
        </div>
    </div><!--- header_col01 end --->
    
	<div id="header_col02" class="small-12 medium-9 large-6 columns left headerBlock">
		
        <div class="headerInner show-for-medium">
			<?php include_once(THEME_ABSPATH . '/includes/mainNav/inc-main-nav-one.php'); ?>
            <?php include(THEME_ABSPATH . '/includes/topNav/inc-top-nav-one.php'); ?>
            <div class="smIcons large-12 columns">
                <div class="smIconsInner">
                    <a href="https://twitter.com/NEWTHEMEPROFORMA" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="https://www.facebook.com/NEWTHEMEPROFORMA/" title="Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/NEWTHEMEPROFORMA/" title="Instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://www.linkedin.com/company/NEWTHEMEPROFORMA/" title="Linkedin" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </div>
            </div>
		</div>

        <!--- Mobile Nav --->

        <a id="nav-toggle" data-toggle="offCanvas" class="show-for-small-only">
            <span class=""></span>
        </a>
        
        <div class="off-canvas position-left" id="offCanvas" data-off-canvas>
            <div class="small-12 show-for-small-only mobileNavContainer">

               <?php include_once(THEME_ABSPATH . '/includes/mobNav/inc-mob-nav-one.php'); ?>
               <?php include(THEME_ABSPATH . '/includes/topNav/inc-top-nav-one.php'); ?>
               <div class="smIcons large-12 columns">
                    <div class="smIconsInner">
                        <a href="https://twitter.com/NEWTHEMEPROFORMA" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/NEWTHEMEPROFORMA/" title="Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/NEWTHEMEPROFORMA/" title="Instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/company/NEWTHEMEPROFORMA/" title="Linkedin" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
         </div><!-- off-canvas end -->  
         
        <!--- Mobile Nav end --->
		
        
	</div><!--- header_col02 end --->
    
    <div id="header_col03" class="hide-for-medium-down large-3 columms headerBlock">
    	<div class="headerInner"></div>
    </div>							 

</header>
