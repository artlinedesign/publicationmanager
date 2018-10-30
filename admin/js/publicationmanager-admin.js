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

		// Uploading files
		var file_frame = wp.media.;
		var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
		var set_to_post_id = 1; // Set this
		jQuery('.publications-pdf-upload').on('click', function( event ){
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				// Set the post ID to what we want
				file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				// Open frame
				file_frame.open();
				return;
			} else {
				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = set_to_post_id;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Select a image to upload',
				button: {
					text: 'Use this image',
				},
				multiple: false	// Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
				$( '#image_attachment_id' ).val( attachment.id );
				// Restore the main post ID
				wp.media.model.settings.post.id = wp_media_post_id;
			});
			// Finally, open the modal
			file_frame.open();
		});
		// Restore the main ID when the add media button is pressed
		jQuery( 'a.add_media' ).on( 'click', function() {
			wp.media.model.settings.post.id = wp_media_post_id;
		});

    });


})( jQuery );
