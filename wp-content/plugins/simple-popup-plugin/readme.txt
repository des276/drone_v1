=== Simple Popup Plugin ===
Contributors: RichH
Tags: email popup,aweber,mailchimp,tools,widget,email newsletter,pop-up,pop up,widget, subscribers, scroll box, lightbox, scrollbar,email, leadpages, leadgen, content upgrades, window, simple, shortcode
Requires at least: 2.8
Tested up to: 4.2
Stable tag: 4.2

This plugin makes it easy to create a simple, modifiable popup window.

== Description ==

[**To get a Email Collection popup and more, go here!**](http://bit.ly/1zqOXPs)

The function of this plugin is to easily create links to simple popup windows.  It supports multiple popup links on posts/pages/widgets and window positioning/centering options.

You can use a short code to add a popup to any page or auto mode.

You can use this plugin to capture email addresses from any mail service you want.

* MailChimp
* GetResponse
* iContact
* Aweber
* Ontraport
* Infusionsoft
* And whichever mail provider you love

You can also use this plugin as a sharing plugin to add services like:

* Facebook
* Twitter
* Pinterest
* Reddit
* Yummly
* and more

Includes auto popup, timed popup and limit popups based on pageviews. 



== Installation ==

Installation for General Use

1. Upload the whole `simple-popup-plugin` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the Plugins menu in WordPress.
1. In a post or page use the shortcode `[popup url="http://www.popup-url.com"]LINK TEXT[/popup]` to create a popup link.
1. Go to the options page to adjust popup window dimensions and other options.


== Frequently Asked Questions ==

1. To create a popup link in a post or page use `[popup url="http://www.popup-url.com"]Link Text Here[/popup]`.
1. You adjust the dimensions of all popups in the options screen, or each individual popup using the width & height attributes within the shortcode, ie `[popup url="http://www.popup-url.com"]LINK TEXT[/popup]`.
1. If you would like to use the shortcode in a template file simply call it like so: 
`<?php echo do_shortcode('[popup url="http://popupurl.com']LINK TEXT[/popup]'); ?>`

== Screenshots ==

1. Screenshot of the options menu.

== Changelog ==

= 2.0 =
* Added scrollbar option.
* Added widget for displaying links to popups in sidebar.
* Added template tag to create popup links in theme templates.

= 3.0 =
* Added support for multiple popups links.
* Added window positioning options.
* Removed widget (brought back in version 3.1)

= 3.1 =
* Brought back widget by popular demand.

= 3.2 =
* Widget upgraded to support multiple links and window centering option available - contributed by RichH

= 3.3 =
Added class 'simple_popup_link' to links for styling and fixed some bugs.

= 4.0 =
Added shortcode attributes for changing the dimensions of each popup window as needed.  Also added the attribute 'class' to the shortcode for adding a custom class to the link if desired.

= 4.1 =
Some code fixes and cleanup to ensure compatibility with new Wordpress versions.

= 4.2 =
Fixed issue of toolbar/scrollbar/location bar options not working correctly.

= 4.3 =

Added auto pop up

== Upgrade Notice ==

= 4.3 =

Added auto pop up

= 4.2 =
Fixed issue of toolbar/scrollbar/location bar options not working correctly.