<div id="loader" style="display:none">
	<div id="overlay">
		<div class="sk-cube-grid">
		  <div class="sk-cube sk-cube1"></div>
		  <div class="sk-cube sk-cube2"></div>
		  <div class="sk-cube sk-cube3"></div>
		  <div class="sk-cube sk-cube4"></div>
		  <div class="sk-cube sk-cube5"></div>
		  <div class="sk-cube sk-cube6"></div>
		  <div class="sk-cube sk-cube7"></div>
		  <div class="sk-cube sk-cube8"></div>
		  <div class="sk-cube sk-cube9"></div>
		</div>
	</div>
</div>

<script>	
	function create(htmlStr) {
		var frag = document.createDocumentFragment(),
			temp = document.createElement('div');
		temp.innerHTML = htmlStr;
		while (temp.firstChild) {
			frag.appendChild(temp.firstChild);
		}
		return frag;
	}
	var loader = document.getElementById('loader');
	var fragment = create(loader.innerHTML);
	document.getElementById('wpwrap').insertBefore(fragment, document.getElementById('wpwrap').childNodes[0]);
	loader.parentNode.removeChild(loader);
</script>


<?php wp_nonce_field( "summary_meta", "summary_nonce" ); ?>
<div class="wrap">	
	<h3>Page Summary Text:</h3>
	<p>Add a page summary to this page below:</p>
    <div class="innerContent"> 
   		<textarea id="pageSummary" name="pageSummary" value="" style="width:100%;" rows="4"><?php echo esc_attr( get_post_meta( $post->ID, 'pageSummary', true ) ); ?></textarea>       		
    </div>
</div>