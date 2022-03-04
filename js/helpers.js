/* Masonry */

(function($) {
	"use strict";
	$(
		function() {
			$( '#simple-menu' ).sidr(
				{
					timing: 'ease-in-out',
					speed: 100,
					side: 'right',
					renaming: false,
					source: '.main-navigation'
				}
			);

			$( window ).resize(
				function () {
					$.sidr( 'close', 'sidr' );
				}
			);
		}
	);
}(jQuery));
