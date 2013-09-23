<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package The Skeleton
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function responsive_skeleton_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'responsive_skeleton_jetpack_setup' );