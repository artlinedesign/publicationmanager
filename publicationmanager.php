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

/**
* Adds Admin Menu
*
*
* Start function init
*
*/



add_action('admin_menu', 'publicationmanager');

add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );

function load_thickbox() {
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

add_action( 'admin_enqueue_scripts', 'load_thickbox' );


function publicationmanager(){
	add_menu_page('Publication Manager', 'Publication Manager', 'manage_options', 'publicationmanager', 'init' );
	add_submenu_page('publicationmanager', 'Publication Manager', 'Publication Manager', 'manage_options', 'publicationmanager' );
	add_submenu_page('publicationmanager', 'Autoren', 'Autoren', 'manage_options', 'autoren', 'showAuthors' );
	add_submenu_page('publicationmanager', 'Beiträge', 'Beiträge', 'manage_options', 'beitraege', 'showArticles' );
    add_submenu_page('publicationmanager', 'Bücher', 'Bücher', 'manage_options', 'buecher', 'showBooks' );
    add_submenu_page('publicationmanager', 'Publikationen', 'Publikationen', 'manage_options', 'publikationen', 'showPublications' );
	add_submenu_page('publicationmanager', 'Verläge', 'Verläge', 'manage_options', 'verlaege', 'showPublisher' );
	add_submenu_page('publicationmanager', 'Erstellen', 'Erstellen', 'manage_options', 'create', 'create' );

}

require plugin_dir_path( __FILE__ ) . 'admin/create/model.php';

function init(){
	createDatabase();
    require plugin_dir_path( __FILE__ ) . 'admin/landing.phtml';
}

function createDatabase() {
	register_activation_hook( __FILE__, 'createCustomDatabase' );
	require plugin_dir_path( __FILE__ ) . 'includes/class-create-database.php';
	DatabaseCreator::createCustomDatabase();
}

require plugin_dir_path( __FILE__ ) . 'includes/class-addfields.php';
function showAuthors() {
	require plugin_dir_path( __FILE__ ) . 'admin/authors/view.phtml';
}

function showPublisher() {
    require plugin_dir_path( __FILE__ ) . 'admin/verlage/view.phtml';
}


function showArticles() {
    require plugin_dir_path( __FILE__ ) . 'admin/articles/view.phtml';
}

function showBooks() {
    require plugin_dir_path( __FILE__ ) . 'admin/books/view.phtml';
}


function create() {
    require plugin_dir_path( __FILE__ ) . 'admin/create/create.phtml';
}


function showPublications() {
	require plugin_dir_path( __FILE__ ) . 'admin/publications/view.phtml';
}


function showAdminErrorMessage($errMessage) {
    $class = 'notice notice-error';
    $message = __( $errMessage, 'sample-text-domain' );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
add_action( 'showAdminError', 'showAdminErrorMessage' );

function showAdminSuccessMessage($msg) {
    $class = 'notice notice-success';
    $message = __( $msg, 'sample-text-domain' );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
add_action( 'showAdminSuccess', 'showAdminSuccessMessage' );


add_shortcode('publications', 'publicationsShortcode');

require plugin_dir_path( __FILE__ ) . 'public/shortcode/publications.phtml';


add_shortcode('articles', 'articlesShortcode');

require plugin_dir_path( __FILE__ ) . 'public/shortcode/articles.phtml';


add_shortcode('books', 'booksShortcode');

require plugin_dir_path( __FILE__ ) . 'public/shortcode/books.phtml';



?>
