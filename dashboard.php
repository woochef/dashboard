<?php
/**
 * Plugin Name: WooChef: Dashboard
 * Plugin URI:  https://github.com/woochef/dashboard
 * Description: A customizable admin dashboard that helping you monitoring every movement in your WooCommerce store.
 * Version:     0.1
 * Author:      WooChef and contributors
 * Author URI:  https://github.com/woochef/dashboard/graphs/contributors
 * Text Domain: woochef-dashboard
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Dashboard {
	/**
	 * Dashboard version.
	 *
	 * @var string
	 */
	public $version = '0.1';

	/**
	 * The single instance of the class.
	 *
	 * @since 0.1
	 *
	 * @var   Dashboard
	 */
	protected static $instance = null;

	/**
	 * Dashboard Instance.
	 *
	 * @since 0.1
	 *
	 * @static
	 *
	 * @return Dashboard  the instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @since 0.1
	 */
	public function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'init' ) );
	}

	/**
	 * Init dashboard widgets.
	 *
	 * @since 0.1
	 */
	public function init() {
		// Remove unnecessary default widgets out from the WordPress dashboard.
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

		// Remove dafult 'Welcome' widget.
		remove_action( 'welcome_panel', 'wp_welcome_panel' );

		// Register a new custom-widget at the 'Welcome' panel.
		add_action( 'welcome_panel', array( $this, 'widget_primary_status' ) );
	}

	/**
	 * @since 0.1
	 */
	public function widget_primary_status() {
		echo '
		<div class="welcome-panel-content" style="padding-bottom: 23px;">
			<h2>' . __( 'WooCommerce Status', 'woochef-dashboard' ) . '</h2>
		</div>';
	}
}

/**
 * @since  0.1
 *
 * @return Dashboard  the instance.
 */
function woochef_dashboard() {
	return Dashboard::instance();
}

woochef_dashboard();
