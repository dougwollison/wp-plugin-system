<?php
/**
 * PluginName Backend Functionality
 *
 * @package PluginName
 * @subpackage Handlers
 *
 * @since 1.0.0
 */

namespace PluginName;

/**
 * The Backend Functionality
 *
 * Hooks into various backend systems to load
 * custom assets and add the editor interface.
 *
 * @internal Used by the System.
 *
 * @since 1.0.0
 */
final class Backend extends Handler {
	// =========================
	// ! Properties
	// =========================

	/**
	 * Record of added hooks.
	 *
	 * @internal Used by the Handler enable/disable methods.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $implemented_hooks = array();

	// =========================
	// ! Hook Registration
	// =========================

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public static function register_hooks() {
		// Don't do anything if not in the backend
		if ( ! is_backend() ) {
			return;
		}

		// Setup stuff
		self::add_hook( 'plugins_loaded', 'load_textdomain', 10, 0 );

		// Script/Style Enqueues
		self::add_hook( 'admin_enqueue_scripts', 'enqueue_assets' );
	}

	// =========================
	// ! Setup Stuff
	// =========================

	/**
	 * Load the text domain.
	 *
	 * @since 1.0.0
	 */
	public static function load_textdomain() {
		// Load the textdomain
		load_plugin_textdomain( 'pluginname', false, dirname( PLUGINNAME_PLUGIN_FILE ) . '/languages' );
	}

	// =========================
	// ! Script/Style Enqueues
	// =========================

	/**
	 * Enqueue necessary styles and scripts.
	 *
	 * @since 1.0.0
	 */
	public static function enqueue_assets(){
		// Admin styling
		wp_enqueue_style( 'pluginname-admin', plugins_url( 'css/admin.css', PLUGINNAME_PLUGIN_FILE ), PLUGINNAME_PLUGIN_VERSION, 'screen' );

		// Admin javascript
		wp_enqueue_script( 'pluginname-admin-js', plugins_url( 'js/admin.js', PLUGINNAME_PLUGIN_FILE ), array(), PLUGINNAME_PLUGIN_VERSION );

		// Localize the javascript
		wp_localize_script( 'pluginname-admin-js', 'pluginnameL10n', array(
			// to be written
		) );
	}
}
