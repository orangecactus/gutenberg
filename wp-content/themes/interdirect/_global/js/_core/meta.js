jQuery(function($){		
	var $metaboxcontainer 		= $('form.metabox-location-normal').find('#postbox-container-2');	
	if($metaboxcontainer.length>0){
		var $metaboxes				= $metaboxcontainer.find('div.postbox');
		html = '<ul>';
		for(i=0;i<$metaboxes.length;i++){
			var $metabox 	= $metaboxes.eq(i);
			var $h2 		= $metabox.find('h2:first');
			html += '<li><a href="#' + $metabox.attr('id') + '">' + $h2.html() + '</a></li>';
			$h2.remove();
			
		}
		html += '</ul>';
	
		$metaboxcontainer.prepend(html);		
		$('#normal-sortables').contents().unwrap();		
		$metaboxcontainer.tabs({create: function(event, ui) {			
				
		}});	
		
		setTimeout(function(){			
			for(i=0;i<$metaboxes.length;i++){
				if(i>0){
					$metabox.hide();
				}
			}
			$('#overlay').fadeOut('slow',function(){
				$(this).remove();	
			});	
		},50);



	}
});



