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

        if($('.notice.notice-success').length > 0 ){
            setTimeout(function(){
                $('.notice.notice-success').fadeOut("slow");
            },2000);
        }

        $('.create-toggle').on("click", function(){
        	let form = $(this).siblings();
        	let arrowSpan = $(this).children();
        	if($(arrowSpan).hasClass('dashicons-arrow-down-alt2')){
				$(arrowSpan).removeClass('dashicons-arrow-down-alt2');
				$(arrowSpan).addClass('dashicons-arrow-right-alt2');
			}else {
                $(arrowSpan).removeClass('dashicons-arrow-right-alt2');
                $(arrowSpan).addClass('dashicons-arrow-down-alt2');
            }
			$(form).slideToggle();
        });




				$('.file_upload_button').on('click', function( event ){
					var uploadBtn = $(event.currentTarget);
					var file_frame;
					var wp_media_post_id = wp.media.model.settings.post.id;
					var set_to_post_id = uploadBtn.attr('id');
					event.preventDefault();

					if ( file_frame ) {
						file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
						file_frame.open();
						return;
					} else {
						wp.media.model.settings.post.id = set_to_post_id;
					}

					file_frame = wp.media.frames.file_frame = wp.media({
						title: $(uploadBtn).hasClass('img-prev') ? 'Select image' : 'Select PDF',
						button: {
							text: $(uploadBtn).hasClass('img-prev') ? 'Use this image' : 'Use this file',
						},
                        library: {
                            type: $(uploadBtn).hasClass('img-prev') ? 'image/jpeg' : 'application/pdf'
                        },
						multiple: false
					});

					file_frame.on( 'select', function() {
						var attachment = file_frame.state().get('selection').first().toJSON();
						if($(uploadBtn).hasClass('img-prev')){
							$(uploadBtn).siblings('.image-preview-wrapper').find('img').attr( 'src', attachment.url ).css( 'width', 'auto' );
						}else {
							$(uploadBtn).val(attachment.filename);
						}
						$(uploadBtn).siblings('.url_value').val( attachment.url );

						wp.media.model.settings.post.id = wp_media_post_id;
					});

						file_frame.open();
				});

				jQuery( 'a.add_media' ).on( 'click', function() {
					wp.media.model.settings.post.id = wp_media_post_id;
				});
    });



})( jQuery );
