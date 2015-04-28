<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package mirall
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function mirall_jetpack_setup()
{
    add_theme_support('infinite-scroll', array(
        'container' => 'main',
        'footer' => 'page',
    ));
}

add_action('after_setup_theme', 'mirall_jetpack_setup');
