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
 * Plugin Name:       Publication Manager
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

function publicationmanager(){
	add_menu_page('Publication Manager', 'Publication Manager', 'manage_options', 'publicationmanager', 'init' );
	add_submenu_page('publicationmanager', 'Publication Manager', 'Publication Manager', 'manage_options', 'publicationmanager' );
	add_submenu_page('publicationmanager', 'Autoren', 'Autoren', 'manage_options', 'autoren', 'showauthors' );
	add_submenu_page('publicationmanager', 'Bücher', 'Bücher', 'manage_options', 'buecher', 'showBooks' );
	add_submenu_page('publicationmanager', 'Beiträge', 'Beiträge', 'manage_options', 'beitraege', 'showArticles' );
	add_submenu_page('publicationmanager', 'Publikationen', 'Publikationen', 'manage_options', 'publikationen', 'showPublications' );
	add_submenu_page('publicationmanager', 'Verläge', 'Verläge', 'manage_options', 'verlaege', 'showPublisher' );


}



function init(){
	echo "<h1>Seas btp, hier kannst du deine publikationen usw selber online stellen. viel spass. haha.</h1> ";
				createDatabase();
				buildForm();


}

function createDatabase() {
	register_activation_hook( __FILE__, 'createCustomDatabase' );
	require plugin_dir_path( __FILE__ ) . 'includes/class-create-database.php';
	DatabaseCreator::createCustomDatabase();
}



function buildForm() {
	require plugin_dir_path( __FILE__ ) . 'includes/class-addfields.php';
	Formbuilder::addInput();

}


function showauthors() {
	require plugin_dir_path( __FILE__ ) . 'admin/authors/view.phtml';
}







?>
