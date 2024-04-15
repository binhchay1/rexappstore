<?php

/**
 * Class WOWP_Admin
 *
 * The main admin class responsible for initializing the admin functionality of the plugin.
 *
 * @package    FloatMenuLite
 * @subpackage Admin
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace FloatMenuLite;

use FloatMenuLite\Admin\AdminActions;
use FloatMenuLite\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

class WOWP_Admin {
	public function __construct() {
		Dashboard::init();
		AdminActions::init();
		$this->includes();

		add_action( WOWP_Plugin::PREFIX . '_admin_header_links', [ $this, 'plugin_links' ] );
		add_filter( WOWP_Plugin::PREFIX . '_save_settings', [ $this, 'save_settings' ] );
		add_action( WOWP_Plugin::PREFIX . '_admin_load_assets', [ $this, 'load_assets' ] );
	}

	public function includes(): void {
		require_once plugin_dir_path( __FILE__ ) . 'class-settings-helper.php';
	}

	public function plugin_links(): void {
		?>
        <div class="wpie-links">
            <a href="<?php echo esc_url(WOWP_Plugin::info('pro'));?>" target="_blank">PRO Plugin</a>
            <a href="<?php echo esc_url(WOWP_Plugin::info('support'));?>" target="_blank">Support</a>
            <a href="<?php echo esc_url(WOWP_Plugin::info('rating'));?>" target="_blank" class="wpie-color-orange">Rating</a>
            <a href="<?php echo esc_url(WOWP_Plugin::info('change'));?>" target="_blank" class="wpie-color-success">What's new?</a>
        </div>
		<?php
	}
	public function save_settings( $request ) {

		$param = ! empty( $request ) ? map_deep( $request, 'sanitize_text_field' ) : [];

		if ( isset( $request['menu_1']['item_tooltip'] ) ) {
			$param['menu_1']['item_tooltip'] = map_deep( $request['menu_1']['item_tooltip'], array(
				$this,
				'sanitize_tooltip'
			) );
		}

		if ( isset( $request['menu_1']['item_text'] ) ) {
			$param['menu_1']['item_text'] = map_deep( $request['menu_1']['item_text'], [
				$this,
				'sanitize_text'
			] );
		}

		if ( isset( $request['menu_1']['item_link'] ) ) {
			$param['menu_1']['item_link'] = map_deep( $request['menu_1']['item_link'], 'esc_url' );
		}

		if ( isset( $request['popupcontent'] ) ) {
			$param['popupcontent'] = wp_kses_post( wp_unslash( $request['popupcontent'] ) );
		}

		return $param;

	}

	public function sanitize_text( $text ): string {
		return wp_kses_post( wp_unslash( $text ) );
	}

	public function sanitize_tooltip( $text ): string {
		return sanitize_text_field( wp_unslash( $text ) );
	}


	public function load_assets(): void {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_editor();
		wp_enqueue_media();

		$handle     = WOWP_Plugin::SLUG;
		$version    = WOWP_Plugin::info( 'version' );
		$url_assets = plugin_dir_url( __FILE__ ) . 'assets/';

		$fonticonpicker_js = $url_assets . 'fonticonpicker/fonticonpicker.min.js';
		wp_enqueue_script( $handle . '-fonticonpicker', $fonticonpicker_js, array( 'jquery' ), $version, true );

		$fonticonpicker_css = $url_assets . 'fonticonpicker/css/fonticonpicker.min.css';
		wp_enqueue_style( $handle . '-fonticonpicker', $fonticonpicker_css, null, $version );

		$fonticonpicker_dark_css = $url_assets . 'fonticonpicker/fonticonpicker.darkgrey.min.css';
		wp_enqueue_style( $handle . '-fonticonpicker-darkgrey', $fonticonpicker_dark_css, null, $version );

		$url_fontawesome = WOWP_Plugin::url() . '/vendors/fontawesome/css/all.min.css';
		wp_enqueue_style( 'wowp-fontawesome', $url_fontawesome, null, '6.5.1' );

	}

}