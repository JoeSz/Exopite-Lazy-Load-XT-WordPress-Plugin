<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://joe.szalai.org
 * @since             1.0
 * @package           Exopite_Lazy_Load_Xt
 *
 * @wordpress-plugin
 * Plugin Name:       Exopite Lazy Load XT
 * Plugin URI:        https://joe.szalai.org/exopite/exopite-lazy-load-xt/
 * Description: 	  Mobile-oriented, fast and extensible jQuery plugin for lazy loading of images/videos. Based on: https://github.com/ressio/lazy-load-xt. Fast, lightwieght and freeware. Skip [NOLAZY][/NOLAZY] section and no-lazy class. Masterslider and other lazyload based slider compatible.
 * Version:           20190213
 * Author:            Joe Szalai
 * Author URI:        https://joe.szalai.org
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
 - Add method selector to admin (def. method-2)
 - Add "content" field to admin (def. body)
   In this case, process only HTML in selector, avoid e.g. to lazyload logos.
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EXOPITE_LAZY_LOAD_XT_PLUGIN_NAME', 'exopite-lazy-load-xt' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-exopite-lazy-load-xt-activator.php
 */
function activate_exopite_lazy_load_xt() {
	require_once EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR . 'includes/class-exopite-lazy-load-xt-activator.php';
	Exopite_Lazy_Load_Xt_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_exopite_lazy_load_xt' );

/*
 * Update
 */
if ( is_admin() ) {

    /**
     * A custom update checker for WordPress plugins.
     *
     * Useful if you don't want to host your project
     * in the official WP repository, but would still like it to support automatic updates.
     * Despite the name, it also works with themes.
     *
     * @link http://w-shadow.com/blog/2011/06/02/automatic-updates-for-commercial-themes/
     * @link https://github.com/YahnisElsts/plugin-update-checker
     * @link https://github.com/YahnisElsts/wp-update-server
     */
    if( ! class_exists( 'Puc_v4_Factory' ) ) {

        require_once join( DIRECTORY_SEPARATOR, array( EXOPITE_LAZY_LOAD_XT_PLUGIN_DIR, 'vendor', 'plugin-update-checker', 'plugin-update-checker.php' ) );

    }

    $MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://update.joeszalai.org/?action=get_metadata&slug=' . EXOPITE_LAZY_LOAD_XT_PLUGIN_NAME, //Metadata URL.
        __FILE__, //Full path to the main plugin file.
        EXOPITE_LAZY_LOAD_XT_PLUGIN_NAME //Plugin slug. Usually it's the same as the name of the directory.
    );

	/**
	 * add plugin upgrade notification
	 * https://andidittrich.de/2015/05/howto-upgrade-notice-for-wordpress-plugins.html
	 */
	add_action( 'in_plugin_update_message-' . EXOPITE_LAZY_LOAD_XT_PLUGIN_NAME . '/' . EXOPITE_LAZY_LOAD_XT_PLUGIN_NAME .'.php', 'exopite_lazy_load_xt_show_upgrade_notification', 10, 2 );
	function exopite_lazy_load_xt_show_upgrade_notification( $current_plugin_metadata, $new_plugin_metadata ) {

		/**
		 * Check "upgrade_notice" in readme.txt.
		 *
		 * Eg.:
		 * == Upgrade Notice ==
		 * = 20180624 = <- new version
		 * Notice		<- message
		 *
		 */
		if ( isset( $new_plugin_metadata->upgrade_notice ) && strlen( trim( $new_plugin_metadata->upgrade_notice ) ) > 0 ) {

			// Display "upgrade_notice".
			echo sprintf( '<span style="background-color:#d54e21;padding:10px;color:#f9f9f9;margin-top:10px;display:block;"><strong>%1$s: </strong>%2$s</span>', esc_attr( 'Important Upgrade Notice', 'exopite-multifilter' ), esc_html( rtrim( $new_plugin_metadata->upgrade_notice ) ) );

		}
    }

}
// End Update

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
