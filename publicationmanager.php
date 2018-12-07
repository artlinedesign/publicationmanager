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

	add_menu_page('CM', 'CM', 'manage_options', 'cm', 'init' );

	add_submenu_page('cm', 'Autoren', 'Autoren', 'manage_options', 'edit.php?post_type=authors', NULL );
	add_submenu_page('cm', 'Bücher', 'Bücher', 'manage_options', 'edit.php?post_type=books', NULL );
	add_submenu_page('cm', 'Publikationen', 'Publikationen', 'manage_options', 'edit.php?post_type=publications', NULL );
	add_submenu_page('cm', 'Beiträge', 'Beiträge', 'manage_options', 'edit.php?post_type=articles', NULL );
	add_submenu_page('cm', 'Verläge', 'Verläge', 'manage_options', 'edit.php?post_type=publisher', NULL );
}



/**
 * Register custom post type 
 *
 * Authors
 * @name	Authors
 * @type    authors
 * @slug	auhtors
 */

 function registerAuthor() {
	$labels = array(
		'name'               => _x( 'Authors', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'author', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Authors', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'author', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'author', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New author', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New author', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit author', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View author', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Authors', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Authors', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Authors:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Authors found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Authors found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false, //<--- HERE
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'authors' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'authors', $args );
}

add_action( 'init', 'registerAuthor' );


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
		'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Books found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Books found in Trash.', 'your-plugin-textdomain' )
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
		'supports'           => array( 'title', 'editor', 'thumbnail' )
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
		'name'               => _x( 'Publications', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Publication', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Publications', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Publication', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Publication', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Publication', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Publication', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Publication', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Publication', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Publications', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Publications', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Publications:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Publications found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Publications found in Trash.', 'your-plugin-textdomain' )
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
		'name'               => _x( 'Articles', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Article', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Articles', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Article', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Article', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Article', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Article', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Article', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Article', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Articles', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Articles', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Articles:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Articles found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Articles found in Trash.', 'your-plugin-textdomain' )
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
		'name'               => _x( 'Publishers', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Publisher', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Publishers', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Publisher', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Publisher', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Publisher', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Publisher', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Publisher', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Publisher', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Publishers', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Publishers', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Publishers:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Publishers found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Publishers found in Trash.', 'your-plugin-textdomain' )
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
