<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://joe.szalai.org
 * @since      1.0.0
 *
 * @package    Exopite_Lazy_Load_Xt
 * @subpackage Exopite_Lazy_Load_Xt/admin/partials
 */
// From here
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2>Exopite Lazy Load XT <?php _e(' Options', $this->plugin_name); ?></h2>

    <form method="post" name="cleanup_options" action="options.php">

    <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // img/video/iframe/bg excluded
        $autoload = (isset($options['autoload']) && !empty($options['autoload'])) ? 1 : 0;
        $video = (isset($options['video']) && !empty($options['video'])) ? 1 : 0;
        $iframe = (isset($options['iframe']) && !empty($options['iframe'])) ? 1 : 0;
        $image = (isset($options['image']) && !empty($options['image'])) ? 1 : 0;
        $background = (isset($options['background']) && !empty($options['background'])) ? 1 : 0;
        $exclude = (isset($options['exclude']) && !empty($options['exclude'])) ? 1 : 0;
        $excluded = (isset($options['excluded']) && !empty($options['excluded'])) ? esc_attr($options['excluded']) : '';

        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);

        // Sources: - http://searchengineland.com/tested-googlebot-crawls-javascript-heres-learned-220157
        //          - http://dinbror.dk/blog/lazy-load-images-seo-problem/
        //          - https://webmasters.googleblog.com/2015/10/deprecating-our-ajax-crawling-scheme.html
    ?>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-1">
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">

                        <div class="handlediv" title="Click to toggle"><br></div>
                        <!-- Toggle -->

                        <h2 class="hndle"><span><?php esc_attr_e( 'Information', $this->plugin_name ); ?></span>
                        </h2>

                        <div class="inside">
                            <p><?php _e("Lazy load images, iframes and videos to improve page load times and user experience. Uses jQuery and Lazy Load XT to only load media when it's visible in the viewport or with autoload enabled, load images after other content is loaded. It is also improve SEO, because of the faster page load.", $this->plugin_name); ?></p>
                            <p><?php _e("You can exclude content between [NOLAZY] and [/NOLAZY] tags or with a specified class. This is important, if you use other lazy load based plugins, like Master Slider.", $this->plugin_name); ?></p>
                            <p><?php _e("Since GoogleBOT crawling javascript, there is no disadvantage of this technique.", $this->plugin_name); ?> <a href="https://webmasters.googleblog.com/2014/05/understanding-web-pages-better.html">Official news on crawling and indexing sites for the Google index</a></p>
                        </div>
                        <!-- .inside -->

                    </div>
                    <!-- .postbox -->

                </div>
                <!-- .meta-box-sortables .ui-sortable -->

            </div>
        </div>
    </div>
    <br class="clear">

    <!-- Autoload images after page is loaded -->
    <fieldset>
        <legend class="screen-reader-text">
            <span><?php _e('Autoload images after page is loaded', $this->plugin_name); ?></span>
        </legend>
        <label for="<?php echo $this->plugin_name; ?>-autoload">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-autoload" name="<?php echo $this->plugin_name; ?>[autoload]" value="1" <?php checked($autoload, 1); ?> />
            <span><?php esc_attr_e('Autoload images after page is loaded', $this->plugin_name); ?></span>
        </label>
    </fieldset>
<br>
    <!-- Lazyload image -->
    <fieldset>
        <legend class="screen-reader-text">
            <span><?php _e('Lazyload image', $this->plugin_name); ?></span>
        </legend>
        <label for="<?php echo $this->plugin_name; ?>-image">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-image" name="<?php echo $this->plugin_name; ?>[image]" value="1" <?php checked($image, 1); ?> />
            <span><?php esc_attr_e('Lazyload images', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <!-- Lazyload iframes -->
    <fieldset>
        <legend class="screen-reader-text"><span><?php _e('Lazyload iframes', $this->plugin_name); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-iframe">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-iframe" name="<?php echo $this->plugin_name; ?>[iframe]" value="1" <?php checked($iframe, 1); ?> />
            <span><?php esc_attr_e('Lazyload iframes', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <!-- Lazyload videos -->
    <fieldset>
        <legend class="screen-reader-text"><span><?php _e('Lazyload videos', $this->plugin_name); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-video">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-video" name="<?php echo $this->plugin_name; ?>[video]" value="1" <?php checked($video, 1 ); ?>  />
            <span><?php esc_attr_e('Lazyload videos', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <!-- Lazyload background images -->
    <fieldset>
        <legend class="screen-reader-text"><span><?php _e('Lazyload background images', $this->plugin_name); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-background">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-background" name="<?php echo $this->plugin_name; ?>[background]" value="1" <?php checked($background, 1); ?>  />
            <span><?php esc_attr_e('Lazyload background images', $this->plugin_name); ?></span>
        </label>
        <div style="margin-left: 24px;"><?php _e('(Please set background url in style tag with data-bg attribute.)', $this->plugin_name); ?></div>
    </fieldset>
<br>
    <!-- Exclude classes -->
    <fieldset>
        <legend class="screen-reader-text"><span><?php _e('Exclude classes', $this->plugin_name); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-exclude">
            <input type="checkbox"  id="<?php echo $this->plugin_name; ?>-exclude" name="<?php echo $this->plugin_name; ?>[exclude]" value="1" <?php checked($exclude,1); ?>/>
            <span><?php esc_attr_e('Exclude classes', $this->plugin_name); ?></span>
        </label>
        <fieldset>
            <p><?php _e('You can specify classes to exclude from being lazy loaded here. Please use a comma separated list, like: no-lazy, nolazy, etc...', $this->plugin_name); ?></p>
            <legend class="screen-reader-text"><span><?php _e('Excluded classes', $this->plugin_name); ?></span></legend>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-excluded" name="<?php echo $this->plugin_name; ?>[excluded]" value="<?php if(!empty($excluded)) echo $excluded; ?>"/>
        </fieldset>
    </fieldset>

    <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>
    </form>

</div>
<div>
    <ul style="list-style: disc; padding-left: 30px; font-size: 0.8em; line-height: 1.3em; max-width: 100%;">
        <li><a target="_blank" href="https://jquery.com/"><b>jQuery</b></a> <?php _e("is a fast, small, and feature-rich JavaScript library. It makes things like HTML document traversal and manipulation, event handling, animation, and Ajax much simpler with an easy-to-use API that works across a multitude of browsers. With a combination of versatility and extensibility, jQuery has changed the way that millions of people write JavaScript.", $this->plugin_name); ?></li>
        <li><a target="_blank" href="http://ressio.github.io/lazy-load-xt/"><b>Lazy load XT</b></a> <?php _e("is a jQuery plugin for images, videos and other media
            <br>Mobile-oriented, fast and extensible jQuery plugin for lazy loading of images/videos.<br>
Currently tested in IE 6-11, Chrome 1-47, Firefox 1.5-43.0, Safari 3-9, Opera 10.6-34.0, iOS 5-9, Android 2.3-5.1, Amazon Kindle Fire 2 and HD 8.9, Opera Mini 7.", $this->plugin_name); ?></li>
    <li><a target="_blank" href="http://wppb.io/"><b>The WordPress Plugin Boilerplate</b></a> <?php _e("A standardized, organized, object-oriented foundation for building high-quality WordPress Plugins.", $this->plugin_name); ?></li>
    </ul>
</div>