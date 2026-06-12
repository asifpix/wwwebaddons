<?php

/**
 * Plugin Name: WWWeb Addons
 * Plugin URI: https://wwwebsolutions.com/
 * Description: Custom functionality for WWWeb Solutions.
 * Version: 1.0.8
 * Author: WWWeb Solutions
 * Author URI: https://wwwebsolutions.com/
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wwwebsolutions
 *
 * @package WWWebSolutions
 */

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Require composer autoloader
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Define constants
 */
define('WWWEBADDONS_VERSION', time());
define('WWWEBADDONS_FILE', __FILE__);
define('WWWEBADDONS_PATH', __DIR__);
define('WWWEBADDONS_URL', plugins_url('', WWWEBADDONS_FILE));
define('WWWEBADDONS_ASSETS', WWWEBADDONS_URL . '/assets/');
define('WWWEBADDONS_BASENAME', plugin_basename(WWWEBADDONS_FILE));

/**
 * Main plugin class.
 */
final class WwwebAddons {

	/**
	 * Plugin instance.
	 *
	 * @var WwwebAddons|null
	 */
	private static $instance = null;

	/**
	 * Get plugin instance.
	 *
	 * @return WwwebAddons
	 */
	public static function instance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Set up plugin hooks.
	 */
	private function __construct() {
		add_action('init', array($this, 'i18n'));
		add_action('plugins_loaded', [$this, 'admin_notices']);
		add_action('plugins_loaded', [$this, 'init_plugin']);
		if (is_admin()) {
			add_action('admin_init', array($this, 'track_version'));
		}
	}

	/**
	 * Prevent clone
	 */
	private function __clone() {
	}

	/**
	 * Prevent unserialize
	 */
	public function __wakeup() {
		throw new Exception('Cannot unserialize singleton');
	}

	/**
	 * Run plugin setup.
	 */
	public function i18n() {
		load_plugin_textdomain('wwwebaddons', false, plugin_dir_url( __FILE__ ) . '/languages');
	}

	public function admin_notices() {

		// Check if Elementor installed and activated
		if (! did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return;
		}
	}

	/**
	 * Track plugin version changes.
	 */
	public function track_version() {
		$current_version = get_option('wwwebsolutions_version');

		if (WWWEBADDONS_VERSION === $current_version) {
			return;
		}

		if (false !== $current_version) {
			$version_history = get_option('wwweaddons_version_history', array());

			if (! is_array($version_history)) {
				$version_history = array();
			}

			$version_history[] = array(
				'from'       => $current_version,
				'to'         => WWWEBADDONS_VERSION,
				'updated_at' => current_time('mysql'),
			);

			update_option('wwweaddons_version_history', $version_history);
		}

		update_option('wwweaddons_version', WWWEBADDONS_VERSION);
	}

	/**
	 * Run when the plugin is activated.
	 */
	public static function activate() {
		update_option('wwwebsolutions_version', WWWEBADDONS_VERSION);
		flush_rewrite_rules();
	}

	/**
	 * Run when the plugin is deactivated.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	public function init_plugin() {
		new \Wwwebaddons\Helpers\Assets();
		new \Wwwebaddons\Helpers\ElementorWidgets();
		new \Wwwebaddons\Helpers\WooPriceSuffix();
	}
}

/**
 * Init plugin
 */
function wwwebaddons() {
	return WwwebAddons::instance();
}

/**
 * Register hooks
 */
register_activation_hook(__FILE__, array('WwwebAddons', 'activate'));
register_deactivation_hook(__FILE__, array('WwwebAddons', 'deactivate'));

/**
 * Boot plugin
 */
wwwebaddons();
