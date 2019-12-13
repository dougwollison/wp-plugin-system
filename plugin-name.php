<?php
/*
Plugin Name: [plugin name]
Plugin URI: https://github.com/dougwollison/plugin-name
Description: [plugin description]
Version: 1.0.0
Author: Doug Wollison
Author URI: http://dougw.me
Tags: [plugin tags]
License: GPL2
Text Domain: plugin-name
Domain Path: /languages
*/

// =========================
// ! Constants
// =========================

/**
 * Reference to the plugin file.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PLUGINNAME_PLUGIN_FILE', __FILE__ );

/**
 * Reference to the plugin directory.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PLUGINNAME_PLUGIN_DIR', dirname( PLUGINNAME_PLUGIN_FILE ) );

// =========================
// ! Includes
// =========================

require PLUGINNAME_PLUGIN_DIR . '/includes/autoloader.php';
require PLUGINNAME_PLUGIN_DIR . '/includes/functions-pluginname.php';
require PLUGINNAME_PLUGIN_DIR . '/includes/functions-gettext.php';

// =========================
// ! Setup
// =========================

PluginName\System::setup();
