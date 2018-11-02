<div class="wrap" id="idgallery-page"> 		
	<h2 class="nav-tab-wrapper">
		<span class="plugin-name" style="float:left; padding:5px;"><?php echo esc_html( get_admin_page_title() ); ?></span>
		<a href="" class="nav-tab nav-tab-active">Main Site Settings</a>
	</h2>	
	
	<span id="errornotice"></span>
	
	<h2>Interdirect Theme Settings.</h2> 
 	
	<p>Welcome to the Interdirect theme.</p> 
	<p>This theme has been supplied to you from <a href="http://www.interdirect.co.uk" target="_blank">www.interdirect.co.uk</a>.</p>

	<form action="options.php" method="post"> 
		<?php
		  settings_fields( 'idtheme-settings' );
		  do_settings_sections( 'idtheme-settings' );		  
		?>
		<table class="form-table">  
			<tbody>
				<tr>
					<th scope="row">Install Sitemachine:</th>
					<td>
						<?php if(get_option('idtheme_installsm')!=1){ ?>
							<input type="checkbox" name="idtheme_installsm" value="1">
						<?php }else{ ?>
							<p>The sitemachine pages have been installed</p>
						<?php }?>
					</td>
				</tr>
				<tr>
					<th scope="row">Google Analytic Code:<br><span style="font-size:11px;">This needs to be the UA code</span></th>
					<td><input name="idtheme_googleanalyticscode" style="width:200px; text-align:center;" value="<?php echo esc_attr( get_option('idtheme_googleanalyticscode') ); ?>"></td>
				</tr>	
				<tr>
					<th scope="row">Remove admin bar:</th>
					<td><input type="checkbox" name="idtheme_adminmenu" value="1" <?php checked( 1,  get_option('idtheme_adminmenu'));?>></td>
				</tr>
				<tr>
					<th scope="row">Footer text</th>
					<td><textarea name="idtheme_footertext" style="width:500px; height:200px;"><?php echo esc_attr( get_option('idtheme_footertext') ); ?></textarea></td>
				</tr>	
			</tbody>			
		</table>
		<?php submit_button(); ?>
  </form>
</div><!-- .wrap -->	
	
</div>