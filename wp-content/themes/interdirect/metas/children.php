<?php wp_nonce_field( "children_meta", "children_nonce" ); ?>
<div class="wrap">		
    <div class="innerContent"> 
		<p style="display:inline-block;">Display a list of child pages?</p>
   		<input type="checkbox" id="showchildren" name="showchildren" value="1" style="display:inline-block;" <?php if(get_post_meta( $post->ID, 'showchildren', true )==1){echo 'checked="checked"';} ?>> 		
    </div>
</div>