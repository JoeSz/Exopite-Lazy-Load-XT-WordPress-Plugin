<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://joe.szalai.org
 * @since      1.0.0
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/admin
 * @author     Joe Szalai <joe@szalai.org>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Exopite_Lazy_Load_Xt_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		//add_filter( 'the_content', array( $this, 'exopite_preprare_lazyload' ) );
	}

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Exopite_Combiner_Minifier_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Exopite_Combiner_Minifier_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/exopite-lazy-load-xt-admin.css', array(), $this->version, 'all' );

    }

	// From here
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_submenu_page(
            'plugins.php',
            'Exopite Lazy Load XT Options Functions Setup',
            'Exopite LazyLoadXT',
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_plugin_setup_page' )
        );
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'plugins.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {
	    include_once( 'partials/exopite-lazy-load-xt-admin-display.php' );
	}

	/**
	 * Validate fields from admin area plugin settings form ('exopite-lazy-load-xt-admin-display.php')
	 * @param  mixed $input as field form settings form
	 * @return mixed as validated fields
	 */
	public function validate($input) {
	    // All checkboxes inputs
	    $valid = array();

	    $valid['autoload'] = (isset($input['autoload']) && !empty($input['autoload'])) ? 1 : 0;
	    $valid['image'] = (isset($input['image']) && !empty($input['image'])) ? 1 : 0;
	    $valid['video'] = (isset($input['video']) && !empty($input['video'])) ? 1: 0;
	    $valid['iframe'] = (isset($input['iframe']) && !empty($input['iframe'])) ? 1 : 0;
	    $valid['background'] = (isset($input['background']) && !empty($input['background'])) ? 1 : 0;
	    $valid['exclude'] = (isset($input['exclude']) && !empty($input['exclude'])) ? 1 : 0;
        $valid['lazyload-only-in'] = esc_attr($input['lazyload-only-in']);
        $valid['method'] = esc_attr($input['method']);
	    $valid['excluded'] = esc_attr($input['excluded']);

	    return $valid;
	}

	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

}
