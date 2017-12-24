<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://joe.szalai.org
 * @since      1.0.0
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/includes
 * @author     Joe Szalai <joe@szalai.org>
 */
class Exopite_Lazy_Load_Xt {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Exopite_Lazy_Load_Xt_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'exopite-lazy-load-xt';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		//$this-> exopite_preprare_lazyload($content);
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Exopite_Lazy_Load_Xt_Loader. Orchestrates the hooks of the plugin.
	 * - Exopite_Lazy_Load_Xt_i18n. Defines internationalization functionality.
	 * - Exopite_Lazy_Load_Xt_Admin. Defines all hooks for the admin area.
	 * - Exopite_Lazy_Load_Xt_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-exopite-lazy-load-xt-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-exopite-lazy-load-xt-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-exopite-lazy-load-xt-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-exopite-lazy-load-xt-public.php';

		$this->loader = new Exopite_Lazy_Load_Xt_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Exopite_Lazy_Load_Xt_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Exopite_Lazy_Load_Xt_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Exopite_Lazy_Load_Xt_Admin( $this->get_plugin_name(), $this->get_version() );

		// From here added
		// Save/Update our plugin options
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');

		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );

		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Exopite_Lazy_Load_Xt_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        $method = 'method-2';

        switch ( $method ) {

            case 'method-1':

                /*
                 * Add filter to content
                 * hook to 12, after shortcode
                 * https://core.trac.wordpress.org/browser/tags/4.3.1/src/wp-includes/default-filters.php
                 *
                 * The problems with this method:
                 * - some page builder does not use content, they save data in meta,
                 * - 'widget_text' -> in case of SiteOrigin Page Builder, becuase they
                 *   use widgets on the page builder content, will run twice.
                 */
                $this->loader->add_filter( 'the_content', $plugin_public, 'do_lazyload', 12 );
                // $this->loader->add_filter( 'widget_text', $plugin_public, 'do_lazyload', 12 );

                break;

            case 'method-2':

                /*
                 * Start buffering when wp_loaded hook called
                 * end buffering when showdown hook called
                 *
                 * In this case we can process the whole HTML just before it is send it to the browser.
                 * Need to be disabled in admin, doing JSON, REST, XMLRPC or AJAX request, also in this cases
                 * LazyLoad in unnecessarily.
                 *
                 */
                if ( ! ( ( defined( 'JSON_REQUEST' ) && JSON_REQUEST ) ||
                         ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ||
                         ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) ||
                         ( defined('DOING_AJAX') && DOING_AJAX ) ||
                         is_admin()
                    ) ) {

                    $this->loader->add_filter( 'wp_loaded', $plugin_public, 'buffer_start', 12 );
                    $this->loader->add_filter( 'shutdown', $plugin_public, 'buffer_end', 12 );

                }

                break;

        }

        //$this->loader->add_filter( 'image_lazyload_dummy_image', $plugin_public, 'image_lazyload_dummy_image' );

        // Filters the list of attachment image attributes.
		$this->loader->add_filter( 'wp_get_attachment_image_attributes', $plugin_public, 'add_lazyload_to_attachment_image', 11, 2 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Exopite_Lazy_Load_Xt_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}


}

