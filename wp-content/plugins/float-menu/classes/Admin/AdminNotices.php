<?php

/**
 * Class AdminNotices
 *
 * This class handles the admin notices for the plugin.
 *
 * @package    WowPlugin
 * @subpackage Admin
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 *
 */

namespace FloatMenuLite\Admin;

use FloatMenuLite\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;

class AdminNotices {


	public static function init(): void {
		add_action( 'admin_notices', [ __CLASS__, 'admin_notice' ] );
	}

	public static function admin_notice(): bool {
		$notice = $_GET['notice'] ?? '';

		if ( ! isset( $_GET['page'] ) ) {
			return false;
		}

		if ( $_GET['page'] !== WOWP_Plugin::SLUG ) {
			return false;
		}

		if ( ! empty( $notice ) && $notice === 'save_item' ) {
			self::save_item();
		} elseif ( ! empty( $notice ) && $notice === 'remove_item' ) {
			self::remove_item();
		}

		return true;
	}

	public static function save_item(): void {
		if ( isset( $_REQUEST['nonce'] ) && wp_verify_nonce( $_REQUEST['nonce'], 'save-item' ) ) {

			$text = __( 'Item Saved', 'float-menu' );
			echo '<div class="wpie-notice notice notice-success is-dismissible">' . esc_html( $text ) . '</div>';
		}
	}

	public static function remove_item(): void {
		$text = __( 'Item Remove', 'float-menu' );
		echo '<div class="wpie-notice notice notice-warning is-dismissible">' . esc_html( $text ) . '</div>';
	}

}