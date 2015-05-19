<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Revista Mirall Premium
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function revista_mirall_premium_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'revista_mirall_premium_jetpack_setup' );
