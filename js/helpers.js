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
		$('#simple-menu').sidr({
			timing: 'ease-in-out',
			speed: 100,
			side: 'right',
			renaming: false,
			source: '.main-navigation'
		});

		$( window ).resize(function () {
		  $.sidr('close', 'sidr');
		});		
	}); 
}(jQuery));