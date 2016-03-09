<?php
/**
 * PluginName Registry API
 *
 * @package PluginName
 * @subpackage Tools
 *
 * @since 1.0.0
 */

namespace PluginName;

/**
 * The Registry
 *
 * Stores all the configuration options for the system.
 *
 * @api
 *
 * @since 1.0.0
 */

class Registry {
	// =========================
	// ! Properties
	// =========================

	/**
	 * The loaded status flag.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	protected static $__loaded = false;

	/**
	 * The options storage array
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $options = array();

	/**
	 * The options whitelist/defaults.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $options_whitelist = array();

	/**
	 * The deprecated options and their alternatives.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $options_deprecated = array();

	// =========================
	// ! Property Accessing
	// =========================

	/**
	 * Retrieve the whitelist.
	 *
	 * @internal Used by the Installer.
	 *
	 * @since 1.0.0
	 *
	 * @return array The options whitelist.
	 */
	public static function get_defaults() {
		return static::$options_whitelist;
	}

	/**
	 * Check if an option is supported.
	 *
	 * Will also udpate the option value if it was deprecated
	 * but has a sufficient alternative.
	 *
	 * @since 1.0.0
	 *
	 * @param string &$option The option name.
	 *
	 * @return bool Wether or not the option is supported.
	 */
	public static function has( &$option ) {
		if ( isset( static::$options_deprecated[ $option ] ) ) {
			$option = static::$options_deprecated[ $option ];
		}

		return in_array( $option, static::$options_whitelist );
	}

	/**
	 * Retrieve a option value.
	 *
	 * @since 1.0.0
	 *
	 * @param string $option  The option name.
	 * @param mixed  $default Optional. The default value to return.
	 *
	 * @return mixed The property value.
	 */
	public static function get( $option, $default = null ) {
		// Trigger notice error if trying to set an unsupported option
		if ( ! static::has( $option ) ) {
			trigger_error( "[PluginName] The option '{$option}' is not supported", E_USER_NOTICE );
		}

		// Check if it's set, return it's value.
		if ( isset( static::$options[ $option ] ) ) {
			$value = static::$options[ $option ];
		} else {
			$value = $default;
		}

		return $value;
	}

	/**
	 * Override a option value.
	 *
	 * Will not work for $languages, that has it's own method.
	 *
	 * @since 1.0.0
	 *
	 * @param string $option The option name.
	 * @param mixed  $value  The value to assign.
	 */
	public static function set( $option, $value = null ) {
		// Trigger notice error if trying to set an unsupported option
		if ( ! static::has( $option ) ) {
			trigger_error( "[PluginName] The option '{$option}' is not supported", E_NOTICE );
		}

		static::$options[ $option ] = $value;
	}

	// =========================
	// ! Setup Method
	// =========================

	/**
	 * Load the relevant options.
	 *
	 * @since 1.0.0
	 *
	 * @see Registry::$__loaded to prevent unnecessary reloading.
	 * @see Registry::$options_whitelist to filter the found options.
	 * @see Registry::set() to actually set the value.
	 *
	 * @param bool $reload Should we reload the options?
	 */
	public static function load( $reload = false ) {
		if ( static::$__loaded && ! $reload ) {
			// Already did this
			return;
		}

		// Load the options
		$options = get_option( 'pluginname_options' );
		foreach ( static::$options_whitelist as $option => $default ) {
			$value = $default;
			if ( isset( $options[ $option ] ) ) {
				$value = $options[ $option ];

				// Ensure the value is the same type as the default
				settype( $value, gettype( $default ) );
			}

			static::set( $option, $value );
		}

		// Flag that we've loaded everything
		static::$__loaded = true;
	}

	/**
	 * Save the options and languages to the database.
	 *
	 * @since 1.0.0
	 *
	 * @param string $what Optional. Save just options/languages or both (true)?
	 */
	public static function save( $what = true ) {
		update_option( 'pluginname_options', static::$options );
	}
}
