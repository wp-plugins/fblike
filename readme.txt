=== Plugin Name ===
Contributors: ansimation
Tags: facebook, social, fb, recommend, like, share, facebook like, open graph, opengraph, like button, fb like, facebook share
Requires at least: 2.9
Tested up to: 3.1
Stable tag: 1.3.3
Donate Link: http://www.visitfloridastateparks.com/donate/


== Description ==

One of the best Facebook Like Plugins for WordPress out there. Add Facebook Like button to your posts. Configurable options allow you to select between IFrame & XFBML output methods,
Select where to display your Like button. Adds a new button to TinyMCE that pops up a dialog to help you configure your shortcode. Comment form does appear when using the XFBML method.

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
Check that your theme calls wp_footer() or do_action('wp_footer') and that 'Include JavaScript SDK' is checked.

= Comment form does not appear with XFBML output =
By default, the container css is set to a height of 25 pixels. Change this to 135 pixels or greater and you should see the comment form so long as your App ID is valid.

= XFBML output doesn't work =
Check that your theme calls wp_footer() or do_action('wp_footer') and that you have entered a valid App ID on the plugin options page.

== Changelog ==

= 1.3.3 =
* 1.3.2 used add_filter instead of apply_filters causing the plugin not to function, this fixes that.

= 1.3.2 =
* Added fblike_permalink filter so that 3rd parties can change the url for a post. example: shortening with a bit.ly url instead to track clicks.

= 1.3.1 =
* Typo in font list that caused Lucida Grande to not be reselected in the admin. Minor update it still worked just fine.

= 1.3 =
* Added option to display on search results page
* Added option to display on archive pages
* Added option to display on excerpts

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
