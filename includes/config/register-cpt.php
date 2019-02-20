<?php

/**
 * Register custom post type
 *
 * Lawyers
 * @name	Anwälte
 * @type    lawyers
 * @slug	lawyers
 */

function registerLawyer() {
	$labels = array(
		'name'               => _x( 'Anwälte', 'post type general name', 'publicationmanager' ),
		'singular_name'      => _x( 'Anwalt', 'post type singular name', 'publicationmanager' ),
		'menu_name'          => _x( 'Anwälte', 'admin menu', 'publicationmanager' ),
		'name_admin_bar'     => _x( 'Anwalt', 'Hinzufügen on admin bar', 'publicationmanager' ),
		'add_new'            => _x( 'Hinzufügen', 'Anwalt', 'publicationmanager' ),
		'add_new_item'       => __( 'Anwalt anlegen', 'publicationmanager' ),
		'new_item'           => __( 'Neuer Anwalt', 'publicationmanager' ),
		'edit_item'          => __( 'Anwalt bearbeiten', 'publicationmanager' ),
		'view_item'          => __( 'Anwalt ansehen', 'publicationmanager' ),
		'all_items'          => __( 'Alle Anwälte', 'publicationmanager' ),
		'search_items'       => __( 'Suche Anwälte', 'publicationmanager' ),
		'parent_item_colon'  => __( 'Parent Anwälte:', 'publicationmanager' ),
		'not_found'          => __( 'Keine Anwälte gefunde.', 'publicationmanager' ),
		'not_found_in_trash' => __( 'Keine Anwälte im Papierkorb gefunden.', 'publicationmanager' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false, //<--- HERE
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'lawyers' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes')
	);

	register_post_type( 'lawyers', $args );
}

add_action( 'init', 'registerLawyer' );


/**
 * Register custom post type
 *
 * Books
 * @name	Books
 * @type    books
 * @slug	books
 */
function registerBooks() {
	$labels = array(
		'name'               => _x( 'Books', 'post type general name', 'publicationmanager' ),
		'singular_name'      => _x( 'Book', 'post type singular name', 'publicationmanager' ),
		'menu_name'          => _x( 'Books', 'admin menu', 'publicationmanager' ),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'publicationmanager' ),
		'add_new'            => _x( 'Add New', 'Book', 'publicationmanager' ),
		'add_new_item'       => __( 'Add New Book', 'publicationmanager' ),
		'new_item'           => __( 'New Book', 'publicationmanager' ),
		'edit_item'          => __( 'Edit Book', 'publicationmanager' ),
		'view_item'          => __( 'View Book', 'publicationmanager' ),
		'all_items'          => __( 'All Books', 'publicationmanager' ),
		'search_items'       => __( 'Search Books', 'publicationmanager' ),
		'parent_item_colon'  => __( 'Parent Books:', 'publicationmanager' ),
		'not_found'          => __( 'No Books found.', 'publicationmanager' ),
		'not_found_in_trash' => __( 'No Books found in Trash.', 'publicationmanager' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false, //<--- HERE
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'books' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'thumbnail' )
	);

	register_post_type( 'books', $args );
}

add_action( 'init', 'registerBooks' );



/**
 * Register custom post type
 *
 * Publications
 * @name	Publications
 * @type    publicaitons
 * @slug	publications
 */
