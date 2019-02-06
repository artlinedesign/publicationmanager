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

        if($('.pubs-modul').length > 0) {
            let currentUrl = window.location.href.split('/');
            currentUrl = currentUrl[currentUrl.length-1];
            if (currentUrl.indexOf('publications') === -1) {
                if (currentUrl.indexOf('?') === -1) {
                    history.pushState({}, "publications", "?publications=1");
                } else {
                    history.pushState({}, "publications", "&publications=1");
                }
            }
            $('.pubs-prev-btn, .pubs-cont-btn').on('click', function () {
                let offset = parseInt($(this).data('offset'));
                let site = (offset / 5) + 1;
                let lastSite = parseInt(jQuery('.pubs-last-site-indicator').html());
                if(site <= lastSite){
                    $.post(
                        "http://localhost:8888/wordpress/wp-admin/admin-ajax.php",
                        {
                            'action': 'getPublications',
                            'offset': offset
                        },
                        function (response) {
                            response = response.substring(0, response.length - 1);
                            let pubs = JSON.parse(response);
                            if (0 in pubs) {
                                jQuery('.pubs-modul').empty();
                            }
                            for (let i = 0; i < 5; i++) {
                                if (i in pubs) {
                                    let template = '<div class="pubs-modul-wrapper"><a href="' + pubs[i]["pdf_url"] + '" target="_blank"><img src="https://btp.at/btp-content/uploads/2017/08/pdf_sujet.jpg" alt=""> </a><div class="pub-list"><a href="' + pubs[i]["pdf_url"] + '" target="_blank"> <p class="pub-titel"> ' + pubs[i]["post_title"] + '</p></a><p class="pub-infos">' + pubs[i]["publisher"] + ' ' + pubs[i]["sites"] + ', ' + pubs[i]["year"] + ', ' + pubs[i]["pub_autor"][0]["post_title"] + '</p></div></div>';
                                    jQuery('.pubs-modul').append(template);
                                }
                            }
                            jQuery('.pubs-current-site').html(site);
                            if (offset > 0) {
                                jQuery('.pubs-cont-btn').data('offset', offset + 5);
                                jQuery('.pubs-prev-btn').data('offset', offset - 5);
                            }
                            let pushStateRegex = /publications=[0-9][0-9]*/gi;
                            history.pushState({}, "publications", window.location.href.replace(pushStateRegex, "publications=" + site));

                        });
                }

            });
        }

        if($('.articles-modul').length > 0) {
            let newUrl = window.location.href.split('/');
            newUrl = newUrl[newUrl.length-1];
            if (newUrl.indexOf('articles') === -1) {
                if (newUrl.indexOf('?') === -1) {
                    history.pushState({}, "articles", "?articles=1");
                } else {
                    history.pushState({}, "articles", window.location.href + "&articles=1");
                }
            }

            $('.articles-prev-btn, .articles-cont-btn').on('click', function () {
                let offset = parseInt($(this).data('offset'));
                let site = (offset / 5) + 1;
                let lastSite = parseInt(jQuery('.articles-last-site-indicator').html());
                if(site <= lastSite) {
                    $.post(
                        "http://localhost:8888/wordpress/wp-admin/admin-ajax.php",
                        {
                            'action': 'getArticles',
                            'offset': offset
                        },
                        function (response) {
                            response = response.substring(0, response.length - 1);
                            let articles = JSON.parse(response);
                            if (0 in articles) {
                                jQuery('.articles-modul').empty();
                            }
                            for (let i = 0; i < 5; i++) {
                                if (i in articles) {
                                    let template = '<div class="articles-modul-wrapper"><a href="' + articles[i]["pdf_url"] + '" target="_blank"><img src="https://btp.at/btp-content/uploads/2017/08/pdf_sujet.jpg" alt=""> </a><div class="articles-list"><a href="' + articles[i]["pdf_url"] + '" target="_blank"> <p class="articles-titel"> ' + articles[i]["post_title"] + '</p></a><p class="articles-infos">' + articles[i]["articleslisher"] + ' ' + articles[i]["sites"] + ', ' + articles[i]["year"] + ', ' + articles[i]["autor"] + '</p></div></div>';
                                    jQuery('.articles-modul').append(template);
                                }
                            }
                            jQuery('.articles-current-site').html(site);
                            if (offset > 0) {
                                jQuery('.articles-cont-btn').data('offset', offset + 5);
                                jQuery('.articles-prev-btn').data('offset', offset - 5);
                            }
                            let pushStateRegex = /articles=[0-9][0-9]*/gi;
                            history.pushState({}, "articles", window.location.href.replace(pushStateRegex, "articles=" + site));
                        });
                }
            });
        }


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


