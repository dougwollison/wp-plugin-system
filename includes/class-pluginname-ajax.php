<?php
/**
 * PluginName AJAX Handler
 *
 * @package PluginName
 * @subpackage Handlers
 *
 * @since 1.0.0
 */

namespace PluginName;

/**
 * The AJAX Request Handler
 *
 * Add necessary wp_ajax_* hooks to fullfill any
 * custom AJAX requests.
 *
 * @package PluginName
 * @subpackage Handlers
 *
 * @internal Used by the System.
 *
 * @since 1.0.0
 */

class AJAX extends Handler {
	// =========================
	// ! Hook Registration
	// =========================

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public static function register_hooks() {
		// Don't do anything if not doing an AJAX request
		if ( ! defined( 'DOING_AJAX' ) || DOING_AJAX !== true ) {
			return;
		}
		
		// to be written
	}
}