function registerPublications() {
	$labels = array(
		'name'               => _x( 'Publications', 'post type general name', 'publicationmanager' ),
		'singular_name'      => _x( 'Publication', 'post type singular name', 'publicationmanager' ),
		'menu_name'          => _x( 'Publications', 'admin menu', 'publicationmanager' ),
		'name_admin_bar'     => _x( 'Publication', 'add new on admin bar', 'publicationmanager' ),
		'add_new'            => _x( 'Add New', 'Publication', 'publicationmanager' ),
		'add_new_item'       => __( 'Add New Publication', 'publicationmanager' ),
		'new_item'           => __( 'New Publication', 'publicationmanager' ),
		'edit_item'          => __( 'Edit Publication', 'publicationmanager' ),
		'view_item'          => __( 'View Publication', 'publicationmanager' ),
		'all_items'          => __( 'All Publications', 'publicationmanager' ),
		'search_items'       => __( 'Search Publications', 'publicationmanager' ),
		'parent_item_colon'  => __( 'Parent Publications:', 'publicationmanager' ),
		'not_found'          => __( 'No Publications found.', 'publicationmanager' ),
		'not_found_in_trash' => __( 'No Publications found in Trash.', 'publicationmanager' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false, //<--- HERE
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'publications' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'publications', $args );
}

add_action( 'init', 'registerPublications' );

/**
 * Register custom post type
 *
 * Articles
 * @name	Articles
 * @type    articles
 * @slug	articles
 */
function registerArticles() {
	$labels = array(
		'name'               => _x( 'Articles', 'post type general name', 'publicationmanager' ),
		'singular_name'      => _x( 'Article', 'post type singular name', 'publicationmanager' ),
		'menu_name'          => _x( 'Articles', 'admin menu', 'publicationmanager' ),
		'name_admin_bar'     => _x( 'Article', 'add new on admin bar', 'publicationmanager' ),
		'add_new'            => _x( 'Add New', 'Article', 'publicationmanager' ),
		'add_new_item'       => __( 'Add New Article', 'publicationmanager' ),
		'new_item'           => __( 'New Article', 'publicationmanager' ),
		'edit_item'          => __( 'Edit Article', 'publicationmanager' ),
		'view_item'          => __( 'View Article', 'publicationmanager' ),
		'all_items'          => __( 'All Articles', 'publicationmanager' ),
		'search_items'       => __( 'Search Articles', 'publicationmanager' ),
		'parent_item_colon'  => __( 'Parent Articles:', 'publicationmanager' ),
		'not_found'          => __( 'No Articles found.', 'publicationmanager' ),
		'not_found_in_trash' => __( 'No Articles found in Trash.', 'publicationmanager' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false, //<--- HERE
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'articles' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);

	register_post_type( 'articles', $args );
}

add_action( 'init', 'registerArticles' );

/**
 * Register custom post type
 *
 * Publisher
 * @name	Publisher
 * @type    publisher
 * @slug	publisher
 */
function registerPublisher() {
	$labels = array(
		'name'               => _x( 'Publishers', 'post type general name', 'publicationmanager' ),
		'singular_name'      => _x( 'Publisher', 'post type singular name', 'publicationmanager' ),
		'menu_name'          => _x( 'Publishers', 'admin menu', 'publicationmanager' ),
		'name_admin_bar'     => _x( 'Publisher', 'add new on admin bar', 'publicationmanager' ),
		'add_new'            => _x( 'Add New', 'Publisher', 'publicationmanager' ),
		'add_new_item'       => __( 'Add New Publisher', 'publicationmanager' ),
		'new_item'           => __( 'New Publisher', 'publicationmanager' ),
		'edit_item'          => __( 'Edit Publisher', 'publicationmanager' ),
		'view_item'          => __( 'View Publisher', 'publicationmanager' ),
		'all_items'          => __( 'All Publishers', 'publicationmanager' ),
		'search_items'       => __( 'Search Publishers', 'publicationmanager' ),
		'parent_item_colon'  => __( 'Parent Publishers:', 'publicationmanager' ),
		'not_found'          => __( 'No Publishers found.', 'publicationmanager' ),
		'not_found_in_trash' => __( 'No Publishers found in Trash.', 'publicationmanager' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false, //<--- HERE
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'publisher' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor' )
	);

	register_post_type( 'publisher', $args );
}

add_action( 'init', 'registerPublisher' );








// add_action ('init', 'booksField');



// ADD CUSTOM POST TYPE TAXONOMIES
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: books.
	 */

	$labels = array(
		"name" => __( "books", "Avada" ),
		"singular_name" => __( "book", "Avada" ),
	);

	$args = array(
		"label" => __( "books", "Avada" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'books', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "books",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "books", array( "books" ), $args );

	/**
	 * Taxonomy: Verläge.
	 */

	$labels = array(
		"name" => __( "Verläge", "Avada" ),
		"singular_name" => __( "verlag", "Avada" ),
	);

	$args = array(
		"label" => __( "Verläge", "Avada" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'verlag', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "verlag",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "verlag", array( "publisher" ), $args );

	/**
	 * Taxonomy: Artikeln.
	 */

	$labels = array(
		"name" => __( "Artikeln", "Avada" ),
		"singular_name" => __( "Artikel", "Avada" ),
	);

	$args = array(
		"label" => __( "Artikeln", "Avada" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'articles', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "articles",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "articles", array( "articles" ), $args );

	/**
	 * Taxonomy: Bücherkategorien.
	 */

	$labels = array(
		"name" => __( "Bücherkategorien", "Avada" ),
		"singular_name" => __( "Bücherkategorie", "Avada" ),
	);

	$args = array(
		"label" => __( "Bücherkategorien", "Avada" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'books_category', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "books_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "books_category", array( "books" ), $args );

	/**
	 * Taxonomy: Anwälte-Position.
	 */

	$labels = array(
		"name" => __( "Anwälte-Position", "Avada" ),
		"singular_name" => __( "Anwalt-Position", "Avada" ),
	);

	$args = array(
		"label" => __( "Anwälte-Position", "Avada" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'anwalt_position', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "anwalt_position",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		);
	register_taxonomy( "anwalt_position", array( "lawyers" ), $args );

	/**
	 * Taxonomy: Fachgebiete.
	 */

	$labels = array(
		"name" => __( "Fachgebiete", "Avada" ),
		"singular_name" => __( "Fachgebiet", "Avada" ),
	);

	$args = array(
		"label" => __( "Fachgebiete", "Avada" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'fachgebiet_anwalt', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "fachgebiet_anwalt",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		);
	register_taxonomy( "fachgebiet_anwalt", array( "lawyers" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
