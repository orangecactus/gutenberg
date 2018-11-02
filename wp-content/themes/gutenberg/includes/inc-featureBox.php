<?php


	$sql = "SELECT B.* FROM id_action_pages A
			LEFT JOIN id_action B
			ON A.actionid = B.id
			WHERE postid = " . $post->ID . "
			AND visible = 1
			AND 
				(
					year(activefrom) = 1970
				OR
					NOW() BETWEEN activefrom AND activeto
				)
			ORDER BY displayorder ASC";	
	$actions = $wpdb->get_results($sql, OBJECT);
	

?>

<div class="row">
	<?php $p = get_post(); ?>
    <ul id="homeFeature" class="small-12">
        <?php foreach($actions as $action){ ?>	
        <li class="small-12 medium-4 columns">
            <a href="<?php echo $action->button;?>" title="">   
                <div class="featureImage">
                    <div class="overlay"></div>
                    <img src="<?php echo $action->imagename; ?>" alt=""/>
                </div>
                <h4><?php echo $action->title;?></h4>
                <p><?php echo wp_trim_words($action->description,15)?>... </p> 
                <div class="featureArrow">
                    <i class="fa fa-angle-right"></i>
                </div>                      
            </a>
        </li>
        <?php } ?>
    </ul>   
</div>
