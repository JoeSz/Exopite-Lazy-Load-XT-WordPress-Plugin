<?php

/**
 * Fired during plugin activation
 *
 * @link       http://joe.szalai.org
 * @since      1.0.0
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/includes
 * @author     Joe Szalai <joe@szalai.org>
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
class Exopite_Lazy_Load_Xt_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( ! get_option( 'exopite-lazy-load-xt' ) ) {
			$array_of_options = array(
			    'autoload' => '1',
			    'image' => '1',
			    'video' => '1',
			    'iframe' => '1',
			    'background' => '0',
			    'exclude' => '1',
			    'excluded' => 'no-lazy'
			);
			update_option( 'exopite-lazy-load-xt', $array_of_options );
		}
	}

}
