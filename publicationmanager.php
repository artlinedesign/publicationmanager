<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.artline-design.at
 * @since             1.0.0
 * @package           Publicationmanager
 *
 * @wordpress-plugin
 * Plugin Name:       Publication Manager v2
 * Plugin URI:        https://www.artline-design.at
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ARTLINE Design
 * Author URI:        https://www.artline-design.at
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       publicationmanager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-publicationmanager-activator.php
 */
function activate_publicationmanager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-publicationmanager-activator.php';
	Publicationmanager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-publicationmanager-deactivator.php
 */
function deactivate_publicationmanager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-publicationmanager-deactivator.php';
	Publicationmanager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_publicationmanager' );
register_deactivation_hook( __FILE__, 'deactivate_publicationmanager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-publicationmanager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_publicationmanager() {

	$plugin = new Publicationmanager();
	$plugin->run();

}
run_publicationmanager();


//  #### NEW
//  ###
//	###



// Add Plugin into Admin Menu


add_action('admin_menu', 'publicationmanager');



function publicationmanager(){
	add_menu_page('CM', 'CM', 'manage_options', 'cm', 'init', 'dashicons-portfolio', 65);
	add_submenu_page('cm', 'Anwälte', 'Anwälte', 'manage_options', 'edit.php?post_type=lawyers', NULL );
	add_submenu_page('cm', 'Bücher', 'Bücher', 'manage_options', 'edit.php?post_type=books', NULL );
	add_submenu_page('cm', 'Publikationen', 'Publikationen', 'manage_options', 'edit.php?post_type=publications', NULL );
	add_submenu_page('cm', 'Beiträge', 'Beiträge', 'manage_options', 'edit.php?post_type=articles', NULL );
	add_submenu_page('cm', 'Verläge', 'Verläge', 'manage_options', 'edit.php?post_type=publisher', NULL );
}



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






add_action ('init', 'booksField');



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
}
add_action( 'init', 'cptui_register_my_taxes' );







