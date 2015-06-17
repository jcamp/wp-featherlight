<?php
/**
 * WP Featherlight main plugin class.
 *
 * @package   WPFeatherlight
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, Robert Neu
 * @license   GPL-2.0+
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
class WP_Featherlight {

	/**
	 * An empty placeholder for referencing the scripts class.
	 *
	 * @since 0.1.0
	 * @var   object
	 */
	public $scripts;

	/**
	 * An empty placeholder for referencing the meta class.
	 *
	 * @since 0.1.0
	 * @var   object
	 */
	public $meta;

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		self::includes();
		self::instantiate();
		if ( is_admin() ) {
			self::load_textdomain();
		}
	}

	/**
	 * Loads the plugin language files
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'wp-featherlight',
			false,
			dirname( plugin_basename( WP_FEATHERLIGHT_FILE ) ) . '/languages'
		);
	}

	/**
	 * Require all plugin files.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		$dir = WP_FEATHERLIGHT_DIR;
		require_once $dir . 'includes/class-scripts.php';
		if ( is_admin() ) {
			require_once $dir . 'admin/class-meta.php';
		}
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	private function instantiate() {
		$this->scripts = new WP_Featherlight_Scripts;
		$this->scripts->run();
		if ( is_admin() ) {
			$this->meta = new WP_Featherlight_Admin_Meta;
			$this->meta->run();
		}
	}

	/**
	 * Runs on plugin activation to set a default admin content label for all
	 * existing posts using the post title.
	 *
	 * @since  0.1.0
	 * @access public
	 * @global $wpdb
	 * @return void
	 */
	public function activate() {
		// Nothing yet.
	}

}
