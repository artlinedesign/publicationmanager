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
        let currentUrl = window.location.href.split('/');
        currentUrl = currentUrl[currentUrl.length-1];
		if($('.publications-viewer').length > 0){
		    if(currentUrl.indexOf('publications') === -1){
                if(currentUrl.indexOf('?') === -1){
                    history.pushState({}, "publications", "?publications=1");
                }else {
                    history.pushState({}, "publications", "&publications=1");
                }
            }
            $('.publication-pagination-btn').on("click", function(){
                let site = $(this).data('site');
                $.ajax({
                    method: "POST",
                    url: window.location.pathname,
                    data: { publications: site }
                }).done(function( msg ) {
                    let viewer = $('.publications-list-wrapper');
                    viewer.html($(msg).find('.publications-list'));
                    let amount = viewer.data('site-amount');
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
                    renderPublicationsAmount(site);
                    let pushStateRegex = /publications=[0-9][0-9]*/gi;
                    history.pushState({}, "publications", window.location.href.replace( pushStateRegex, "publications=" + site));

                });
            });
        }

        if($('.articles-viewer').length > 0) {
            let newUrl = window.location.href.split('/');
            newUrl = newUrl[newUrl.length-1];
            if(newUrl.indexOf('articles') === -1){
                if(newUrl.indexOf('?') === -1){
                    history.pushState({}, "articles", "?articles=1");
                }else {
                    history.pushState({}, "articles", window.location.href + "&articles=1");
                }
            }
            $('.article-pagination-btn').on("click", function () {
                let site = $(this).data('site');
                $.ajax({
                    method: "POST",
                    url: window.location.pathname,
                    data: {articles: site}
                }).done(function (msg) {
                    let list = $('.articles-list');
                    list.html($(msg).find('.articles-list'));
                    let amount = list.data('site-amount');
                    let maxShown = site === 1 ? 5 : site * 5;
                    let minShown = site === 1 ? 0 : (site * 5) - 5;
                    if (amount >= minShown && amount <= maxShown) {
                        $('#ap-next').hide();
                    } else {
                        $('#ap-next').show();
                    }
                    if (site > 1) {
                        $('#ap-prev').show();
                    } else {
                        $('#ap-prev').hide();
                    }
                    $('#ap-prev').data('site', site - 1);
                    $('#ap-next').data('site', site + 1);
                    renderArticlesAmount(site);
                    let pushStateRegex = /articles=[0-9][0-9]*/gi;
                    history.pushState({}, "articles", window.location.href.replace( pushStateRegex, "articles=" + site));
                });
            });
        }
    });

    function renderPublicationsAmount(site = 1) {
        let amountPublications = $('.publications-list').data('site-amount');
        let maxPublications = Math.ceil(amountPublications / 5);
        $('#publications-page-indicator').html(site + ' von ' + maxPublications);

    }
    function renderArticlesAmount(site = 1) {
        let amountArticles = $('.articles-list').data('site-amount');
        let maxArticles = Math.ceil(amountArticles / 5);
        $('#articles-page-indicator').html(site + ' von ' + maxArticles);

    }


})( jQuery );
