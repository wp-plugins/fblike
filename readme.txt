=== Plugin Name ===
Contributors: ansimation
Tags: facebook, social, fb, recommend, like, share
Requires at least: 2.9
Tested up to: 3.0
Stable tag: 1.2
Donate Link:
Add the facebook like button to posts

== Description ==

Add Facebook Like button to your posts. Configurable options for layout style, show faces, width, display verb ( like/recommend ), font, and color scheme.,
i will be adding a shortcode and a function here soon to make the plugin more useful in more situations. Currently we do not use the XFBML method for
implementing this. If there's a request for it i might consider it in a future release.

== Installation ==

1. Upload `fblike/` (the folder) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Upgrade Notice ==
Thanks

== Screenshots ==

== Frequently Asked Questions ==

= Can I configure the settings for this like i can on Facebook? =
Yes.

= XFBML doesn't load the Facebook JavaScript SDK =
Check that your theme calls wp_footer() or do_action('wp_footer')

= XFBML output doesn't work =
Check that your theme calls wp_footer() or do_action('wp_footer') and that you have entered a valid App ID on the plugin options page.

== Changelog ==

= 1.2 =
* Added support to select display on individual posts, pages, or home page
* Added option to exclude loading SDK for users who have themes that are already integrated with Facebook and load this.
* Switch to auto height if show_faces is enabled. otherwise default to 25px; can be overwritten by user by adding height property to Container Inline CSS Style
* Fixed bug in show_faces
* Fixed bug in get_permalink where no post id was passed.
* Fixed bug in JavaScript SDK that wasn't passing app ID and causing comment form not to show.

= 1.1 =
* Added full shortcode capablitites comeplete with tinymce button to help generate shortcode
* Added ability to output XFBML instead of IFrames
* Added CSS option to modify container inline styles from within plugin.

= 1.0 =
* Initial Plugin Release.
