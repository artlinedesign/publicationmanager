(function( $ ) {
	'use strict';

	console.log("test");


	$( window ).load(function() {
		$('#submit_authors').on('click', function(){
			console.log("clicked");
			let firstname = $('#firstname-input').val();
			let lastname = $('#lastname-input').val();
			$.ajax({
			  url: "admin.php",
			  data: { firstname: firstname, lastname : lastname}
			}).done(function() {
			  $( this ).addClass( "done" );
			});
		});
	});
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

})( jQuery );
