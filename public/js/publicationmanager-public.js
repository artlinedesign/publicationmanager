(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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
		renderSiteAmounts();
        $('.publication-pagination-btn').on("click", function(){
			let site = $(this).data('site');
            $.ajax({
                method: "POST",
                url: window.location.pathname,
                data: { publications: site }
            }).done(function( msg ) {
                	let list = $('.publications-list');
                    list.html($(msg).find('.publications-list'));
                    let amount = list.data('site-amount');
                    let maxShown = site === 1 ? 5 : site * 5;
                    let minShown = site === 1 ? 0 : (site * 5) - 5;
					if(amount >= minShown && amount <= maxShown){
						$('#pp-next').hide();
					}else {
						$('#pp-next').show();
					}
                    if(site > 1){
                        $('#pp-prev').show();
					}else {
                        $('#pp-prev').hide();
					}
					$('#pp-prev').data('site', site - 1);
					$('#pp-next').data('site', site + 1);
					renderSiteAmounts(site);
            });
        });

    });

    function renderSiteAmounts(site = 1) {
        let amount = $('.publications-list').data('site-amount');
        let maxPublications = Math.ceil(amount / 5);
        $('#page-indicator').html(site + ' von ' + maxPublications);

    }


})( jQuery );

