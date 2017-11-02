<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://joe.szalai.org
 * @since             20171102
 * @package           Exopite_Lazy_Load_Xt
 *
 * @wordpress-plugin
 * Plugin Name:       Exopite Lazy Load XT
 * Plugin URI:        http://joe.szalai.org
 * Description: 	  Mobile-oriented, fast and extensible jQuery plugin for lazy loading of images/videos. Based on: https://github.com/ressio/lazy-load-xt. Fast, lightwieght and freeware. Skip [NOLAZY][/NOLAZY] section and no-lazy class. Masterslider and other lazyload based slider compatible.
 * Version:           1.0.0
 * Author:            Joe Szalai
 * Author URI:        http://joe.szalai.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       exopite-lazy-load-xt
 * Domain Path:       /languages
 */

//https://www.smashingmagazine.com/2015/02/redefining-lazy-loading-with-lazy-load-xt/


/*
ToDo:
 - noscript images-ok/videos/iframe? as fallback
   https://siteorigin.com/thread/were-is-the-pagebuilder-data-stored/
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-exopite-lazy-load-xt-activator.php
 */
function activate_exopite_lazy_load_xt() {
	require_once EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR . 'includes/class-exopite-lazy-load-xt-activator.php';
	Exopite_Lazy_Load_Xt_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_exopite_lazy_load_xt' );

/**
 * PHP Simple HTML DOM Parser
 */
if( ! class_exists( 'simple_html_dom' ) ) {
    require EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR . 'includes/libraries/simple_html_dom.php';
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR . 'includes/class-exopite-lazy-load-xt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
/**
 * Singleton: http://jamesdigioia.com/a-better-wordpress-singleton/
 */
/**
 * To add (multiple) shortcodes: https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/issues/262
 */
/**
 * Working examples: https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/wiki/Example-Plugins
 */
/**
 * Source: https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/issues/217
 * The way in which someone would remove a hook on your plugin would be:
 *
 *   - Get a reference to the instance of the plugin
 *   - Remove an action using said reference
 *
 * For example:
 *
 * $plugin = new My_Plugin();
 * remove_action( 'hook', array( $plugin, 'function_name' ) );
 *
 * Note that you may need to either create a singleton or a container (I prefer the latter) to maintain a reference to the plugin,
 * and the function_name will have to be  * a public function; otherwise, WordPress can't access it.
 */

function run_exopite_lazy_load_xt() {

	$plugin = new Exopite_Lazy_Load_Xt();
	$plugin->run();

}
run_exopite_lazy_load_xt();

/*
//http://jespervanengelen.com/different-ways-of-instantiating-wordpress-plugins/
class Exopite_Lazy_Load_Xt_Singleton
{

	public static $plugin;

}

Exopite_Lazy_Load_Xt_Singleton::$plugin = new Exopite_Lazy_Load_Xt();
Exopite_Lazy_Load_Xt_Singleton::$plugin->run();
*/
