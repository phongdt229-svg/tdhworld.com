(function ($) {
    "use strict";
    $(document).ready(function () {
		$( ".arrowpress-container" ).each(function( index ) { 
		  	if ($(this).attr('data-max-width')) {
		  		var mwidth=$(this).attr('data-max-width')+'px';
		  		$(this).css("max-width",mwidth);
			}
		}); 
		var target = $('.arrowpress-heading').data("arrowpress-target");   	
    	var tablet = $('.'+target).data("arrowpress-responsive-tablet");
    	var desktop = $('.'+desktop).data("arrowpress-responsive-desktop");
    	var tablet_port = $('.'+target).data("arrowpress-responsive-tablet-port");
    	var mobile_land = $('.'+target).data("arrowpress-responsive-mob-land");
    	var mobile = $('.'+target).data("arrowpress-responsive-mob");
    	var csstarget = $('.'+target+' '+$('.arrowpress-heading').data("arrowpress-csstarget"));
    	var styles = {};
    	var stylesmob = {};
    	function apr_responsive(){
			if(window.matchMedia('(max-width: 2000px)').matches){
	    		$.each(desktop, function(index, val) {   
					styles[index] = val;   			
				});		
			    $(csstarget).css(styles);			
	    	}	     	    		
	    	if(window.matchMedia('(max-width: 1199px)').matches){
	    		$.each(tablet, function(index, val) {   
					styles[index] = val;   			
				});		
			    $(csstarget).css(styles);			
	    	}
	    	if(window.matchMedia('(max-width: 991px)').matches){
	    		$.each(tablet_port, function(index, val) {   
					styles[index] = val;   			
				});		
			    $(csstarget).css(styles);			
	    	}	 
	    	if(window.matchMedia('(max-width: 767px)').matches){
	    		$.each(mobile_land, function(index, val) {   
					styles[index] = val;   			
				});	
			    $(csstarget).css(styles);			
	    	}	 
	    	if(window.matchMedia('(max-width: 479px)').matches){
	    		$.each(mobile, function(index, val) {   
					styles[index] = val;   			
				});
			    $(csstarget).css(styles);		
	    	}
	    	if(window.matchMedia('(min-width: 1200px)').matches){
	    		$.each(desktop, function(index, val) {   
					styles[index] = val;   			
				});		
			    $(csstarget).css(styles);			
	    	}	    			    	   	   	
    	}
    	// call on document load
	    apr_responsive();
	    $(window).resize(function(){
	        // call on window resize
	        apr_responsive();
	    });
    });   
})(jQuery);