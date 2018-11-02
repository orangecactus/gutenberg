jQuery.fn.extend({
	
	
	charCount: function(options){					
		var settings	= jQuery.extend({
            'maxCount'		: 100,					//Maximum Count of characters
			'stopOnMax'		: false,				//To disallow any more chars being entered
			'counterElm'	: ''					//Element which has the counter in
        }, options);			
		var $this		= this;
		var $counter	= settings.counterElm;
		var methods = {						
			init: function(){
				methods.count();				
				$this.keyup(function(e){						
					methods.count();				
				});								
			},
			count: function(){
				var l = $this.val().length;
				var n = settings.maxCount - l;				
				if(n<0){					
					if(settings.stopOnMax){						
						$this[0].value=$this[0].value.substring(0, settings.maxCount); 
						return false;
					}else{
						$counter.css({color:'red'});
					}					
				}else{
					$counter.css({color:''});
				}							
				$counter.html(n);	
			}					
		};								
		methods.init();	
	}	
	
	
	
});// JavaScript Document