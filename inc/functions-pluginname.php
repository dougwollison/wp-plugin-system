<?php
/**
 * PluginName Internal Functions
 *
 * @package PluginName
 * @subpackage Utilities
 *
 * @internal
 *
 * @since 1.0.0
 */

namespace PluginName;

// =========================
// ! Conditional Tags
// =========================

/**
 * Check if we're in the backend of the site (excluding frontend AJAX requests)
 *
 * @internal
 *
 * @since 1.0.0
 *
 * @global string $pagenow The current page slug.
 */
function is_backend() {
	global $pagenow;

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		// AJAX request, check if the referrer is from wp-admin
		return strpos( $_SERVER['HTTP_REFERER'], admin_url() ) === 0;
	} else {
		// Check if in the admin or otherwise the login/register page
		return is_admin() || in_array( $pagenow, array( 'wp-login.php', 'wp-register.php' ) );
	}
}

// =========================
// ! GetText Functions
// =========================

/**
 * The following functions are aliases to the public
 * localization functions, but with the PluginName text
 * domain included automatically, since it's used in
 * 99% of calls within the classes.
 */

/**
 * @see __()
 */
function __( $string ) {
	return \__( $string, 'plugin-name' );
}

/**
 * @see _e()
 */
function _e( $string ) {
	return \_e( $string, 'plugin-name' );
}

/**
 * @see _n()
 */
function _n( $single, $plural, $number ) {
	return \_n( $single, $plural, $number, 'plugin-name' );
}

/**
 * @see _x()
 */
function _x( $string, $context ) {
	return \_x( $string, 'plugin-name' );
}

/**
 * @see _ex()
 */
function _ex( $string, $context ) {
	\_ex( $string, 'plugin-name' );
}

/**
 * @see _nx()
 */
function _nx( $single, $plural, $number, $context ) {
	return \_nx( $single, $plural, $number, $context, 'plugin-name' );
}

// =========================
// ! Misc. Utilities
// =========================

/**
 * Triggers the standard "Cheatin’ uh?" wp_die message.
 *
 * @internal
 *
 * @since 1.0.0
 */
function cheatin() {
	wp_die( \__( 'Cheatin&#8217; uh?' ), 403 );
}
