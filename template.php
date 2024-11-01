<?php
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

if ( class_exists( 'SubscribeToCommentsNow' ) && function_exists( 'show_manual_subscription_form' ) ) {
	global $wp_subscribe_to_comments_now;
	
	// Show original comments form
	if ( file_exists( $wp_subscribe_to_comments_now->template2 ) ) {
		require( $wp_subscribe_to_comments_now->template2 );
	} elseif ( file_exists( $wp_subscribe_to_comments_now->template1 ) ) {
		require( $wp_subscribe_to_comments_now->template1 );
	} else {
		$file = substr( $wp_subscribe_to_comments_now->template1, strlen( STYLESHEETPATH ) );
		if ( file_exists( TEMPLATEPATH . $file ) ) {
			require( TEMPLATEPATH .  $file );
		} else {
			require( get_theme_root() . '/default/comments.php');
		}
	}
	
	// Show 'Subscribe without commenting' form when comments are open only
	if ( comments_open() ) {
		show_manual_subscription_form();
	}
}

?>