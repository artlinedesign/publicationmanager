(function( $ ) {
	'use strict';
	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$( window ).load(function() {
        $('.create-toggle').on("click", function(){
        	let form = $(this).siblings();
        	let arrowSpan = $(this).children();
        	console.log(arrowSpan);
        	if($(arrowSpan).hasClass('dashicons-arrow-down-alt2')){
				$(arrowSpan).removeClass('dashicons-arrow-down-alt2');
				$(arrowSpan).addClass('dashicons-arrow-right-alt2');
			}else {
                $(arrowSpan).removeClass('dashicons-arrow-right-alt2');
                $(arrowSpan).addClass('dashicons-arrow-down-alt2');
            }
			$(form).slideToggle();
        });
    });


})( jQuery );
