<?php
/*
Plugin Name: Subscribe to Comments Now!
Plugin URI: http://www.poradnik-webmastera.com/projekty/subscribe_to_comments_now/
Description: Subscribe to Comments plugin has "subscribe without commenting" form, but you must edit your template to insert it. This plugin displays this form without the need to edit anything.
Author: Daniel Frużyński
Version: 1.3
Author URI: http://www.poradnik-webmastera.com/
Text Domain: subscribe-to-comments-now
*/

/*  Copyright 2009-2010  Daniel Frużyński  (email : daniel [A-T] poradnik-webmastera.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !class_exists( 'SubscribeToCommentsNow' ) ) {

class SubscribeToCommentsNow {
	var $template1 = null;
	var $template2 = null;
	
	// Constructor
	function SubscribeToCommentsNow() {
		// Initialise plugin
		add_action( 'init', array( &$this, 'init' ) );
	}
	
	// Initialise plugin
	function init() {
		if ( function_exists( 'load_plugin_textdomain' ) ) {
			load_plugin_textdomain( 'subscribe-to-comments-now', false, dirname( plugin_basename( __FILE__ ) ).'/lang' );
		}
		
		if ( function_exists( 'show_manual_subscription_form' ) ) {
			// Handle comments template
			add_filter( 'comments_template', array( &$this, 'comments_template_pre' ), 1 );
			add_filter( 'comments_template', array( &$this, 'comments_template_post' ), 99999999 );
		} else {
			// Show warning message to admin
			add_action( 'admin_notices', array( &$this, 'admin_notices' ) );
		}
	}
	
	// Save original template path
	function comments_template_pre( $template ) {
		$this->template1 = $template;
		return $template;
	}
	
	// Save final template path and return our one
	function comments_template_post( $template ) {
		$this->template2 = $template;
		return dirname( __FILE__ ) . '/template.php';
	}
	
	// Show warning message to admin
	function admin_notices() {
		if ( !function_exists( 'show_manual_subscription_form' ) ) {
			// Display error message
			echo '<div id="notice" class="error"><p>';
			_e('<b>Subscribe to Comments Now!</b> plugin requires <a href="http://wordpress.org/extend/plugins/subscribe-to-comments/">Subscribe to Comments</a> plugin to do its job. Please install and activate it.', 'subscribe-to-comments-now');
			echo '</p></div>', "\n";
		}
	}
}

$wp_subscribe_to_comments_now = new SubscribeToCommentsNow();

} /* END */

?>