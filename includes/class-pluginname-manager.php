<?php
/**
 * PluginName Manager Funtionality
 *
 * @package PluginName
 * @subpackage Handlers
 *
 * @since 1.0.0
 */

namespace PluginName;

/**
 * The Management System
 *
 * Hooks into the backend to add the interfaces for
 * managing the configuration of PluginName.
 *
 * @internal Used by the System.
 *
 * @since 1.0.0
 */

class Manager extends Handler {
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

		// Settings & Pages
		static::add_action( 'admin_menu', 'add_menu_pages' );
		static::add_action( 'admin_init', 'register_settings' );
	}

	// =========================
	// ! Utilities
	// =========================

	// to be written

	// =========================
	// ! Settings Page Setup
	// =========================

	/**
	 * Register admin pages.
	 *
	 * @since 1.0.0
	 *
	 * @uses Manager::settings_page() for general options page output.
	 * @uses Documenter::register_help_tabs() to register help tabs for all screens.
	 */
	public static function add_menu_pages() {
		// Main Options page
		$options_page_hook = add_utility_page(
			__( '[plugin name] Options', 'plugin-name' ), // page title
			_x( '[plugin name]', 'menu title', 'plugin-name' ), // menu title
			'manage_options', // capability
			'pluginname', // slug
			array( get_called_class(), 'settings_page' ), // callback
			'dashicons-admin-generic' // icon
		);

		// Setup the help tabs for each page
		Documenter::register_help_tabs( array(
			$options_page_hook => 'options',
		) );
	}

	// =========================
	// ! Settings Registration
	// =========================

	/**
	 * Register the settings/fields for the admin pages.
	 *
	 * @since 1.0.0
	 */
	public static function register_settings() {
		// to be written
	}

	// =========================
	// ! Settings Fields Setup
	// =========================

	// to be written

	// =========================
	// ! Settings Page Output
	// =========================

	/**
	 * Output for generic settings page.
	 *
	 * @since 1.0.0
	 *
	 * @global $plugin_page The slug of the current admin page.
	 */
	public static function settings_page() {
		global $plugin_page;
?>
		<div class="wrap">
			<h2><?php echo get_admin_page_title(); ?></h2>
			<?php settings_errors(); ?>
			<form method="post" action="options.php" id="<?php echo $plugin_page; ?>-form">
				<?php settings_fields( $plugin_page ); ?>
				<?php do_settings_sections( $plugin_page ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
