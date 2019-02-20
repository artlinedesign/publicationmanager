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
 * Description:       Create and handle Publications, Authors, Articles, Publishers and Books
 * Version:           1.1.0
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
define( 'PLUGIN_NAME_VERSION', '1.0.1' );

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

# Add Plugin into Admin Menu
add_action('admin_menu', 'publicationmanager');

function publicationmanager(){
	add_menu_page('CM', 'CM', 'manage_options', 'cm', 'init', 'dashicons-portfolio', 65);
	add_submenu_page('cm', 'Anwälte', 'Anwälte', 'manage_options', 'edit.php?post_type=lawyers', NULL );
	add_submenu_page('cm', 'Bücher', 'Bücher', 'manage_options', 'edit.php?post_type=books', NULL );
	add_submenu_page('cm', 'Publikationen', 'Publikationen', 'manage_options', 'edit.php?post_type=publications', NULL );
	add_submenu_page('cm', 'Beiträge', 'Beiträge', 'manage_options', 'edit.php?post_type=articles', NULL );
	add_submenu_page('cm', 'Verläge', 'Verläge', 'manage_options', 'edit.php?post_type=publisher', NULL );
	add_submenu_page('cm', 'Settings', 'Settings', 'manage_options', 'settings', 'showSettings' );

	
}

function init() {
	require plugin_dir_path( __FILE__ ) . 'admin/landing.phtml';
}

function showSettings() {
 	require plugin_dir_path( __FILE__ ) . 'admin/settings/settings.phtml';
 }

# Load Custom Post Type
include 'includes/config/register-cpt.php';

# Load Advanced Custom Fields
# PHP Style
include 'includes/config/acf-config.php';


# JSON style
// function loadCustomField() {
//         wp_enqueue_script( 'json_settings', plugins_url('includes/config/acf-config.json', __FILE__,true) );
// }
// add_action( 'admin_enqueue_scripts', 'loadCustomField' );



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


require plugin_dir_path( __FILE__ ) . 'public/shortcode/lawyers.phtml';

add_shortcode('lawyers', 'lawyersShortcode');

require plugin_dir_path( __FILE__ ) . 'public/shortcode/publications.phtml';

add_shortcode('publications', 'publicationsShortcode');

require plugin_dir_path( __FILE__ ) . 'public/shortcode/professions.phtml';

add_shortcode('professions', 'professionsShortcode');



/* Get ACF */



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
add_action( 'wp_ajax_nopriv_getArticles', 'my_ajax_getArticles_handler' );

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
add_action( 'wp_ajax_nopriv_getPublications', 'my_ajax_getPublications_handler' );










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





// add_shortcode('books', 'booksShortcode');

// require plugin_dir_path( __FILE__ ) . 'public/shortcode/books.phtml';
?>
