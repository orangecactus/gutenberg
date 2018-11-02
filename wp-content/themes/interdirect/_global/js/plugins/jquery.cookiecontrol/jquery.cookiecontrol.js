//	Plugin			CookieControl 
//	Date Created	30/04/2012
//	Developed		Tom Jenkins
//	Version			1.0.2
//	Comment			Designed to pop up a message to check for cookie 5acceptance. If granted then injects google analytics
//					into the DOM and sets a persistent cookie to check against in future requests. If declined sets a 
//					session based cookie to check against in future requests.
//
//  Options			gaNumber		:	your google analytic tracking number
//					cookieName		:	name for the cookie that is set
//					message			:	message that is set in the top banner
//					moreInfo		:	text that is used within the more information drop down
//					expires			:	number of days before the persistent cookie expires
//					control			:	the name of the control panel variable that you wish get the value for. Options are: social, anal, advert
//					showOnce		:	set to 1 to only show the cookie bar on intial page load.

;(function($){
	
		var methods = {
		init: function(options){
            //set initial options				
            var settings = $.extend({
                'gaNumber'		: '', 
                'cookieName'	: 'cookieAccept',
                'message'		: 'This site uses cookies to enhance your user experience. If you continue without changing your settings, we\'ll assume that you are happy to receive all cookies.',
                'moreInfo'		: 'Cookies are files stored in both your browser and on your machine and are used by websites to help personalise your web experience. Some features on this website will not function correctly if you do not allow persistent cookies to be used. No personal data is stored in these cookies.<br/><br/>Click <b>CONTINUE</b> to  carry on using these cookies or <a href="/Cookie-Control" class="cookieControlPanel">click here to adjust your cookie settings</a>. For further information about the cookies used on this website read our <a href="/information/privacy-policy">Privacy Policy</a>.',
				'expires'		: 365,
				'control'		: '',
				'showOnce'		: true
            }, options);
            
			return this.each(function(){
	            //Check for cookie and value
	            if (!methods.cookieCheck(settings)) {	               
	                methods.htmlCreate(settings, $(this));
					if(settings.showOnce){
						methods.setCookie(settings, 1, settings.expires);  
					}
	            }
				//if cookie control isnt used or analytics is set to be on				
				if(methods.controlOptions({cookieName: 'COOKIECONTROL', control:'anal'})==1){
					methods.createGoogle(settings);
				}else{	
					//if not delete all the google cookies		
					var dom=document.domain.replace(/www/gi, "");		
					if(methods.cookieCheck({cookieName: '__utma'})){document.cookie = "__utma" + "=; expires=" + new Date() + "; domain=" + dom + "; path=/";}
					if(methods.cookieCheck({cookieName: '__utmb'})){document.cookie = "__utmb" + "=; expires=" + new Date() + "; domain=" + dom + "; path=/";}
					if(methods.cookieCheck({cookieName: '__utmc'})){document.cookie = "__utmc" + "=; expires=" + new Date() + "; domain=" + dom + "; path=/";}
					if(methods.cookieCheck({cookieName: '__utmv'})){document.cookie = "__utmv" + "=; expires=" + new Date() + "; domain=" + dom + "; path=/";}						
					if(methods.cookieCheck({cookieName: '__utmz'})){document.cookie = "__utmz" + "=; expires=" + new Date() + "; domain=" + dom + "; path=/";}						
				}				
			});
			
		},
		
		controlOptions: function(settings){						
			var exists=methods.cookieCheck({
				cookieName: 'COOKIECONTROL'
			});			
			if(exists){				
				var i, x, y, cookie = methods.getCookie({cookieName: 'COOKIECONTROL'});				
				var controls = cookie.split(":::");				
				for (i = 0; i < controls.length; i++) {							
	                x = controls[i].substr(0, controls[i].indexOf("="));
	                y = controls[i].substr(controls[i].indexOf("=") + 1);
	                x = x.replace(/^\s+|\s+$/g, "");					
					if (x == settings.control) {						
						return unescape(y);
					}				
				}
				return 1;		
			}else{
				//CookieControl cookie does not exists so show everything anyway (implied consent)			
				return 1;	
			}					
		},
        
        cookieCheck: function(settings){
            //Check to see if cookie exists
            return document.cookie.indexOf(settings.cookieName) < 0 ? false : true;
        },
        
        getCookie: function(settings){
            //Select cookie against the name provided
            var i, x, y, ARRcookies = document.cookie.split(";");
            for (i = 0; i < ARRcookies.length; i++) {
                x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
                y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
                x = x.replace(/^\s+|\s+$/g, "");
                if (x == settings.cookieName) {
                    return unescape(y);
                }
            }
            
        },
        
        setCookie: function(settings, result, expires){
            //Set intial session based cookie					
            if(expires){
                //if expiry is set then update said cookie with 3 day expiry
                var today = new Date();
                var expr = new Date(today.getTime() + expires * 24 * 60 * 60 * 1000);
                document.cookie = settings.cookieName + '=' + result + "; expires=" + expr.toGMTString() + "; path=/;";
            }else{
                document.cookie = settings.cookieName + '=' + result + "; path=/;";
            }
        },
        
        htmlCreate: function(settings, element){
            //Add the basic HTML
            element.prepend('<div class="cookieQuestion" id="cookieContainer"><div class="cookieMessage"><div class="cookieButtons"><a href="" id="cookieAccept">CONTINUE</a></div>' + settings.message + ' <a href="" id="cookieMoreInfo">Read more</a></div><div class="cookieInfo">' + settings.moreInfo + '</div></div>');
            //Add some perzazz to the container
            var $cookieContainer = $('#cookieContainer');
            $cookieContainer.animate({
                top: 0
            }, 1000);
			//Get height of more info window
			var $cookieInfo=$('.cookieInfo');
			var $height=$cookieInfo.outerHeight(true);
			$cookieInfo.css({top:-$height})	;
            //Add the click event to the more info window
			$('#cookieMoreInfo').click(function(e){
				if(parseInt($cookieInfo.css('top'), 10)===0){ 
					$cookieInfo.animate({top:-$height});
				}else{
					$cookieInfo.animate({top:0});
				}				
                e.preventDefault();
            });
            //Cookie accept click event
            $('#cookieAccept').click(function(e){
                methods.setCookie(settings, 1, settings.expires);               
                methods.htmlDelete(settings, $cookieContainer);
				e.preventDefault();
            });
        },
        
        htmlDelete: function(settings, container){
            //After decision remove the container
            container.animate({
                top: '-40px'
            }, function(){
                container.remove();
            });
        },
        
        createGoogle: function(settings){
            //Create and add the Google Analytics code
            $.getScript('//www.google-analytics.com/analytics.js', function(){                
                ga('create', settings.gaNumber, 'auto');
                ga('require', 'displayfeatures');
                ga('send', 'pageview', location.pathname + location.search + location.hash);
            });
        }		
		
    };
    
    $.fn.cookieControl = function(method){
        // Method calling logic
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }else{
            if (typeof method === 'object' || !method) {
                return methods.init.apply(this, arguments);
            }else{
                $.error('Method ' + method + ' does not exist on jQuery.cookieControl');
            }
       }
    };
    
})(jQuery);