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

    public function create_menu() {

        $config = array(

            'type'              => 'menu',                          // Required, menu or metabox
            'id'                => $this->plugin_name,              // Required, meta box id, unique per page, to save: get_option( id )
            'parent'              => 'plugins.php',                   // Required, sub page to your options page
            'submenu'           => true,                            // Required for submenu
            'title'             => 'Exopite LazyLoadXT',            //The name of this page
            'capability'        => 'manage_options',                // The capability needed to view the page
            'plugin_basename'   =>  plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' ),
            'tabbed'            => false,
            'multilang'         => false,

        );

        $fields[] = array(
            'name'   => 'general',
            'fields' => array(

                array(
                    'type'    => 'card',
                    'class'   => 'class-name', // for all fieds
                    'content' => '<p>' . esc_html__("Lazy load images, iframes and videos to improve page load times and user experience. Uses jQuery and Lazy Load XT to only load media when it's visible in the viewport or with autoload enabled, load images after other content is loaded. It is also improve SEO, because of the faster page load.", 'exopite-lazy-load-xt') . '</p><p>' .  esc_html__("You can exclude content between [NOLAZY] and [/NOLAZY] tags or with a specified class (only method-1). This is important, if you use other lazy load based plugins, like Master Slider.", 'exopite-lazy-load-xt') . '</p><p>' . esc_html__("Since GoogleBOT crawling javascript, there is no disadvantage of this technique.", 'exopite-lazy-load-xt') . ' <a href="https://webmasters.googleblog.com/2014/05/understanding-web-pages-better.html">' . esc_html__( 'Official news on crawling and indexing sites for the Google index', 'exopite-lazy-load-xt' ) . '</a></p>',
                    'header' => 'Information',
                ),

                array(
                    'id'      => 'autoload',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Autoload images', 'exopite-lazy-load-xt' ),
                    'label'   => 'Autoload images after page is loaded',
                    'default' => 'yes',
                ),

                array(
                    'id'      => 'image',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Lazyload images', 'exopite-lazy-load-xt' ),
                    'default' => 'yes',
                ),

                array(
                    'id'      => 'iframe',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Lazyload iframes', 'exopite-lazy-load-xt' ),
                    'default' => 'yes',
                ),

                array(
                    'id'      => 'video',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Lazyload videos', 'exopite-lazy-load-xt' ),
                    'default' => 'yes',
                ),

                array(
                    'id'      => 'background',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Lazyload background images', 'exopite-lazy-load-xt' ),
                    'label'   => esc_html__( '(Please set background url in style tag with data-bg attribute.)', 'exopite-lazy-load-xt' ),
                    'default' => 'no',
                ),

                array(
                  'id'      => 'method',
                  'type'    => 'button_bar',
                  'title'   => esc_html__( 'Method', 'exopite-lazy-load-xt' ),
                  'options' => array(
                    'method-1'   => 'Method 1',
                    'method-2'   => 'Method 2',
                  ),
                  'default' => 'method-2',
                  'after'   => '<i class="text-muted">' . esc_html__( 'Method 1: use content,', 'exopite-lazy-load-xt' ) . '<br> ' . esc_html__( 'Method 2: process HTML before sent to browser.', 'exopite-lazy-load-xt' ) . '</i>',
                ),

                array(
                    'id'     => 'lazyload-only-in',
                    'type'   => 'text',
                    'title'  => esc_html__( 'Lazyload only in selector', 'exopite-lazy-load-xt' ),
                ),

                array(
                    'id'      => 'exclude',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Exclude classes', 'exopite-lazy-load-xt' ),
                    'default' => 'yes',
                ),

                array(
                    'id'     => 'excluded',
                    'type'   => 'text',
                    'title'  => esc_html__( 'Specify classes to exclude', 'exopite-lazy-load-xt' ),
                    'after'  => esc_html__( 'You can specify classes to exclude from being lazy loaded here. Please use a comma separated list, like: no-lazy, nolazy, etc...', 'exopite-lazy-load-xt' ),
                    'dependency' => array( 'exclude', '==', 'true' ),
                ),

                array(
                    'type'    => 'content',
                    'content' => '<ul style="list-style: disc; padding-left: 30px; font-size: 0.8em; line-height: 1.3em; max-width: 100%;"><li><a target="_blank" href="https://jquery.com/"><b>jQuery</b></a> ' . esc_html__("is a fast, small, and feature-rich JavaScript library. It makes things like HTML document traversal and manipulation, event handling, animation, and Ajax much simpler with an easy-to-use API that works across a multitude of browsers. With a combination of versatility and extensibility, jQuery has changed the way that millions of people write JavaScript.", 'exopite-lazy-load-xt' ) . '</li><li><a target="_blank" href="http://ressio.github.io/lazy-load-xt/"><b>Lazy load XT</b></a> ' . esc_html__( "is a jQuery plugin for images, videos and other media<br>Mobile-oriented, fast and extensible jQuery plugin for lazy loading of images/videos.<br>Currently tested in IE 6-11, Chrome 1-47, Firefox 1.5-43.0, Safari 3-9, Opera 10.6-34.0, iOS 5-9, Android 2.3-5.1, Amazon Kindle Fire 2 and HD 8.9, Opera Mini 7.", 'exopite-lazy-load-xt' ) . '</li><li><a target="_blank" href="http://wppb.io/"><b>The WordPress Plugin Boilerplate</b></a> ' . esc_html__("A standardized, organized, bject-oriented foundation for building high-quality WordPress Plugins.", 'exopite-lazy-load-xt' ) . '</li></ul>',
                ),



            ),

        );

        $options_panel = new Exopite_Simple_Options_Framework( $config, $fields );

    }

}
