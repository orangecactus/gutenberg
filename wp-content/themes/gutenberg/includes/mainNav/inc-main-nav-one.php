<nav class="small-12 columns">
    <?php	wp_nav_menu( array( 
        'items_wrap' => '<ul class="dropdown menu animated fadeInDown" data-dropdown-menu>%3$s</ul> ',
        'theme_location' => 'my-custom-menu', 
        'container_class' => 'custom-menu-class')
        ); 
    ?>	
</nav>

<style>
	/* ------------------ move to main style.css if you're using this nav --------------- */

	nav {
		position:relative;
		z-index:10;
		text-align:center;
	}
	
	nav .menu {
		display:inline-table;
		width:100%;
		
	}
	
	nav .menu li {
		list-style: none;
		width: auto;
		display: inline-block;
		
	}
	
	nav .menu li a {
		font-size:16px;
	}
	
	nav .menu li ul {
		margin:0;
	}
	
	
	@media only screen and (max-width: 64.063em) {
		nav {text-align:center;}
		nav .menu {display:inline-table;}
		nav .menu li {
			width: auto;
			display:inline-block;
		}
		
		#header_col01 {width:100%;}
		#header_col02 {width:100%; padding-bottom:0;}
		
		#mainLogo img {
			position:relative;
			top:0;
			display:block;
			margin:auto;
			min-width:150px;
			max-width:170px;
			transform:none;
			-webkit-transform:none;
			-moz-transform:none;
			-ms-transform:none;
			-o-transform:none;
		}
		
	}
	
	@media only screen and (max-width: 40.063em) {
		nav  {text-align:left;}
		nav .menu {display:inline-block;}
		nav .menu li {width:100%;}
		#header_col02 {padding:0;}
	}
	
	
	
	 @media only screen and (max-width: 40.063em) and (orientation: landscape){
		nav .menu li {width:auto;}
	}
	
	@media only screen and (min-width: 30em) and (max-width: 39em) and (orientation: landscape){
		nav .menu li {width:100%;}
	}
	
</style>
