/* Off-Canvas Menu */
jQuery( document ).ready(function() {
    jQuery('.navigation-button').sidr({
        name: 'sidr-main',
		side: 'right',
		renaming: false,
		displace: false,
        source: '.main-navigation'
    });
});

/* Masonry */
jQuery('.masonry #main').masonry({
    "gutter": 20,
    columnWidth: 300,
    itemSelector: '.masonry .hentry',
    isFitWidth: true
});

(function($) {
    "use strict"; 
    $(function() {	  
		
		// entry-thumbnail hover effect
		$('.masonry .has-post-thumbnail img').hover(
			function() {
		    	$(this).fadeTo('fast', 0.3);
			}, function() {
				$(this).fadeTo('slow', 1);
		  	}
		);	
 	}); 
}(jQuery));