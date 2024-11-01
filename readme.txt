=== WhereRU!? ===
Contributors: Ray Gomez, Genelle Gregorio
Donate link: http://www.operationbackpackasia.com/donate
Tags: travel, widget
Requires at least: 2.9.2
Tested up to: 3.1.1
Stable tag: .1

WhereRU!? allows you to share a customized previous, current, and next location on your Wordpress site.

== Description ==

WhereRU!? is a Wordpress plugin that allows you to manually specify a header, location, and link for your past, current, and upcoming locations. This is a great little plugin for travelers who would like to share with their readers where they are currently at.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `whereru.zip` to the `/wp-content/plugins/` directory
2. Unzip `whereru.zip` in the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do I use this plugin in my custom theme? =

Place the code below anywhere in your custom Wordpress theme:

`<?php if(function_exists('print_whereru')) { print_whereru(); } ?>`

Also, be sure to check the appropriate boxes in the options page to customize which locations you'd like to show.

= Can I use my own style? =

Yes, be sure to disable the default style in the options page, and add the new styles to your theme's stylesheet.

== Screenshots ==

1. This screenshot shows WhereRU!? as a widget in the sidebar.

== Changelog ==

= .1 =
* First release of the WhereRU!? plugin.

== Upgrade Notice ==

Nothing yet