if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5c18dbb5789aa',
		'title' => 'Anwalt',
		'fields' => array(
			array(
				'key' => 'field_5c36f82db1f08',
				'label' => 'Portrait',
				'name' => 'portrait',
				'type' => 'image',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => 800,
				'max_height' => 800,
				'max_size' => '0.5',
				'mime_types' => 'jpg, png',
			),
			array(
				'key' => 'field_5c18dbc429026',
				'label' => 'Akademischer Titel vorangestellt',
				'name' => 'akademischer_titel',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => 50,
			),
			array(
				'key' => 'field_5c18dbf529027',
				'label' => 'Vorname',
				'name' => 'vorname',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => 110,
			),
			array(
				'key' => 'field_5c372895ce119',
				'label' => 'Nachname',
				'name' => 'nachname',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => 110,
			),
			array(
				'key' => 'field_5c18dc3b29028',
				'label' => 'Titel nachgestellt',
				'name' => 'titel_nachgestellt',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => 80,
			),
			array(
				'key' => 'field_5c36e7fc73cf6',
				'label' => 'Position',
				'name' => 'position',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'anwalt_position',
				'field_type' => 'radio',
				'allow_null' => 0,
				'add_term' => 1,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'object',
				'multiple' => 0,
			),
			array(
				'key' => 'field_5c36e87b73cf7',
				'label' => 'Fachgebiet',
				'name' => 'fachgebiet',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'Kapitalmarktrecht' => 'Kapitalmarktrecht',
					'Bank-, Versicherungs- und Wertpapieraufsichtsrecht' => 'Bank-, Versicherungs- und Wertpapieraufsichtsrecht',
					'M&A/Unternehmensrecht' => 'M&A/Unternehmensrecht',
					'Wirtschaftsstrafrecht' => 'Wirtschaftsstrafrecht',
					'Prozessführung und Schiedsverfahren' => 'Prozessführung und Schiedsverfahren',
					'Glücksspiel-, Europa und E-Commerce Recht' => 'Glücksspiel-, Europa und E-Commerce Recht',
					'Compliance' => 'Compliance',
				),
				'default_value' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 1,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5c36ebdbc8d8a',
				'label' => 'Lebenslauf',
				'name' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5c36f59311130',
				'label' => 'Intro',
				'name' => 'intro',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_5c36f5b811131',
				'label' => 'Berufserfahrung',
				'name' => 'berufserfahrung',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 3,
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_5c36f5d911132',
				'label' => 'Studium & Ausbildung',
				'name' => 'studium_&_ausbildung',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 2,
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_5c36f64393625',
				'label' => 'Sonstiges',
				'name' => 'sonstiges',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c36f3703a519',
				'label' => 'E-Mail',
				'name' => 'e-mail',
				'type' => 'email',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c36f3913a51a',
				'label' => 'Backoffice',
				'name' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5c36f3f63a51b',
				'label' => 'Backoffice Name',
				'name' => 'backoffice_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c36f43c9d915',
				'label' => 'Backoffice E-Mail',
				'name' => 'backoffice_e-mail',
				'type' => 'email',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c36f4679d917',
				'label' => 'Backoffice Name 2',
				'name' => 'backoffice_name_2',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c36f4759d918',
				'label' => 'Backoffice E-Mail 2',
				'name' => 'backoffice_e-mail_2',
				'type' => 'email',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c372df126753',
				'label' => 'Publikationen',
				'name' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5c372d173de01',
				'label' => 'Bücher',
				'name' => 'buecher',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'books',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'lawyers',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
			1 => 'excerpt',
			2 => 'discussion',
			3 => 'comments',
			4 => 'author',
			5 => 'page_attributes',
			6 => 'categories',
			7 => 'tags',
			8 => 'send-trackbacks',
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5c177bb26cfaa',
		'title' => 'Beitrag',
		'fields' => array(
			array(
				'key' => 'field_5c177bc5026a7',
				'label' => 'Titel',
				'name' => 'article_titel',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c177bd2026a8',
				'label' => 'Autor',
				'name' => 'article_autor',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c177bed026a9',
				'label' => 'Jahr',
				'name' => 'article_jahr',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'articles',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'permalink',
			1 => 'the_content',
			2 => 'excerpt',
			3 => 'discussion',
			4 => 'comments',
			5 => 'revisions',
			6 => 'slug',
			7 => 'author',
			8 => 'format',
			9 => 'page_attributes',
			10 => 'featured_image',
			11 => 'categories',
			12 => 'tags',
			13 => 'send-trackbacks',
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5c1130561f94d',
		'title' => 'Buch',
		'fields' => array(
			array(
				'key' => 'field_5c11305c5cf0b',
				'label' => 'Buchtitel',
				'name' => 'buch_titel',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c127b17da4d3',
				'label' => 'Auflage / Band',
				'name' => 'buch_auflage',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c127b35da4d4',
				'label' => 'Verlag',
				'name' => 'buch_verlag',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c127b3fda4d5',
				'label' => 'Autor',
				'name' => 'buch_autor',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'lawyers',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
			array(
				'key' => 'field_5c128a27411ce',
				'label' => 'Titelbild',
				'name' => 'buch_bild',
				'type' => 'image',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5c37276b20057',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'books',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
			1 => 'excerpt',
			2 => 'discussion',
			3 => 'comments',
			4 => 'slug',
			5 => 'author',
			6 => 'send-trackbacks',
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5c1767c84d0d8',
		'title' => 'Publikation',
		'fields' => array(
			array(
				'key' => 'field_5c1767d2320a4',
				'label' => 'Titel',
				'name' => 'pub_titel',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c1767e2320a5',
				'label' => 'Autor',
				'name' => 'pub_autor',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'lawyers',
				),
				'taxonomy' => '',
				'filters' => '',
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
			array(
				'key' => 'field_5c1767fd320a6',
				'label' => 'Herausgeber',
				'name' => 'pub_herausgeber',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c17680f320a7',
				'label' => 'Seite',
				'name' => 'pub_seite',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c176821320a8',
				'label' => 'Jahr',
				'name' => 'pub_jahr',
				'type' => 'number',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_5c3751d64ba71',
				'label' => 'PDF',
				'name' => 'pdf_pub',
				'type' => 'file',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'library' => 'all',
				'min_size' => '',
				'max_size' => 5,
				'mime_types' => 'pdf',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'publications',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
			1 => 'excerpt',
			2 => 'discussion',
			3 => 'comments',
			4 => 'author',
			5 => 'format',
			6 => 'featured_image',
			7 => 'send-trackbacks',
		),
		'active' => 1,
		'description' => '',
	));

endif;


/**
 * Change Title Placeholder for Custom Post Type
 *
 * Anwälte
 * @name	Anwälte
 * @type    lawyer
 * @slug	lawyers
 */




function wpb_change_title_text( $title ){
	$screen = get_current_screen();

	if  ( 'lawyers' == $screen->post_type ) {
		$title = 'Vorname Nachname';
	}

	return $title;
}

add_filter( 'enter_title_here', 'wpb_change_title_text' );


/* Get ACF */

include ('plugin/acf/acf.php');

function my_ajax_getPublications_handler(){

	$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;

	$publications = get_posts(array(
		'posts_per_page'   => 5,
		'post_type'        => 'publications',
		'offset'           =>  $offset
	));

	foreach( $publications as $post ){
		setup_postdata($post);
		$post->pub_autor = get_field('pub_autor', $post->ID);
		$post->pdf_url = get_field('pdf_pub', $post->ID);
		$post->publisher = get_field('pub_herausgeber', $post->ID);
		$post->sites = get_field('pub_seite', $post->ID);
		$post->year = get_field('pub_jahr', $post->ID);
	}
	echo json_encode($publications);
}

add_action( 'wp_ajax_getArticles', 'my_ajax_getArticles_handler' );

function my_ajax_getArticles_handler(){

	$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;

	$articles = get_posts(array(
		'posts_per_page'   => 5,
		'post_type'        => 'articles',
		'offset'           =>  $offset
	));

	foreach( $articles as $post ){
		setup_postdata($post);
		$post->title = get_field('article_titel', $post->ID);
		$post->autor = get_field('article_autor', $post->ID);
		$post->publisher = get_field('article_herausgeber', $post->ID);
		$post->sites = get_field('article_seite', $post->ID);
		$post->year = get_field('article_jahr', $post->ID);
	}
	echo json_encode($articles);
}

add_action( 'wp_ajax_getPublications', 'my_ajax_getPublications_handler' );








/**
 * ### CUSTOM ###
 * Begins execution of the custom classes.
 *
 */

// add_action('admin_menu', 'publicationmanager');

// add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );

// function load_thickbox() {
//     wp_enqueue_script('thickbox');
//     wp_enqueue_style('thickbox');
// }

// add_action( 'admin_enqueue_scripts', 'load_thickbox' );


// function publicationmanager(){
// 	add_menu_page('Publication Manager', 'Publication Manager', 'manage_options', 'publicationmanager', 'init' );
// 	add_submenu_page('publicationmanager', 'Publication Manager', 'Publication Manager', 'manage_options', 'publicationmanager' );
// 	add_submenu_page('publicationmanager', 'Autoren', 'Autoren', 'manage_options', 'autoren', 'showAuthors' );
// 	add_submenu_page('publicationmanager', 'Beiträge', 'Beiträge', 'manage_options', 'beitraege', 'showArticles' );
//     add_submenu_page('publicationmanager', 'Bücher', 'Bücher', 'manage_options', 'buecher', 'showBooks' );
//     add_submenu_page('publicationmanager', 'Publikationen', 'Publikationen', 'manage_options', 'publikationen', 'showPublications' );
// 	add_submenu_page('publicationmanager', 'Verläge', 'Verläge', 'manage_options', 'verlaege', 'showPublisher' );
// 	add_submenu_page('publicationmanager', 'Erstellen', 'Erstellen', 'manage_options', 'create', 'create' );
// }

// require plugin_dir_path( __FILE__ ) . 'admin/create/model.php';

// function init(){
// 	createDatabase();
//     require plugin_dir_path( __FILE__ ) . 'admin/landing.phtml';
// }

// function createDatabase() {
// 	register_activation_hook( __FILE__, 'createCustomDatabase' );
// 	require plugin_dir_path( __FILE__ ) . 'includes/class-create-database.php';
// 	DatabaseCreator::createCustomDatabase();
// }

// require plugin_dir_path( __FILE__ ) . 'includes/class-addfields.php';
// function showAuthors() {
// 	require plugin_dir_path( __FILE__ ) . 'admin/authors/view.phtml';
// }

// function showPublisher() {
//     require plugin_dir_path( __FILE__ ) . 'admin/verlage/view.phtml';
// }


// function showArticles() {
//     require plugin_dir_path( __FILE__ ) . 'admin/articles/view.phtml';
// }

// function showBooks() {
//     require plugin_dir_path( __FILE__ ) . 'admin/books/view.phtml';
// }


// function create() {
//     require plugin_dir_path( __FILE__ ) . 'admin/create/create.phtml';
// }


// function showPublications() {
// 	require plugin_dir_path( __FILE__ ) . 'admin/publications/view.phtml';
// }


// function showAdminErrorMessage($errMessage) {
//     $class = 'notice notice-error';
//     $message = __( $errMessage, 'sample-text-domain' );

//     printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
// }
// add_action( 'showAdminError', 'showAdminErrorMessage' );

// function showAdminSuccessMessage($msg) {
//     $class = 'notice notice-success';
//     $message = __( $msg, 'sample-text-domain' );

//     printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
// }
// add_action( 'showAdminSuccess', 'showAdminSuccessMessage' );


// add_shortcode('publications', 'publicationsShortcode');

// require plugin_dir_path( __FILE__ ) . 'public/shortcode/publications.phtml';


// add_shortcode('articles', 'articlesShortcode');

// require plugin_dir_path( __FILE__ ) . 'public/shortcode/articles.phtml';


// add_shortcode('books', 'booksShortcode');

// require plugin_dir_path( __FILE__ ) . 'public/shortcode/books.phtml';
?>
