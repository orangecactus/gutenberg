<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns# dcterms: http://purl.org/dc/terms/# fb: http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">    
  	<?php wp_head(); ?>
  	<script>window.jQuery || document.write('<script src="/wp-content/themes/interdirect/_global/js/_core/jquery.js"><\/script>')</script>	
</head>

<body class="<?php if(is_front_page()){ echo 'homepage'; }?>">

	<!-- facebook widget -->
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div class="off-canvas-wrap" data-offcanvas="">
        <div class="inner-wrap">
        <!--Div's to wrap whole page for mobile view slide menu--> 

<?php get_template_part( 'includes/inc', 'header' ); ?>