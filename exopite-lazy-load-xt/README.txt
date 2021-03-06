=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: http://joe.szalai.org
Tags: comments, spam
Requires at least: 4.7
Tested up to: 4.9.1
Stable tag: 4.9.1
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Version: 20190521

Exopite Lazy Load XT is only load media when it's visible in the viewport or with autoload enabled, load images after other content is loaded.

== Description ==

Lazy load images to improve page load times. Page speed is important, not only for SEO but also for your customers user experience.

Exopite Lazy Load XT lazy load your images, videos and iframes using Ressio Lazy Load XT jQuery plugin.

The plugin works by replacing the src attributes with data-src and loading the Lazy Load XT script when the content or page meta is loaded on the front end of your site.

Since GoogleBOT crawling javascript, there is no disadvantage of this technique. Official news on crawling and indexing sites for the Google index.

* Replace sepcified type of content in the_content and widget_text.
* Can be turn on/off what types of content want you to lazy load (images, videos, iframes, background images).
* Can also be exclude content between [NOLAZY][/NOLAZY] and tags,
* or with a specified class. Default: .no-lazy This is especially usefull if you are already using other lazy load based plugins/sliders, like Master Slider.
* Override placeholder images via exopite_lazyload_xt_placeholder_image,
* Turn off lazy loading via exopite_lazyload_xt_enabled filter. Can use for disable it on a specific page, etc...

== How to use ==

Install and activate plugin. It will do the rest. Configurations are not required. You do not have to change any settings.

== Installation ==

1. Upload `exopite-multifilter` files to the `/wp-content/plugins/exopite-multifilter` directory

OR

1. Install plugin from WordPress repository (not yet)

2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place [exopite-multifilter] shortcode to your content

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 20190521 - 2019-05-21 =
* Update: Update Exopite Simple Options Framework

= 20190213 - 2019-02-13 =
* Update PHP Simple HTML DOM Parser to 1.8.1 ensure PHP 7.3 compatibility

= 20181123 - 2018-11-23 =
* Updated: Exopite Simple Options Framework
* Updated: update URL
* Add: plugin upgrade notification

= 20180609 - 2018-06-09 =
* Updated: Exopite Simple Options Framework
* Fixed: typo button_bar field

= 20180329 - 2018-03-29 =
* Added: Update checker

= 20180121 - 2018-01-21 =
* Fixed: videos only apply to video[data-src].
* Fixed: remove lazy-hidden from videos.

= 20180101 - 2018-01-01 =
* Added: new options menu.

= 20171225 - 2017-12-25 =
* Added: option to select between methods.

= 20171224 - 2017-12-24 =
* Added: new method to process images. Process HTML with output buffering
  just before sent to browser. This is the default method.

= 20171102 - 2017-11-02 =
* Fixed: If content contains widgets (eg. Page Builders) <noscirpt> appeared twice.

= 1.0 =
* Initial release.
