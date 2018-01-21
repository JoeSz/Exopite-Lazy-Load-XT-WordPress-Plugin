<?php
/**
 * ToDo:
 * - check leftover "</p>"-s
 * - post thumbnail image lazyload?
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://joe.szalai.org
 * @since      1.0.0
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/public
 * @author     Joe Szalai <joe@szalai.org>
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Exopite_Lazy_Load_Xt_Public {

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

    private $settings = array();
    private $lazy_class = 'lazy';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
        $this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Exopite_Lazy_Load_Xt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Exopite_Lazy_Load_Xt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/exopite-lazy-load-xt-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Exopite_Lazy_Load_Xt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Exopite_Lazy_Load_Xt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$options = get_option($this->plugin_name);
        $autoload = ( isset( $options['autoload'] ) && $options['autoload'] == 'yes' ) ? 1 : 0;

		// Source: https://github.com/ressio/lazy-load-xt
		// CDN: https://cdnjs.com/libraries/jquery.lazyloadxt/
        // wp_register_script( 'js-lazyload-extra', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.extra.min.js', array( 'jquery' ), '1.9.1', true);
        //
        // I had to change the JS file, because the video selector.
        // It was "video" and I need video[data-src]


        // wp_register_script( 'js-lazyload-extra', plugin_dir_url( __FILE__ ) . 'js/jquery.lazyloadxt.extra.js', array( 'jquery' ), '1.9.1', true);
        // wp_enqueue_script( 'js-lazyload-extra' );

        // wp_register_script( 'js-lazyload-extra', plugin_dir_url( __FILE__ ) . 'js/jquery.lazyloadxt.extra.min.js', array( 'jquery' ), '1.9.1', true);
        // wp_enqueue_script( 'js-lazyload-extra' );

        // wp_register_script( 'js-lazyload-complete', plugin_dir_url( __FILE__ ) . 'js/jquery.lazyloadxt.complete.min.js', array( 'jquery' ), '1.9.1', true);
        // wp_enqueue_script( 'js-lazyload-complete' );
		wp_register_script( 'js-lazyload-complete', plugin_dir_url( __FILE__ ) . 'js/jquery.lazyloadxt.complete.min.js', array( 'jquery' ), '1.9.1', true);
		wp_enqueue_script( 'js-lazyload-complete' );

        // wp_register_script( 'js-lazyload-srcset', plugin_dir_url( __FILE__ ) . 'js/jquery.lazyloadxt.srcset.js', array( 'jquery', 'js-lazyload-extra' ), '1.9.1', true);
        // wp_enqueue_script( 'js-lazyload-srcset' );

		// if ( $autoload ) {
		// 	wp_register_script( 'js-lazyload-autoload', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.autoload.min.js', array( 'jquery' ), '1.9.1', true);
		// 	wp_enqueue_script( 'js-lazyload-autoload' );
		// }

        // wp_register_script( 'js-lazyload-hook', plugin_dir_url( __FILE__ ) . 'js/jquery.lazyloadxt.hook.min.js', array( 'jquery', 'js-lazyload-extra' ), '1.9.1', true);
        // wp_enqueue_script( 'js-lazyload-hook' );

	}

	public function image_lazyload_dummy_image() {
        return apply_filters( 'exopite_lazyload_xt_placeholder_image', plugin_dir_url( __FILE__ ) . 'ripple.svg' );
	}

    /**
     * Filters the list of attachment image attributes.
     *
     * @param array            $attr       Attributes for the image markup.
     * @param object (WP_Post) $attachment Image attachment post.
     *
     * @link https://developer.wordpress.org/reference/hooks/wp_get_attachment_image_attributes/
     * @link http://wordpress.stackexchange.com/questions/54986/the-post-thumbnail-with-lazyload-jq-plugin
     */
    function add_lazyload_to_attachment_image( $attr, $attachment ) {
        if ( ! is_admin() ) {
            if ( $attr['src'] != $this->image_lazyload_dummy_image() ) $attr['data-src'] = $attr['src'];
            $attr['src'] = $this->image_lazyload_dummy_image();
        }
        return $attr;
    }

    public function buffer_start() {

        // Start output buffering with a callback function
        ob_start( array( $this, 'do_lazyload_fregment' ) );

    }

    public function buffer_end() {

        // Display buffer
        if ( ob_get_length() ) ob_end_flush();

    }

    public function do_lazyload_fregment( $content ) {

        $html = new simple_html_dom();

        // Load HTML from a string/variable
        $html->load( $content, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT );

        $options = get_option($this->plugin_name);
        $lazyload_only_in = $options['lazyload-only-in'];

        $contents = $html->find( $lazyload_only_in );

        // $contents = $html->find( '#content' );

        foreach( $contents as $item ) {

            $item->innertext = $this->do_lazyload_filter( $item->innertext );
            // $item->innertext = $this->do_lazyload( $item->innertext );

        }

        $content = $html->save();

        $html->clear();
        unset($html);

        return $content;

    }

    /**
     * Filter content section which is not inside [NOLAZY] and [/NOLAZY] tags
     *
     * @param  string $content as content to filter
     * @return string $content as filtered
     */
    public function do_lazyload( $content ) {

        // $start = microtime(true);
        if ( ! apply_filters( 'exopite_lazyload_xt_enabled', true ) ) return $content;

        /**
         * To prevent run multiple times (eg. SiteOrigin Pgae Builder run 4 times because the widget_text in the_content).
         * For some reason, this prevent to run multiple times on the content (if contain widgets).
         */
        // if ( ! apply_filters( 'exopite_lazyload_xt_run', true ) ) return $content;
        // add_filter( 'exopite_lazyload_xt_run', '__return_false' );

        $new_content = '';

        // do not lazyload between [NOLAZY] and [/NOLAZY] -> for exapmle: sliders with lazyload, like masterslider
        $pattern_full = '{(\[NOLAZY\].*?\[\/NOLAZY\])}is';
        $pattern_contents = '{\[NOLAZY\](.*?)\[\/NOLAZY\]}is';
        $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

        // loop through pieces
        foreach ($pieces as $piece) {
            if (preg_match($pattern_contents, $piece, $matches)) {

                // Skip nolazy sections
                $new_content .= $matches[1];

            } else {

                // Process others
                $new_content .= $this->do_lazyload_filter( $piece );
            }
        }

        return $new_content;

    }



    /**
     * Check if given class(es) is a class(es) to exclude
     *
     * @param  array $classes
     * @return boolean
     */
    private function check_classes( $classes ) {
        if ( array_intersect( $classes, $this->settings['excludeclasses'] ) ) {
            return false;
        }
        return true;
    }

    /**
     * Process images for Lazy-Load-XT
     * - move src to data-src
     * - move srcset to data-srcset
     * - change src to loader image
     * - add lazy class to classes
     * - add original img element in <noscript> tag
     *
     * @param  object $image PHP Simple DOM Parser Object
     * @return object
     */
    private function process_image( $image ) {

        // Get image src
        $image_src = $image->getAttribute( 'src' );

        // Get image classes
        $classes = explode(' ', $image->getAttribute( 'class' ) );

        // Process image src not already replaced
        if ( $image_src != $this->image_lazyload_dummy_image() && $this->check_classes( $classes ) ) {

            // Get original image for noscript
            $image_noscript = $image->outertext;

            // Get image srcset
            $image_srcset = $image->getAttribute('srcset');

            // Set image src to dummy image
            $image->setAttribute( 'src', $this->image_lazyload_dummy_image() );

            // Remove the srcset attribute
            $image->removeAttribute( 'srcset' );

            // Set original src to data-src
            $image->setAttribute( 'data-src', $image_src );

            // Set original srcset to data-srcset
            $image->setAttribute( 'data-srcset', $image_srcset );

            // Set classes
            $classes[] = $this->lazy_class;
            $image->setAttribute( 'class', implode( ' ', $classes ) );

            // Add original image after noscript tag for fallback
            $image->outertext .= '<noscript>' . $image_noscript . '</noscript>';
        }

    }

    /**
     * Process videos for Lazy-Load-XT
     * - move video and video/source src to data-src
     * - remove src tag
     * - add lazy class to classes
     *
     * @param  object $image PHP Simple DOM Parser Object
     * @return object
     */
    private function process_video( $video ) {

        // Get original image for noscript
        $video_noscript = $video->outertext;

        $classes = explode(' ', $video->getAttribute( 'class' ) );

        if ( $this->check_classes( $classes ) ) {

            $video_poster = $video->getAttribute('poster');

            $video->removeAttribute('poster');

            $video->setAttribute('data-poster', $video_poster);

            // Set classes
            $classes[] = $this->lazy_class;
            $video->setAttribute( 'class', implode( ' ', $classes ) );

            if ( $video->hasAttribute( 'src' ) ) {

                $video_src = $video->getAttribute( 'src' );
                $video->removeAttribute( 'src' );
                $video->setAttribute( 'data-src', $video_src );

            } else {

                foreach ( $video->find( 'source' ) as $source ) {

                    $source_src = $source->getAttribute( 'src' );
                    $source->removeAttribute( 'src' );
                    $source->setAttribute( 'data-src', $source_src );

                }
            }

            // Add original image after noscript tag for fallback
            $video->outertext .= '<noscript>' . $video_noscript . '</noscript>';

        }

    }

    /**
     * Process iframes for Lazy-Load-XT
     * - move iframe src to data-src
     * - remove src tag
     * - add lazy class to classes
     *
     * @param  object $image PHP Simple DOM Parser Object
     * @return object
     */
    private function process_iframe( $iframe ) {

        $classes = explode( ' ', $iframe->getAttribute('class') );

        if ( $this->check_classes( $classes ) ) {

            // Set classes
            $classes[] = $this->lazy_class;
            $iframe->setAttribute( 'class', implode( ' ', $classes ) );

            $iframe_src = $iframe->getAttribute('src');
            $iframe->removeAttribute('src');
            $iframe->setAttribute('data-src', $iframe_src);

        }

    }

    /**
     * Process HTML piece with PHP Simple DOM Parser
     * - skip piece fregment with class(es) to exclude
     * - Process images for Lazy-Load-XT
     * - Process videos for Lazy-Load-XT
     * - Process iframes for Lazy-Load-XT
     *
     * @param  [type] $piece [description]
     * @return [type]        [description]
     */
    public function do_lazyload_filter( $piece ) {

        /*
         * Youtube: https://webdesign.tutsplus.com/tutorials/how-to-lazy-load-embedded-youtube-videos--cms-26743
         */

        if ( empty( $piece ) ) return;

        $options = get_option( $this->plugin_name);
        $lazyload_video = ( isset( $options['video'] ) && $options['video'] == 'yes' ) ? 1 : 0;
        $lazyload_iframe = ( isset( $options['iframe'] ) && $options['iframe'] == 'yes' ) ? 1 : 0;
        $lazyload_image = ( isset( $options['image'] ) && $options['image'] == 'yes' ) ? 1 : 0;
        $lazyload_background = ( isset( $options['background'] ) && $options['background'] == 'yes' ) ? 1 : 0;
        $lazyload_exclude = ( isset( $options['exclude'] ) && $options['exclude'] == 'yes' ) ? 1 : 0;
        $lazyload_excluded = ( isset( $options['excluded'] ) && ! empty( $options['excluded'] ) ) ? esc_attr( $options['excluded'] ) : '';
        $folder = plugin_dir_url( __FILE__ );

        if ( $lazyload_exclude ) {
            // load excluded classes
            // strip all whitespaces out, then split by comma
            $this->settings['excludeclasses'] = explode( ',', preg_replace( '/\s+/', '', $lazyload_excluded ) );
        }

        $html = new simple_html_dom();

        // Load HTML from a string/variable
        $html->load( $piece, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT );

        // Convert exluded classes to .{class}
        $classes_with_point = $this->settings['excludeclasses'];
        foreach ( $classes_with_point as &$key ) {
            $key = '.' . $key;
        }
        $classes_with_point = implode( ', ', $classes_with_point );

        $no_lazy_fregments = array();

        // Get all elements with excluded classes
        foreach( $html->find( $classes_with_point ) as $fregment ){

            // Save this fregment
            $no_lazy_fregments[] = $fregment->innertext();

            // Remove fregment 'innertext'
            $fregment->innertext = '';

        }

        $lazyload_image = true;

        if ( $lazyload_image ) {

            // Process images
            foreach( $html->find( 'img' ) as $image ){

                $this->process_image( $image );

            }

        }

        if ( $lazyload_video ) {

            // Process images
            foreach( $html->find( 'video' ) as $video ){

                $this->process_video( $video );

            }

        }

        if ( $lazyload_iframe ) {

            foreach( $html->find('iframe') as $iframe) {

                $this->process_iframe( $iframe );

            }
        }

        // Add previously removed fregments innertext
        foreach( $html->find( $classes_with_point ) as $fregment ){

            $fregment->innertext = array_shift( $no_lazy_fregments );
        }

        $piece = $html->save();

        $html->clear();
        unset($html);

        return $piece;

    }

}
